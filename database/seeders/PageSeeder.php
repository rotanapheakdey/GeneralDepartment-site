<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'about-us',
                'title_en' => 'About Us',
                'title_km' => 'អំពីយើង',
                'content_en' => '<h2>Welcome to the Ministry of Information</h2><p>This is the official page of the Ministry of Information of Cambodia.</p>',
                'content_km' => '<h2>សូមស្វាគមន៍មកកាន់ ក្រសួងព័ត៌មាន</h2><p>នេះគឺជាទំព័រផ្លូវការរបស់ក្រសួងព័ត៌មាននៃកម្ពុជា។</p>',
                'timeline_data' => [
                    [
                        'year' => '1993',
                        'type' => 'history',
                        'title_en' => 'Ministry Established',
                        'title_km' => 'ក្រសួងត្រូវបានបង្កើតឡើង',
                        'description_en' => 'The Ministry of Information in Cambodia was formally established in its current structure following the restoration of the monarchy.',
                        'description_km' => 'ក្រសួងព័ត៌មាននៃព្រះរាជាណាចក្រកម្ពុជាត្រូវបានបង្កើតឡើងជាផ្លូវការនៅក្នុងរចនាសម្ព័ន្ធបច្ចុប្បន្នរបស់ខ្លួន។',
                        'image_path' => null,
                    ],
                    [
                        'year' => '1993 - 1998',
                        'type' => 'leadership',
                        'title_en' => 'H.E. Ieng Mouly',
                        'title_km' => 'ឯកឧត្តម អៀង មូលី',
                        'description_en' => 'Served as the Minister of Information. During his tenure, he was a key architect of the Cambodian Press Law.',
                        'description_km' => 'បានបម្រើការជារដ្ឋមន្ត្រីក្រសួងព័ត៌មាន។ លោកគឺជាស្ថាបត្យករដ៏សំខាន់ម្នាក់នៃច្បាប់ស្តីពីរបបសារព័ត៌មានកម្ពុជា។',
                        'image_path' => null,
                    ],
                    [
                        'year' => '1996',
                        'type' => 'history',
                        'title_en' => 'Law on the Establishment of the Ministry of Information',
                        'title_km' => 'ច្បាប់ស្តីពីការបង្កើតក្រសួងព័ត៌មាន',
                        'description_en' => 'Promulgated on January 24, 1996, solidifying the formal legislative foundation for the ministry.',
                        'description_km' => 'ត្រូវបានប្រកាសឲ្យប្រើនៅថ្ងៃទី២៤ ខែមករា ឆ្នាំ១៩៩៦។',
                        'image_path' => null,
                    ],
                    [
                        'year' => '1998 - 2004',
                        'type' => 'leadership',
                        'title_en' => 'H.E. Lu Laysreng',
                        'title_km' => 'ឯកឧត្តម លឺ ឡាយស្រេង',
                        'description_en' => 'Served as Minister of Information prior to the 2003–2004 government transition.',
                        'description_km' => 'បានបម្រើការជារដ្ឋមន្ត្រីក្រសួងព័ត៌មានមុនការផ្លាស់ប្តូររដ្ឋាភិបាល។',
                        'image_path' => null,
                    ],
                    [
                        'year' => '2004 - 2023',
                        'type' => 'leadership',
                        'title_en' => 'H.E. Khieu Kanharith',
                        'title_km' => 'ឯកឧត្តម ខៀវ កាញារីទ្ធ',
                        'description_en' => 'Served as the Minister of Information for nearly two decades, overseeing significant transitions in Cambodian media.',
                        'description_km' => 'បានបម្រើការជារដ្ឋមន្ត្រីក្រសួងព័ត៌មានអស់រយៈពេលជិតពីរទសវត្សរ៍។',
                        'image_path' => null,
                    ],
                    [
                        'year' => '2023 - Present',
                        'type' => 'leadership',
                        'title_en' => 'H.E. Neth Pheaktra',
                        'title_km' => 'ឯកឧត្តម នេត្រ ភក្ត្រា',
                        'description_en' => 'Current Minister of Information, focusing on modernization of information systems, digital literacy, and combating misinformation.',
                        'description_km' => 'រដ្ឋមន្ត្រីក្រសួងព័ត៌មានបច្ចុប្បន្ន ផ្តោតលើការធ្វើទំនើបកម្មប្រព័ន្ធព័ត៌មាន។',
                        'image_path' => null,
                    ],
                ]
            ],
            [
                'slug' => 'units',
                'title_en' => 'Units',
                'title_km' => 'អង្គភាព',
                'content_en' => '<h2>Our Units and Structure</h2><p>Here is the structural diagram of the Ministry.</p>',
                'content_km' => '<h2>អង្គភាពរបស់យើង</h2><p>នេះគឺជារចនាសម្ព័ន្ធរបស់ក្រសួង។</p>',
                'units_data' => [
                    [
                        'name_en' => 'General Department of Administration and Finance',
                        'name_km' => 'អគ្គនាយកដ្ឋានរដ្ឋបាល និងហិរញ្ញវត្ថុ',
                        'departments' => [
                            ['name_en' => 'Department of Administration', 'name_km' => 'នាយកដ្ឋានរដ្ឋបាល'],
                            ['name_en' => 'Department of Personnel', 'name_km' => 'នាយកដ្ឋានបុគ្គលិក'],
                            ['name_en' => 'Department of Finance', 'name_km' => 'នាយកដ្ឋានហិរញ្ញវត្ថុ'],
                        ]
                    ],
                    [
                        'name_en' => 'General Department of Information and Broadcasting',
                        'name_km' => 'អគ្គនាយកដ្ឋានព័ត៌មាន និងសោតទស្សន៍',
                        'departments' => [
                            ['name_en' => 'Department of Information', 'name_km' => 'នាយកដ្ឋានព័ត៌មាន'],
                            ['name_en' => 'Department of Broadcasting', 'name_km' => 'នាយកដ្ឋានសោតទស្សន៍'],
                            ['name_en' => 'Department of Audiovisual', 'name_km' => 'នាយកដ្ឋានសោតទស្សន៍ (Audiovisual)'],
                        ]
                    ],
                    [
                        'name_en' => 'Attached Agencies',
                        'name_km' => 'អង្គភាពចំណុះ',
                        'departments' => [
                            ['name_en' => 'Kampuchea News Agency (AKP)', 'name_km' => 'ទីភ្នាក់ងារសារព័ត៌មានកម្ពុជា (AKP)'],
                            ['name_en' => 'National Television of Kampuchea (TVK)', 'name_km' => 'ទូរទស្សន៍ជាតិកម្ពុជា (TVK)'],
                            ['name_en' => 'National Radio of Kampuchea (RNK)', 'name_km' => 'វិទ្យុជាតិកម្ពុជា (RNK)'],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'leadership',
                'title_en' => 'Minister of Information',
                'title_km' => 'រដ្ឋមន្ត្រីក្រសួងព័ត៌មាន',
                'content_en' => '<h2>H.E. Neth Pheaktra</h2><p>Minister of Information of the Kingdom of Cambodia.</p>',
                'content_km' => '<h2>ឯកឧត្តម នេត្រ ភក្ត្រា</h2><p>រដ្ឋមន្ត្រីក្រសួងព័ត៌មាននៃព្រះរាជាណាចក្រកម្ពុជា។</p>',
                'portfolio_data' => [
                    [
                        'year' => '2023 - Present',
                        'title_en' => 'Minister of Information',
                        'title_km' => 'រដ្ឋមន្ត្រីក្រសួងព័ត៌មាន',
                        'description_en' => 'Appointed as the Minister of Information in the 7th Mandate of the Royal Government of Cambodia.',
                        'description_km' => 'ត្រូវបានតែងតាំងជារដ្ឋមន្ត្រីក្រសួងព័ត៌មាន ក្នុងអាណត្តិទី៧ នៃរាជរដ្ឋាភិបាលកម្ពុជា។'
                    ],
                    [
                        'year' => '2018 - 2023',
                        'title_en' => 'Secretary of State, Ministry of Environment',
                        'title_km' => 'រដ្ឋលេខាធិការ ក្រសួងបរិស្ថាន',
                        'description_en' => 'Served as Secretary of State and Spokesperson for the Ministry of Environment.',
                        'description_km' => 'ធ្លាប់ជារដ្ឋលេខាធិការ និងជាអ្នកនាំពាក្យក្រសួងបរិស្ថាន។'
                    ]
                ]
            ]
        ];

        foreach ($pages as $page) {
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
