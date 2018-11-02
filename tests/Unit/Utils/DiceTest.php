<?php

namespace Tests\Unit\Utils;

use App\Utils\Dice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiceTest extends TestCase {
    /**
     * A basic test example.
     *
     * @param Dice $dice
     *
     * @return void
     *
     * @dataProvider diceProvider
     */
    public function testDiceIsImmutable( Dice $dice ) {
        $firstResult  = $dice->roll()->getResult();
        $secondResult = $dice->roll()->getResult();
        $this->assertEquals( $firstResult, $secondResult );
    }

    public function diceProvider() {
        return [
            [ new Dice() ]
        ];
    }
}
