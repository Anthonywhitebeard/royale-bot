<?php

namespace App\Jobs\BattleDriver;

use App\Models\Battle;
use App\Models\Event;
use App\Services\BattleProcess\BattleState;
use App\Services\BattleProcess\PlayerState;
use App\Services\BattleProcess\Turn;
use App\Services\Operations\OperationInterface;
use App\Services\Operations\UpdateStateInChatOperation;
use App\Services\TelegramSender;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class BattleStart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Battle $battle */
    private Battle $battle;
    /** @var BattleState $state */
    private BattleState $state;
    /** @var TelegramSender $telegram */
    private TelegramSender $telegram;
    /**
     * @var Message
     */
    private Message $classMessage;

    /**
     * BattleStart constructor.
     * @param Battle $battle
     * @param BattleState $state
     * @param Message $classMessage
     */
    public function __construct(Battle $battle, BattleState $state, Message $classMessage)
    {
        $this->battle = $battle;
        $this->state = $state;
        $this->classMessage = $classMessage;
    }

    /**
     * @param Api $telegram
     * @throws \JsonException
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(Api $telegram): void
    {
        $this->clearSelectClassMessage($telegram);
        $this->preBattle();
        $this->battle->battleState()->create([
            'state' => $this->state->toJson(),
        ]);
        BattleTurn::dispatch($this->battle)->delay(Turn::getDelay());
    }

    private function preBattle(): void
    {
        foreach ($this->state->players as $index => &$player) {
            $this->state->shakePlayers($player);
            Turn::doEvent($player->battlePlayer->refresh()->battleClass->event, $this->state);
        }

        /** @var OperationInterface $operation */
        $operation = app(UpdateStateInChatOperation::class);
        $operation->operate($this->state, '', '');
    }

    /**
     * @param Api $telegram
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    private function clearSelectClassMessage(Api $telegram): void
    {
        $telegram->deleteMessage([
            'chat_id' => $this->classMessage->chat->id,
            'message_id' => $this->classMessage->messageId,
        ]);
    }
}
