<?php

namespace App\Jobs;

use App\Models\Chat;
use App\Models\Trigger;
use App\Models\Player;
use App\Services\EventHandlers\EventHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class MessageParser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Message */
    private Message $message;

    /** @var Update */
    private Update $update;

    /**
     * Create a new job instance.
     *
     * @param  $answer
     */
    public function __construct(array $answer)
    {
        $this->update = (new Update($answer));
        $this->message = $this->update->getMessage();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $messageText = $this->update->callbackQuery->data ?? $this->message->get('text');;
        $this->getReaction((string)$messageText);
    }

    /**
     * @param string $trigger
     */
    private function getReaction(string $trigger): void
    {
        $trigger = Trigger::searchTrigger($trigger)->first();
        $chat = $this->getChat();
        $player = $this->getPlayers();

        if (!$trigger || $chat->deviance < $trigger->deviance) {
            return;
        }

        $event = $trigger->event;
        $this->initHandler($event)->process($this->update, $chat, $player);
    }

    /**
     * @param string $eventName
     * @return EventHandler
     */
    private function initHandler(string $eventName): EventHandler
    {
        $event = Arr::get(EventHandler::TYPES, $eventName);

        if ($event === null) {
            throw new \LogicException(__('Wrong event Type'));
        }

        /** @var EventHandler $handler */
        $handler = app($event);

        return $handler;
    }

    /**
     * @return Chat
     */
    private function getChat(): Chat
    {
        return Chat::firstOrCreate([
            'tg_id' => $this->message->chat->id,
            'name' => $this->message->chat->title
                ?? $this->message->chat->username
                ?? $this->message->chat->firstName,
        ]);
    }

    /**
     * @return Player
     */
    private function getPlayers(): Player
    {
        /** @var Player $player */
        $player = Player::where('tg_id', $this->update->callbackQuery->from->id ?? $this->message->from->id)->first();

        if ($player) {
            return $player;
        }

        return factory(Player::class)->create([
            'tg_id' => $this->message->from->id,
            'name' => $this->message->from->username ?? $this->message->from->firstName,
        ]);
    }
}
