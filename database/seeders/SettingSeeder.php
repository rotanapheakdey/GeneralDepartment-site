<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // --- YOUR SPECIFIC DATA ---
            [
                'key' => 'dept_name',
                'value_km' => 'អគ្គនាយកដ្ឋានព័ត៌មាន និងសោតទស្សន៍',
                'value_en' => 'General Department of Information and Broadcasting'
            ],
            [
                'key' => 'director_name',
                'value_km' => 'ភក្តី រតនា',
                'value_en' => 'Pheakdey Rotana'
            ],
            // --- THE NEW IMAGE KEYS ---
            [
                'key' => 'site_logo',
                'value_km' => 'ឡូហ្គោគេហទំព័រ (សូមបញ្ចូលរូបភាព)',
                'value_en' => 'Site Logo (Please upload an image)'
            ],
            [
                'key' => 'director_image',
                'value_km' => 'រូបថតអគ្គនាយក (សូមបញ្ចូលរូបភាព)',
                'value_en' => 'Director Image (Please upload an image)'
            ],
            // --- PROFESSIONAL DUMMY DATA ---
            [
                'key' => 'director_title',
                'value_km' => 'អគ្គនាយក',
                'value_en' => 'Director General'
            ],
            [
                'key' => 'director_quote',
                'value_km' => 'ការផ្សព្វផ្សាយព័ត៌មានប្រកបដោយតម្លាភាព និងវិជ្ជាជីវៈ គឺជាគ្រឹះនៃទំនុកចិត្តរបស់សាធារណជន។',
                'value_en' => 'Transparent and professional broadcasting is the foundation of public trust.'
            ],
            [
                'key' => 'phone',
                'value_km' => '023 721 905',
                'value_en' => '+855 23 721 905'
            ],
            [
                'key' => 'email',
                'value_km' => 'contact@gdib.gov.kh',
                'value_en' => 'contact@gdib.gov.kh'
            ],
            [
                'key' => 'address',
                'value_km' => 'វិថីព្រះមុនីវង្ស សង្កាត់ស្រះចក ខណ្ឌដូនពេញ រាជធានីភ្នំពេញ',
                'value_en' => 'Monivong Blvd, Sangkat Srah Chork, Daun Penh, Phnom Penh'
            ],
            [
                'key' => 'map_url',
                'value_km' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.7705943891465!2d104.91942031534065!3d11.56828599178733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951468641113b%3A0xc682914106368364!2sMinistry%20of%20Information!5e0!3m2!1sen!2skh!4v1690000000000!5m2!1sen!2skh',
                'value_en' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.7705943891465!2d104.91942031534065!3d11.56828599178733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951468641113b%3A0xc682914106368364!2sMinistry%20of%20Information!5e0!3m2!1sen!2skh!4v1690000000000!5m2!1sen!2skh'
            ],
            [
                'key' => 'working_hours',
                'value_km' => 'ច័ន្ទ - សុក្រ (៨:០០ ព្រឹក - ៥:០០ ល្ងាច)',
                'value_en' => 'Mon - Fri (8:00 AM - 5:00 PM)'
            ],
        ];

        foreach ($data as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                [
                    'value_km' => $item['value_km'],
                    'value_en' => $item['value_en']
                ]
            );
        }
    }
}
