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
            ],
            [
                'name' => 'La chaume',
                'lat' => 46.48848,
                'lng' => -1.79662,
            ],
        ];

        foreach ($spots as $spot) {
            DB::table('spots')->insert(array_merge($spot,  [
                'id' => \Str::uuid(),
            ]));
        }
    }
}
