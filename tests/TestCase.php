<?php

namespace Tests;
require __DIR__.'/../vendor/autoload.php';

use App\Services\BattleProcess\BattleState;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected BattleState $state;

    protected function setUp(): void
    {
        parent::setUp();

    }
}
