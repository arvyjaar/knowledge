<?php

use Illuminate\Database\Seeder;
use App\City;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'title' => 'Vilnius'],
            ['id' => 3, 'title' => 'Kaunas'],
            ['id' => 4, 'title' => 'Klaipėda'],
            ['id' => 5, 'title' => 'Šiauliai'],
            ['id' => 6, 'title' => 'Panevėžys'],
            ['id' => 7, 'title' => 'Utena'],
            ['id' => 8, 'title' => 'Tauragė'],
            ['id' => 9, 'title' => 'Telšiai'],
            ['id' => 10, 'title' => 'Mažeikiai'],
            ['id' => 11, 'title' => 'Alytus'],
        ];

        foreach ($items as $item) {
            City::create($item);
        }
    }
}
