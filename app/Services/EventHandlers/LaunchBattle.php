<?php


namespace App\Services\EventHandlers;

use App\Jobs\BattleDriver;
use App\Jobs\BattleDriver\BattleStart;
use App\Jobs\MessageParser;
use App\Models\Battle;
use App\Models\BattleModels\BattleClass;
use App\Models\BattlePlayer;
use App\Models\Bot;
use App\Models\Chat;
use App\Models\Player;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
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
        $state = $this->initState($lastBattle, $chat);

        BattleStart::dispatch($lastBattle, $state);
    }

    /**
     * @param Battle $battle
     * @return BattleState
     */
    private function initState(Battle $battle, Chat $chat): BattleState
    {
        $state = app(BattleState::class);
        foreach ($battle->battlePlayers as $battlePlayer) {
            $battlePlayer = $this->addClassIfNotExist($battlePlayer, $chat);
            $state->players[] = $this->getPlayerData($battlePlayer);
        }
        $state->battleId = $battle->id;
        $state->tgId = $chat->tg_id;
        $state->deviance = $chat->deviance;
        $state = $this->fillWithBots($state, $chat);

        return $state;
    }

    /**
     * @param BattlePlayer $battlePlayer
     * @return BattlePlayer
     */
    private function addClassIfNotExist(BattlePlayer $battlePlayer, Chat $chat): BattlePlayer
    {
        if ($battlePlayer->class) {
            return $battlePlayer;
        }

        $battlePlayer->class_id = BattleClass::culture($chat)
            ->inRandomOrder()
            ->first()
            ->id;
        $battlePlayer->save();
        return $battlePlayer;
    }

    //Todo: some cooler way to add bots
    private function fillWithBots(BattleState $state, Chat $chat): BattleState
    {
        $botsCount = $chat->min_players - count($state->players);

        $bots = Bot::culture($chat)
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
            $battlePlayer = $this->addClassIfNotExist($battlePlayer, $chat);

            $state->players[] = $this->getPlayerData($battlePlayer, true);
        }
        return $state;
    }

    private function getPlayerData(BattlePlayer $battlePlayer, $bot = false): PlayerState
    {
        return app()->make(PlayerState::class, [
            'battlePlayer' => $battlePlayer,
            'hp' => BattleClass::DEFAULT_HP,
            'dmg' => BattleClass::DEFAULT_DMG,
            'flags' =>[$bot ? PlayerState::FLAG_BOT : PlayerState::FLAG_PLAYER]
        ]);
    }
}
