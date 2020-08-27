<?php

namespace Tests\Feature;

use App\Models\BattleAbility;
use App\Models\BattleState;
use App\Models\Event;
use App\Models\Trigger;
use App\Services\BattleProcess\Turn;
use App\Services\Operations\UpdateClass;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Mime\Encoder\EightBitContentEncoder;
use Tests\TestCase;

class BecomeALichTest extends FeatureCase
{

    public function testFailBecomeALich()
    {
        $activePlayer = $this->state->getAlivePlayer(0);

        app(UpdateClass::class)->operate($this->state, 'warlock', '0');

        $activePlayer->setHP(40);

        /** @var Event $event */
        $event = Event::where('name', 'Становление личем')->first();

        Turn::doEvent($event, $this->state);

        $ability = BattleAbility::where('battle_player_id', $activePlayer->battlePlayer->id)
            ->where('slug', 'resurrect_as_lich')
            ->where('battle_id', $this->battle->id)
            ->first();

        $this->assertSame(2, $ability->state);
        $this->assertEquals($activePlayer->hp, 1);


        $event = Event::where('name', 'Восстание Лича')->first();
        Turn::doEvent($event, $this->state);

        $this->assertTrue($activePlayer->hasFlag('failed_lich'));
        $this->checkText("{$activePlayer->name} оказался не готов к ритуалу и не смог сделать последнюю жертву - свою жизнь. Неудачный ритуал оставил след на душе чернокнижника, больше он никогда не сможет повторить этот ритуал");
    }

    public function testbecomeALichAndStayAlive()
    {
        $activePlayer = $this->state->getAlivePlayer(0);

        app(UpdateClass::class)->operate($this->state, 'warlock', '0');

        $activePlayer->setHP(40);

        /** @var Event $event */
        $event = Event::where('name', 'Становление личем')->first();

        Turn::doEvent($event, $this->state);

        $ability = BattleAbility::where('battle_player_id', $activePlayer->battlePlayer->id)
            ->where('slug', 'resurrect_as_lich')
            ->where('battle_id', $this->battle->id)
            ->first();

        $this->assertSame(2, $ability->state);
        $this->assertEquals($activePlayer->hp, 1);

        $activePlayer->addFlag('dead');

        $event = Event::where('name', 'Восстание Лича')->first();
        Turn::doEvent($event, $this->state);

        $this->assertFalse($activePlayer->hasFlag('failed_lich'));
        $this->assertTrue($activePlayer->hasFlag('lich_class'));
        $this->assertFalse($activePlayer->hasFlag('dead'));
        $this->assertFalse($activePlayer->hasFlag('warlock_class'));
        $this->assertSame($activePlayer->hp, 500);
        $this->assertSame($activePlayer->dmg, 50);

        $ability = BattleAbility::where('battle_player_id', $activePlayer->battlePlayer->id)
            ->where('slug', 'lich_curse')
            ->where('battle_id', $this->battle->id)
            ->first();

        $this->assertSame($ability->state, 2);

        $event = Event::where('name', 'Проклятый старый лич')->first();

        Turn::doEvent($event, $this->state);

        $ability = BattleAbility::where('battle_player_id', $activePlayer->battlePlayer->id)
            ->where('slug', 'lich_damage')
            ->where('battle_id', $this->battle->id)
            ->first();

        $this->assertSame($ability->state, 2);


        $event = Event::where('name', 'Проклятый старый лич (урон)')->first();
        Turn::doEvent($event, $this->state);

        $this->assertSame(450, $activePlayer->hp);

        $this->checkText("{$activePlayer->name} завершил один из темнейших ритуалов, став необычайно сильной нежитью - Личом. Однако несовершенность ритуала скорее всего еще даст о себе знать" . "Несовершенный ритуал превращения в лича дает о себе знать, {$activePlayer->name} теряет часть своего здоровья");
    }

    public function testbecomeALichAndGetDied()
    {
        $activePlayer = $this->state->getAlivePlayer(0);

        app(UpdateClass::class)->operate($this->state, 'warlock', '0');

        $activePlayer->setHP(40);

        /** @var Event $event */
        $event = Event::where('name', 'Становление личем')->first();

        Turn::doEvent($event, $this->state);

        $ability = BattleAbility::where('battle_player_id', $activePlayer->battlePlayer->id)
            ->where('slug', 'resurrect_as_lich')
            ->where('battle_id', $this->battle->id)
            ->first();

        $this->assertSame(2, $ability->state);
        $this->assertEquals($activePlayer->hp, 1);

        $activePlayer->addFlag('dead');

        $event = Event::where('name', 'Восстание Лича')->first();
        Turn::doEvent($event, $this->state);

        $this->assertFalse($activePlayer->hasFlag('failed_lich'));
        $this->assertTrue($activePlayer->hasFlag('lich_class'));
        $this->assertFalse($activePlayer->hasFlag('dead'));
        $this->assertFalse($activePlayer->hasFlag('warlock_class'));
        $this->assertSame($activePlayer->hp, 500);
        $this->assertSame($activePlayer->dmg, 50);



        $ability = BattleAbility::where('battle_player_id', $activePlayer->battlePlayer->id)
            ->where('slug', 'lich_curse')
            ->where('battle_id', $this->battle->id)
            ->first();

        $this->assertSame($ability->state, 2);

        $event = Event::where('name', 'Проклятый старый лич')->first();

        Turn::doEvent($event, $this->state);

        $ability = BattleAbility::where('battle_player_id', $activePlayer->battlePlayer->id)
            ->where('slug', 'lich_damage')
            ->where('battle_id', $this->battle->id)
            ->first();

        $this->assertSame($ability->state, 2);


        $event = Event::where('name', 'Проклятый старый лич (урон)')->first();

        $activePlayer->setHP(20);
        Turn::doEvent($event, $this->state);

        $this->assertSame(-30, $activePlayer->hp);
        $this->assertTrue($activePlayer->hasFlag('dead'));

        $this->checkText("{$activePlayer->name} завершил один из темнейших ритуалов, став необычайно сильной нежитью - Личом. Однако несовершенность ритуала скорее всего еще даст о себе знать" ."{$activePlayer->name} пал жертвой своего собственного проклятия. Никто не будет сожалеть об этом");
    }


}
