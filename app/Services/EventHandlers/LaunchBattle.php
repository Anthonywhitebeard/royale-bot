<?php


namespace App\Services\EventHandlers;

use App\Jobs\BattleDriver;
use App\Models\Battle;
use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Bot;
use App\Models\Chat;
use App\Models\Player;
use App\Services\BattleProcess\BattleState;
use App\Services\TelegramSender;
use Illuminate\Support\Arr;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class LaunchBattle implements EventHandler
{
    /** @var TelegramSender $telegram */
    private $telegram;

    /**
     * StartBattle constructor.
     * @param TelegramSender $telegram
     */
    public function __construct(TelegramSender $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * @param Message $message
     * @param Chat $chat
     * @param Player $player
     * @return void
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function process(Message $message, Chat $chat, Player $player): void
    {
        /** @var Battle $lastBattle */
        $lastBattle = Battle::where('chat_id', $chat->id)
            ->where('state', Battle::BATTLE_STATE_NEW)
            ->first();

        if (!$lastBattle || !$lastBattle->battlePlayers) {
            return;
        }

        $lastBattle->state = Battle::BATTLE_STATE_FINISHED;
        $lastBattle->save();
        $state = $this->initState($lastBattle);
        app()->makeWith(BattleDriver::class, [
            'state' => $state,
            'battle' => $lastBattle,
        ])->launchBattle();
    }

    /**
     * @param Battle $battle
     * @return BattleState
     */
    private function initState(Battle $battle): BattleState
    {
        $state = app(BattleState::class);
        foreach ($battle->battlePlayers as $battlePlayer) {
            $battlePlayer = $this->addClassIfNotExist($battlePlayer);
            $state->players[] = $this->getPlayerData($battlePlayer);
        }
        $state->battleId = $battle->id;
        $state = $this->fillWithBots($state);

        dd($state);
        return $state;
    }

    /**
     * @param BattlePlayer $battlePlayer
     * @return BattlePlayer
     */
    private function addClassIfNotExist(BattlePlayer $battlePlayer): BattlePlayer
    {
        if ($battlePlayer->class) {
            return $battlePlayer;
        }

        $battlePlayer->class_id = BattleClass::where('active', 1)
            ->inRandomOrder()
            ->first()
            ->id;
        $battlePlayer->save();
        return $battlePlayer;
    }

    //Todo: some cooler way to add bots
    private function fillWithBots(BattleState $state): BattleState
    {
        $botsCount = BattleState::PLAYERS_COUNT - count($state->players);
        /** @var Player $realPlayer */

        $bots = Bot::where('active', 1)
            ->inRandomOrder()
            ->limit($botsCount)
            ->get();
        /** @var Bot $bot */
        foreach ($bots as $bot) {
            /** @var BattlePlayer $battlePlayer */
            $battlePlayer = factory(BattlePlayer::class)->make([
                'battle_id' => $state->battleId,
                'user_name' => $bot->player->name,
                'class_id' => $bot->battle_class_id
            ]);
            $battlePlayer->player()->associate($bot->player);
            $battlePlayer = $this->addClassIfNotExist($battlePlayer);

            $state->players[] = $this->getPlayerData($battlePlayer);
        }
        return $state;
    }

    private function getPlayerData(BattlePlayer $battlePlayer): array
    {
        //TODO: start class? bot flags?
        return [
            'hp' => BattleClass::DEFAULT_HP,
            'dmg' => BattleClass::DEFAULT_DMG,
            'flags' => [$battlePlayer->battleClass->name],
            'name' => $battlePlayer->user_name,
        ];
    }
}
