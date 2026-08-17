<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;

class RealNewsSeeder extends Seeder
{
    public function run()
    {
        $category = Category::firstOrCreate(['name' => 'News']);

        $posts = [
            [
                'title' => 'Ministry warns against content harming women\'s dignity',
                'excerpt' => 'The Ministry of Information has issued a strong warning to journalists and influencers regarding content that undermines social morality.',
                'content' => 'The Ministry of Information has issued a strong warning to journalists, content creators, and social media influencers regarding content that undermines social morality or violates the rights, honor, and dignity of women. This initiative follows a meeting between the Minister and the Cambodian National Council for Women. The Ministry stated it will enforce administrative and legal actions against those producing content deemed insulting or discriminatory, specifically noting concerns about the exploitation of women’s privacy and the use of generative AI.',
                'featured_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Ministry_of_Information_%28Cambodia%29_logo.svg/512px-Ministry_of_Information_%28Cambodia%29_logo.svg.png',
                'published_at' => now(),
                'status' => 'published',
            ],
            [
                'title' => 'Information Ministry Reports Decline in Fake News Cases',
                'excerpt' => 'The Ministry reported a steady decrease in fake news cases, attributing it to the Say No to Fake News campaign.',
                'content' => 'The Ministry of Information reported a steady decrease in fake news cases between May and July 2026. This decline is being attributed to the second phase of the "Say No to Fake News" campaign, which was launched earlier this year. Officials highlighted that the campaign has helped increase media literacy among the public, particularly youth, leading to a safer digital environment and more responsible journalism.',
                'featured_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Phnom_Penh_skyline_2019.jpg/800px-Phnom_Penh_skyline_2019.jpg',
                'published_at' => now()->subDays(2),
                'status' => 'published',
            ],
            [
                'title' => 'Strengthening State Media for National Security',
                'excerpt' => 'Information Minister calls for the enhancement of state-run media to better communicate national policies.',
                'content' => 'Information Minister Neth Pheaktra called for the enhancement of state-run media outlets—including radio, television, and digital platforms—to better communicate national policies and maintain national security and public order. The strategy aims to implement the Information and Audiovisual Sector Development Strategic Plan 2024-2028, emphasizing a "one voice, one message" approach across all government institutions and ministries.',
                'featured_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/National_Assembly_of_Cambodia.jpg/800px-National_Assembly_of_Cambodia.jpg',
                'published_at' => now()->subDays(4),
                'status' => 'published',
            ],
        ];

        foreach ($posts as $postData) {
            Post::create(array_merge($postData, ['category_id' => $category->id]));
        }

        $this->command->info("Real news posts added successfully!");
    }
}
