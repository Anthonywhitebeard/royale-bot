<?php

namespace App\Console\Commands;

use App\Jobs\MessageParser;
use App\Models\Message;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class SeedRoyale extends Command
{

    private const DATA_PATH = __DIR__ . '/../../../database/';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed {type} {exact = null}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed data for battle royale';

    private array $files;

    /**
     * TelegramCatcher constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $type = $this->argument('type');

        $seederPath = '\\'.Str::title($type) . 'BankSeeder';

        $eventsSeeder = app($seederPath);
        $filePath = self::DATA_PATH . 'databanks/' . Str::title($type);

        $this->getFiles($filePath);

        foreach ($this->files as $file) {
            $bank = require $file;
            $eventsSeeder->run($bank);
        }
    }

    private function getFiles(string $path)
    {
        $addresses = $this->cleanScan($path);
        foreach ($addresses as $address) {
            if (is_dir($path . DIRECTORY_SEPARATOR . $address)) {
                $this->getFiles($path . DIRECTORY_SEPARATOR . $address);
                continue;
            };
            $this->files[] = $path . DIRECTORY_SEPARATOR . $address;
        }
    }

    private function cleanScan($path)
    {
        $files = scandir($path);
        unset($files[0]);
        unset($files[1]);
        return $files;
    }
}

