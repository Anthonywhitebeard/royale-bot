<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Telegram\Bot\Objects\Update;

class MessageParser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $answer;

    /**
     * Create a new job instance.
     *
     * @param array $answer
     */
    public function __construct(array $answer)
    {
        $this->answer = $answer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    }
}
