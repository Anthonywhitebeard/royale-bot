<?php

namespace App\Jobs;

use App\Models\Chat;
use App\Models\Trigger;
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
    private $message;

    /**
     * Create a new job instance.
     *
     * @param  $answer
     */
    public function __construct(array $answer)
    {
        $this->message = (new Update($answer))->getMessage();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $messageText = $this->message->get('text');
        $this->getReaction($messageText);
    }

    /**
     * @param string $trigger
     */
    private function getReaction(string $trigger): void
    {
        $trigger = Trigger::where('reg_exp', $trigger)->first();
        $chat = $this->getChat();

        if (!$trigger || $chat->deviance < $trigger->deviance) {
            return;
        }

        $event = $trigger->event;
        $this->initHandler($event)->process($this->message);
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
            'name' => $this->message->chat->firstName,
        ]);
    }
}
