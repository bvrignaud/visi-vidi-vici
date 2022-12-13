<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebcamSeeder extends Seeder
{
    public function run(): void
    {
        $webcams = [
            [
                'title' => 'Port Bourgenay - Capitainerie',
                'url' => 'https://youtu.be/ZktdEyLtYPo',
                'lat' => 46.43877,
                'lng' => -1.68034,
            ],
            [
                'title' => 'Grande Plage des Sables d\'Olonne',
                'url' => 'https://youtu.be/xjlaExcaEt0',
                'lat' => 46.49325,
                'lng' => -1.79079,
            ],
            [
                'title' => 'Tanchet - Les Sables d\'Olonne',
                'url' => 'https://pv.viewsurf.com/1070/Les-Sables-d-Olonne?i=NDkxMDo',
                'lat' => 46.48085,
                'lng' => -1.76835,
            ],
            [
                'title' => 'La Sauzaie - Brétignolles sur mer',
                'url' => 'https://pv.viewsurf.com/1070/Les-Sables-d-Olonne?i=NDkxMDo',
                'lat' => 46.63840,
                'lng' => -1.89534,
            ],
        ];

        foreach ($webcams as &$webcam) {
            $webcam['created_at'] = now();
        }

        DB::table('webcams')->insert($webcams);
    }
}
