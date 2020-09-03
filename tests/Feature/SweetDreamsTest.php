<?php

namespace Tests\Feature;

use App\Models\BattleState;
use App\Models\Event;
use App\Models\Trigger;
use App\Services\BattleProcess\Turn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Mime\Encoder\EightBitContentEncoder;
use Tests\TestCase;

class BasicAttackTest extends FeatureCase
{

    public function testBasicAttackAlive()
    {
        /** @var Event $event */
        $event = Event::where('name', 'Приятные мечты')->firstOrFail();

        $activePlayer = $this->state->getAlivePlayer(0);
        $activePlayer->setDMG(60);

        $firstPlayer = $this->state->getAlivePlayer(1);
        $firstPlayer->setHP(100);
        Turn::doEvent($event, $this->state);

        $this->checkText('ฏ๎๎ ̅̅ ̆̃ Ỏ͖͈ ̤ ̬̪ Ỏ͖͈̞̩͎̻̫̫̜͉̠̫͕̭̭̫̫̹̗̹͈̼̠̖͍͚̥͈̮̼͕̠̤̯̻̥̬̗̼̳̤̳̬̪̹͚̞̼̠͕̼̠̦͚̫͔̯̹͉͉̘͎͕̼̣̝͙̱̟̹̩̟̳̦̭͉̮̖̭̣̣̞̙̗̜̺̭̻̥͚͙̝̦̲̱͉͖͉̰̦͎̫̣̼͎͍̠̮͓̹̹͉̤̰̗̙͕͇͔̱͕̭͈̳̗̭͔̘̖̺̮̜̠͖̘͓̳͕̟̠̱̫̤͓͔̘̰̲͙͍͇̙͎̣̼̗̖͙̯͉̠̟͈͍͕̪͓̝̩̦̖̹̼̠̘̮͚̟͉̺̜͍͓̯̳̦̭ ̗̭ ͕̟ ̱̻ ͉̻ ปี้ ฏ๎๎ฏ๎๎ ̅̅ ̆̃ Ỏ͖͈ ̤ ̬̪ Ỏ͖͈̞̩͎̻̫̫̜͉̠̫͕̭̭̫̫̹̗̹͈̼̠̖͍͚̥͈̮̼͕̠̤̯̻̥̬̗̼̳̤̳̬̪̹͚̞̼̠͕̼̠̦͚̫͔̯̹͉͉̘͎͕̼̣̝͙̱̟̹̩̟̳̦̭͉̮̖̭̣̣̞̙̗̜̺̭̻̥͚͙̝̦̲̱͉͖͉̰̦͎̫̣̼͎͍̠̮͓̹̹͉̤̰̗̙͕͇͔̱͕̭͈̳̗̭͔̘̖̺̮̜̠͖̘͓̳͕̟̠̱̫̤͓͔̘̰̲͙͍͇̙͎̣̼̗̖͙̯͉̠̟͈͍͕̪͓̝̩̦̖̹̼̠̘̮͚̟͉̺̜͍͓̯̳̦̭ ̗̭ ͕̟ ̱̻ ͉̻ ปี้ ฏ๎๎ฏ๎๎ ̅̅ ̆̃ Ỏ͖͈ ̤ ̬̪ Ỏ͖͈̞̩͎̻̫̫̜͉̠̫͕̭̭̫̫̹̗̹͈̼̠̖͍͚̥͈̮̼͕̠̤̯̻̥̬̗̼̳̤̳̬̪̹͚̞̼̠͕̼̠̦͚̫͔̯̹͉͉̘͎͕̼̣̝͙̱̟̹̩̟̳̦̭͉̮̖̭̣̣̞̙̗̜̺̭̻̥͚͙̝̦̲̱͉͖͉̰̦͎̫̣̼͎͍̠̮͓̹̹͉̤̰̗̙͕͇͔̱͕̭͈̳̗̭͔̘̖̺̮̜̠͖̘͓̳͕̟̠̱̫̤͓͔̘̰̲͙͍͇̙͎̣̼̗̖͙̯͉̠̟͈͍͕̪͓̝̩̦̖̹̼̠̘̮͚̟͉̺̜͍͓̯̳̦̭ ̗̭ ͕̟ ̱̻ ͉̻ ปี้ ฏ๎๎ฏ๎๎ ̅̅ ̆̃ Ỏ͖͈ ̤ ̬̪ ̦̭ ̗̭ ͕̟ ̱̻ ͉̻ ปี้ ฏ๎๎ฏ๎๎ ̅̅ ̆̃ Ỏ͖͈ ̤ ̬̪ ̦̭ ̗̭ ͕̟ ̱̻ ͉̻ ปี้ ฏ๎๎');

        $this->assertTrue($this->state->getAlivePlayer(8)->hasFlag('elder_3'));
    }
}
