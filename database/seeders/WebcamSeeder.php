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
                'title' => 'Piriac sur mer (44)',
                'url' => 'https://youtu.be/EBTJzfIZMy8',
                'lat' => 47.38184,
                'lng' => -2.54297,
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
                'title' => 'Saint-Gilles-Croix-de-Vie - Plage',
                'url' => 'https://pv.viewsurf.com/2008/Saint-Gilles-Croix-de-Vie-La-Plage?i=NzM2Mjp1bmRlZmluZWQ',
                'lat' => 46.68683597,
                'lng' => -1.93688465,
            ],
            [
                'title' => 'La Sauzaie - Brétignolles sur mer',
                'url' => 'https://pv.viewsurf.com/842/Bretignolles-sur-Mer-La-Sauzaie?i=NDM5NDo',
                'lat' => 46.63840,
                'lng' => -1.89534,
            ],
            [
                'title' => 'La Perroche',
                'url' => 'https://youtu.be/xjlaExcaEt0',
                'lat' => 45.90008,
                'lng' => -1.29574,
            ],
        ];

        foreach ($webcams as &$webcam) {
            $webcam['created_at'] = now();
        }

        DB::table('webcams')->insert($webcams);
    }
}
