<?php

namespace App\Utils;

/**
 * Immutable Dice.
 *
 * Can be rolled only once.
 *
 * @package App\Utils
 */
class Dice {

    /**
     * @var int
     */
    private $result;

    /**
     * @var int
     */
    private $sides;

    /**
     * Dice constructor.
     *
     * @param int $sides
     */
    public function __construct( $sides = 6 ) {
        $this->sides = $sides;
    }

    /**
     * @return Dice
     */
    public function roll(): Dice {
        if ( is_null( $this->result ) ) {
            $this->result = mt_rand( 1, $this->sides );
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getResult(): int {
        return $this->result;
    }

    /**
     * @return int
     */
    public function getSides(): int {
        return $this->sides;
    }

}
