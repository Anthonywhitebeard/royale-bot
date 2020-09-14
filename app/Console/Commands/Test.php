<?php

namespace App\Console\Commands;

use App\Jobs\MessageParser;
use App\Models\BattlePlayer;
use App\Models\Message;
use App\Services\BattleProcess\AbilityBuilder;
use App\Services\BattleProcess\BattleState;
use App\Services\TelegramSender;
use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\Update;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reply:test';

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
     * @param Api $telegram
     * @param Message $message
     * @param AbilityBuilder $abilityBuilder
     */
    public function handle(Api $telegram, Message $message, AbilityBuilder $abilityBuilder, TelegramSender $sender): void
    {
        $sender->sendMarkdownMessage('Нет ты иди', -1001289293236);


    }
}

