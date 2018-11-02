<?php

namespace App\Utils;

use App\Factories\DiceFactory;
use Illuminate\Support\Collection;

class Roller {
    /**
     * @var DiceFactory
     */
    private $factory;

    /**
     * Roller constructor.
     *
     * @param DiceFactory $factory
     */
    public function __construct( DiceFactory $factory ) {
        $this->factory = $factory;
    }

    /**
     * @param int $qty
     * @param int $bonus
     * @param int $penalty
     *
     * @return int
     */
    public function roll( $qty = 1, $bonus = 0, $penalty = 0 ): int {
        /** @var Collection $dice */
        $dice = $this->factory->make( $qty + $bonus + $penalty )->each->roll();

        if ( $bonus > $penalty ) {
            $dice = $this->applyBonus( $dice, $bonus );
        } else if ( $penalty > $bonus ) {
            $dice = $this->applyPenalty( $dice, $penalty );
        }

        return $dice->sum( function ( Dice $item ) {
            return $item->getResult();
        } );
    }

    /**
     * @param Collection $dice
     * @param int        $bonus
     *
     * @return Collection
     */
    private function applyBonus( Collection $dice, int $bonus ): Collection {
        return $this->sortByResult( $dice )->slice( $bonus - 1 );
    }

    /**
     * @param Collection $dice
     * @param int        $penalty
     *
     * @return Collection
     */
    private function applyPenalty( Collection $dice, int $penalty ): Collection {
        return $this->sortByResult( $dice )->slice( $penalty, -1 );
    }

    /**
     * @param Collection $dice
     * @param bool       $descending
     *
     * @return Collection
     */
    private function sortByResult( Collection $dice, $descending = false ): Collection {
        return $dice->sortBy( function ( Dice $item ) {
            return $item->getResult();
        }, SORT_REGULAR, $descending );
    }

}
