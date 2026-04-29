<?php

namespace Database\Seeders;

use App\Domain\Annexes\Models\Annexe;
use App\Domain\Districts\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run()
    {
        $districts = [
            [
                'nom' => 'عين الشق',
                'code_district' => 'AC',
                'gps_zone' => '33.5731,-7.5898',
                'annexes' => [
                    'عين الشق',
                    'حسنا الشمالية',
                    'المصلى',
                    'بن المودون',
                ],
            ],

            [
                'nom' => 'كاليفورنيا',
                'code_district' => 'CA',
                'gps_zone' => '33.5600,-7.6000',
                'annexes' => [
                    'كاليفورنيا',
                    'شريفه',
                ],
            ],

            [
                'nom' => 'سيدي معروف',
                'code_district' => 'SM',
                'gps_zone' => '33.5300,-7.6400',
                'annexes' => [
                    'سيدي معروف',
                    'جنانات',
                    'أولاد راحو',
                    'المستقبل',
                ],
            ],

            [
                'nom' => 'لمكانسا-سيدي مسعود',
                'code_district' => 'SM',
                'gps_zone' => '33.5400,-7.5800',
                'annexes' => [
                    'حسنا الجنوبية',
                    'سيدي مسعود',
                ],
            ],
        ];

        foreach ($districts as $data) {
            $district = District::create([
                'nom' => $data['nom'],
                'code_district' => $data['code_district'],
                'gps_zone' => $data['gps_zone'],
            ]);

            foreach ($data['annexes'] as $annexe) {
                Annexe::create([
                    'nom' => $annexe,
                    'district_id' => $district->id,
                ]);
            }
        }
    }
}
