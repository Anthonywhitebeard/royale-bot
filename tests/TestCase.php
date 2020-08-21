<?php

namespace Tests;
require __DIR__.'/../vendor/autoload.php';

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
