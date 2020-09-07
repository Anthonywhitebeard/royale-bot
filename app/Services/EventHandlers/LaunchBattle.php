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
use App\Services\Keyboard;
use App\Services\TelegramSender;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

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
     * @param Update $update
     * @param Chat $chat
     * @param Player $player
     * @return void
     */
    public function process(Update $update, Chat $chat, Player $player): void
    {
        /** @var Battle $lastBattle */
        $lastBattle = Battle::where('chat_id', $chat->id)
            ->where('state', Battle::BATTLE_STATE_NEW)
            ->first();

        if (!$lastBattle || !$lastBattle->battlePlayers) {
            return;
        }
        $state = $this->initState($lastBattle, $chat);

        $classMessage = $this->telegram->sendKeyboardMessage(
            $chat->tg_id,
            __('select_class_message'),
            Keyboard::battleClasses($chat),
        );
        $lastBattle->state = Battle::BATTLE_STATE_CLASS_SELECT;
        $lastBattle->save();
        BattleStart::dispatch($lastBattle, $state, $classMessage)->delay(Carbon::now()->addSeconds(20));
    }

    /**
     * @param Battle $battle
     * @param Chat $chat
     * @return BattleState
     */
    public function initState(Battle $battle, Chat $chat): BattleState
    {
        $state = app(BattleState::class);
        $state->players = [];
        foreach ($battle->battlePlayers as $battlePlayer) {
            $battlePlayer = $this->addClassIfNotExist($battlePlayer, $chat);
            $state->players[] = $this->getPlayerData($battlePlayer);
        }
        $state->battleId = $battle->id;
        $state->chat = $chat;
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
        if ($battlePlayer->class_id) {
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

            $statePlayer = $this->getPlayerData($battlePlayer, true);

            if ($bot->default_events) {
                $statePlayer->addFlag(PlayerState::FLAG_DEFAULT_EVENTS);
            }

            $state->players[] = $statePlayer;
        }
        return $state;
    }

    private function getPlayerData(BattlePlayer $battlePlayer, $bot = false): PlayerState
    {
        $flag = $bot ? PlayerState::FLAG_BOT : PlayerState::FLAG_PLAYER;
        return app()->make(PlayerState::class, [
            'battlePlayer' => $battlePlayer,
            'hp' => BattleClass::DEFAULT_HP,
            'dmg' => BattleClass::DEFAULT_DMG,
            'name' => $battlePlayer->user_name,
            'flags' => [$flag => true],
            'className' => $battlePlayer->battleClass->flag
        ]);
    }
}
