<?php

namespace App\Console\Commands;

use Amp\Loop;
use App\Jobs\Reactor;
use App\Models\Message;
use Illuminate\Console\Command;
use Telegram\Bot\Api;

class TelegramCatcher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catch:telegram';

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
     * @param  Api $telegram
     * @return mixed
     */
    public function handle(Api $telegram): void
    {
        while (true) {
            $offset = $this->message->latest('id')->first();
            $offset = $offset ? ++$offset->update_id : 0;
            $response = $telegram->getUpdates([
                'offset' => $offset,
            ]);
            foreach ($response as $message) {
                Message::create(['update_id' => $message->getUpdateId()]);
                Reactor::dispatch($message->getMessage()->toArray());
            }
        }
    }
}

