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
                'name' => 'Cap Gris-Nez (62 - Audinghen)',
                'lat' => 50.863568,
                'lng' => 1.577159,
                'optimal_wind_direction' => 90,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Cap d\'antifer (76 - La poterie-cap-d\'antifer)',
                'lat' => 49.686959,
                'lng' => 0.163603,
                'optimal_wind_direction' => 90,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Les roches de grampcamp (14 - Grandcamp - Maisy)',
                'lat' => 49.39027,
                'lng' => -1.05057,
                'optimal_wind_direction' => 135,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Les dames (22 - Plouha)',
                'lat' => 48.70271,
                'lng' => -2.90587,
                'optimal_wind_direction' => 135,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Pointe du castelli (44 - Piriac sur mer)',
                'lat' => 47.37429,
                'lng' => -2.56017,
                'optimal_wind_direction' => 45,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Les cinq pineaux (85 - Saint Hilaire de riez)',
                'lat' => 46.704067,
                'lng' => -1.984849,
                'optimal_wind_direction' => 45,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Grande roche (85 - Brétignolles sur mer)',
                'lat' => 46.614592,
                'lng' => -1.867231,
                'optimal_wind_direction' => 45,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Anse du vieux moulin (85 - Les sables d\'olonne)',
                'lat' => 46.4666,
                'lng' => -1.7395,
                'optimal_wind_direction' => 45,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'La chaume (85 - Les sables d\'olonne)',
                'lat' => 46.48848,
                'lng' => -1.79662,
                'optimal_wind_direction' => 45,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Rocher du jard (17 - Dolus d\'Oléron)',
                'lat' => 45.86728,
                'lng' => -1.26585,
                'optimal_wind_direction' => 0,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Les viviers basques (63 - Urrugne)',
                'lat' => 43.39391,
                'lng' => -1.69706,
                'optimal_wind_direction' => 335,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Cap Leucate (11 - Leucate)',
                'lat' => 42.91786,
                'lng' => 3.06254,
                'optimal_wind_direction' => 180,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Palavas les flots (34)',
                'lat' => 43.52271,
                'lng' => 3.92885,
                'optimal_wind_direction' => 315,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Digue immergéee (13 - Saintes-Maries-de-la-Mer)',
                'lat' => 43.44837,
                'lng' => 4.43234,
                'optimal_wind_direction' => 90,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Pointes de Bonnieu et Donnelle (13 - Martigues)',
                'lat' => 43.34147,
                'lng' => 5.01702,
                'optimal_wind_direction' => 225,
                'timezone' => 'Europe/Paris',
            ],
            [
                'name' => 'Sausset-les-pins (13 - Sausset-les-pins)',
                'lat' => 43.32820,
                'lng' => 5.11672,
                'optimal_wind_direction' => 190,
                'timezone' => 'Europe/Paris',
            ],
        ];

        foreach ($spots as $spot) {
            DB::table('spots')->insert(array_merge($spot, [
                'id' => \Str::uuid(),
            ]));
        }
    }
}
