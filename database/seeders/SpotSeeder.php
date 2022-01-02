<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpotSeeder extends Seeder
{
    public function run(): void
    {
        $spots = [
            [
                'name' => 'Anse du vieux moulin',
                'lat' => 46.4666,
                'lng' => -1.7395,
                'optimal_wind_direction' => 45,
            ],
            [
                'name' => 'La chaume',
                'lat' => 46.48848,
                'lng' => -1.79662,
                'optimal_wind_direction' => 45,
            ],
            [
                'name' => 'Palavas les flots',
                'lat' => 43.52271,
                'lng' => 3.92885,
                'optimal_wind_direction' => 315,
            ],
        ];

        foreach ($spots as $spot) {
            DB::table('spots')->insert(array_merge($spot,  [
                'id' => \Str::uuid(),
            ]));
        }
    }
}
