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
                'value_km' => 'ក្រសួងព័ត៌មាន',
                'value_en' => 'Ministry of Information'
            ],
            [
                'key' => 'director_name',
                'value_km' => 'នេត្រ ភក្ត្រា',
                'value_en' => 'Neth Pheaktra'
            ],
            // --- THE NEW IMAGE KEYS ---
            [
                'key' => 'site_logo',
                'value_km' => 'ឡូហ្គោគេហទំព័រ (សូមបញ្ចូលរូបភាព)',
                'value_en' => 'Site Logo (Please upload an image)'
            ],
            [
                'key' => 'site_hero_image',
                'value_km' => 'រូបភាពផ្ទៃខាងក្រោយ (សូមបញ្ចូលរូបភាព)',
                'value_en' => 'Hero Background Image (Please upload an image)'
            ],
            [
                'key' => 'director_image',
                'value_km' => 'រូបថតអគ្គនាយក (សូមបញ្ចូលរូបភាព)',
                'value_en' => 'Director Image (Please upload an image)'
            ],
            // --- PROFESSIONAL DUMMY DATA ---
            [
                'key' => 'director_title',
                'value_km' => 'រដ្ឋមន្ត្រី',
                'value_en' => 'Minister'
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
                'value_km' => 'info@information.gov.kh',
                'value_en' => 'info@information.gov.kh'
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
            // --- NEW DYNAMIC CORE CONTENT ---
            [
                'key' => 'about_title',
                'value_km' => 'អំពីក្រសួង',
                'value_en' => 'About the Ministry'
            ],
            [
                'key' => 'about_description',
                'value_km' => 'គ្រប់គ្រង និងដឹកនាំវិស័យព័ត៌មាន និងសោតទស្សន៍នៅក្នុងព្រះរាជាណាចក្រកម្ពុជា។',
                'value_en' => 'Regulating, managing, and guiding the information and broadcasting sector in the Kingdom of Cambodia.'
            ],
            [
                'key' => 'mission_title',
                'value_km' => 'បេសកកម្មរបស់យើង',
                'value_en' => 'Our Mission'
            ],
            [
                'key' => 'mission_text',
                'value_km' => 'ធានានូវលំហូរព័ត៌មានត្រឹមត្រូវ ទាន់ពេលវេលា និងគ្រប់ជ្រុងជ្រោយជូនសាធារណជន ព្រមទាំងរក្សាបាននូវភាពស្មោះត្រង់ និងគុណភាពនៃសេវាកម្មផ្សព្វផ្សាយទូទាំងប្រទេស។ យើងដើរតួជាស្ពានភ្ជាប់រវាងរដ្ឋាភិបាល និងប្រជាពលរដ្ឋ។',
                'value_en' => 'To ensure the flow of accurate, timely, and comprehensive information to the public while maintaining the integrity and quality of broadcasting services nationwide. We act as the bridge between the government and the citizens.'
            ],
            [
                'key' => 'vision_title',
                'value_km' => 'ចក្ខុវិស័យរបស់យើង',
                'value_en' => 'Our Vision'
            ],
            [
                'key' => 'vision_text',
                'value_km' => 'ដើម្បីក្លាយជាស្ថាប័នសាធារណៈឌីជីថលឈានមុខគេនៅអាស៊ីអាគ្នេយ៍ ជំរុញឱ្យមានទិដ្ឋភាពប្រព័ន្ធផ្សព្វផ្សាយប្រកបដោយតម្លាភាព ទំនើប និងសីលធម៌ខ្ពស់ ដែលផ្តល់សិទ្ធិអំណាចដល់ប្រជាពលរដ្ឋកម្ពុជាគ្រប់រូប។',
                'value_en' => 'To be the leading digitalized public institution in Southeast Asia, fostering a transparent, modern, and highly ethical media landscape that empowers every Cambodian citizen.'
            ],
            [
                'key' => 'contact_title',
                'value_km' => 'ទីតាំង & ទំនាក់ទំនង',
                'value_en' => 'Location & Contact'
            ],
            [
                'key' => 'contact_get_in_touch',
                'value_km' => 'ទំនាក់ទំនងយើង',
                'value_en' => 'Get in Touch'
            ],
            [
                'key' => 'footer_description',
                'value_km' => 'ច្រកទ្វារឌីជីថលផ្លូវការសម្រាប់ក្រសួងព័ត៌មាន។ ធានានូវតម្លាភាព និងភាពងាយស្រួលសម្រាប់ប្រជាពលរដ្ឋទាំងអស់។',
                'value_en' => 'Official digital gateway for the Ministry of Information. Ensuring transparency and accessibility for all citizens.'
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
