<?php

use App\Models\Chat\Channel;
use Illuminate\Database\Seeder;

class ChannelsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Channel::create( [
            'name' => 'Global'
        ] );
    }
}
