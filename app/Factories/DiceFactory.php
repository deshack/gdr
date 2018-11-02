<?php

namespace App\Factories;

use App\Utils\Dice;

class DiceFactory {

    /**
     * @param $number
     *
     * @return \Illuminate\Support\Collection
     */
    public function make( $number ) {
        return collect()->times( $number, function () {
            return new Dice();
        } );
    }

}
