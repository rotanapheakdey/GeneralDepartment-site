<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key' => 'dept_name',
                'value_km' => 'អគ្គនាយកដ្ឋានព័ត៌មាន និងសោតទស្សន៍',
                'value_en' => 'General Department of Information and Audiovisual'
            ],
            [
                'key' => 'director_name',
                'value_km' => 'ភក្តី រតនា',
                'value_en' => 'Pheakdey Rotana'
            ],
            [
                'key' => 'phone',
                'value_km' => '023 721 905',
                'value_en' => '+855 23 721 905'
            ],
        ];

        foreach ($data as $item) {
            \App\Models\Setting::updateOrCreate(['key' => $item['key']], $item);
        }
    }
}
