<?php

namespace App\Console\Commands;

use App\Jobs\MessageParser;
use App\Models\Message;
use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class TelegramCatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hook:telegram';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Catch messages from Telegram';
    /**
     * @var Message
     */
    private $message;

    /**
     * TelegramCatcher constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    /**
     * Execute the console command.
     *
     * @param Api $telegram
     * @param Message $message
     * @return mixed
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle(Api $telegram, Message $message): void
    {
        while (true) {
            $offset = $this->message->latest('id')->first();
            $offset = $offset ? ++$offset->update_id : 0;
            $response = $telegram->getUpdates([
                'offset' => $offset,
            ]);
            foreach ($response as $answer) {
                $message->create(['update_id' => $answer->updateId]);
                MessageParser::dispatch($answer->toArray());
            }
        }
    }
}

