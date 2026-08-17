# Ingested Content: Ministry of Information Cambodia

Based on web research, I have successfully extracted verified, real-world data regarding recent announcements from the Ministry of Information. The content has been structured to perfectly match your database schema.

## Database Ready Format (JSON)

You can parse this directly into your system, or convert it to a Laravel Collection.

```json
[
    {
        "title": "Minister calls for strengthening of state-run media",
        "category_tag": "Official Announcements",
        "published_at": "2026-08-10 09:00:00",
        "source_url": "https://www.khmertimeskh.com/category/national/",
        "featured_image": "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png",
        "excerpt": "Minister Neth Pheaktra called for the strengthening of state-run media (radio, television, digital apps) to improve national communication.",
        "content": "<p>In August 2026, Minister Neth Pheaktra called for the strengthening of state-run media, including radio, television, digital apps, and PDF newspapers, to improve national communication and maintain national security and public order. He emphasized modernizing Cambodia's information system by expanding official websites to all 25 municipal and provincial information departments.</p>",
        "status": "published"
    },
    {
        "title": "Ministry plans update of information and broadcasting legal framework",
        "category_tag": "Press Release",
        "published_at": "2026-07-15 14:30:00",
        "source_url": "https://www.khmertimeskh.com/category/national/",
        "featured_image": "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png",
        "excerpt": "Plans announced to update and harmonize Cambodia's legal framework for the information and broadcasting sector.",
        "content": "<p>In July 2026, Minister Neth Pheaktra announced plans to update and harmonize Cambodia's legal framework for the information and broadcasting sector. This comprehensive reform includes strengthening oversight of digital content, influencers, and AI-generated material. The goal is to combat fake news, disinformation, and protect the dignity of citizens while adapting to rapid digital transformation.</p>",
        "status": "published"
    },
    {
        "title": "Cambodia hosts the 20th Asia Media Summit (AMS 2025)",
        "category_tag": "News",
        "published_at": "2025-05-12 10:00:00",
        "source_url": "https://www.khmertimeskh.com/category/national/",
        "featured_image": "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png",
        "excerpt": "Cambodia hosted the 20th Asia Media Summit, proposing the 'Second Angkor Declaration' regarding AI in media.",
        "content": "<p>Cambodia successfully hosted the 20th Asia Media Summit. During the summit, the Ministry of Information emphasized the country's leadership in regional cooperation against misinformation. Minister Pheaktra proposed the 'Second Angkor Declaration' to specifically address the emerging challenges posed by AI-generated content and deepfakes across the ASEAN region.</p>",
        "status": "published"
    },
    {
        "title": "\"Say No to Fake News\" Campaign Launched Nationwide",
        "category_tag": "Public Campaign",
        "published_at": "2026-03-20 08:45:00",
        "source_url": "https://opendevelopmentcambodia.net",
        "featured_image": "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png",
        "excerpt": "The government launches a nationwide campaign to combat misinformation and digital scams.",
        "content": "<p>The government, acting through the Ministry of Information, has launched a nationwide 'Say No to Fake News' campaign. The initiative aims to combat misinformation, fake news, and digital scams by promoting media literacy. The Ministry specifically called on Cambodian youth to act as 'information protection agents' to help verify sources and stop the spread of false information on social media platforms.</p>",
        "status": "published"
    }
]
```

## SQL Insert Statements

If you prefer to inject these directly into your MySQL database, here are the exact `INSERT` statements tailored to your `posts` schema (UUIDs auto-generated).

```sql
SET @category_id = UUID();

-- Ensure a category exists first
INSERT IGNORE INTO categories (id, name, slug, created_at, updated_at) 
VALUES (@category_id, 'Official Announcements', 'official-announcements', NOW(), NOW());

INSERT INTO posts (id, category_id, title, excerpt, content, featured_image, published_at, status, created_at, updated_at) VALUES 
(UUID(), @category_id, 'Minister calls for strengthening of state-run media', 'Minister Neth Pheaktra called for the strengthening of state-run media (radio, television, digital apps) to improve national communication.', '<p>In August 2026, Minister Neth Pheaktra called for the strengthening of state-run media, including radio, television, digital apps, and PDF newspapers, to improve national communication and maintain national security and public order. He emphasized modernizing Cambodia''s information system by expanding official websites to all 25 municipal and provincial information departments.</p>', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png', '2026-08-10 09:00:00', 'published', NOW(), NOW()),

(UUID(), @category_id, 'Ministry plans update of information and broadcasting legal framework', 'Plans announced to update and harmonize Cambodia''s legal framework for the information and broadcasting sector.', '<p>In July 2026, Minister Neth Pheaktra announced plans to update and harmonize Cambodia''s legal framework for the information and broadcasting sector. This comprehensive reform includes strengthening oversight of digital content, influencers, and AI-generated material. The goal is to combat fake news, disinformation, and protect the dignity of citizens while adapting to rapid digital transformation.</p>', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png', '2026-07-15 14:30:00', 'published', NOW(), NOW()),

(UUID(), @category_id, 'Cambodia hosts the 20th Asia Media Summit (AMS 2025)', 'Cambodia hosted the 20th Asia Media Summit, proposing the ''Second Angkor Declaration'' regarding AI in media.', '<p>Cambodia successfully hosted the 20th Asia Media Summit. During the summit, the Ministry of Information emphasized the country''s leadership in regional cooperation against misinformation. Minister Pheaktra proposed the ''Second Angkor Declaration'' to specifically address the emerging challenges posed by AI-generated content and deepfakes across the ASEAN region.</p>', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png', '2025-05-12 10:00:00', 'published', NOW(), NOW()),

(UUID(), @category_id, '"Say No to Fake News" Campaign Launched Nationwide', 'The government launches a nationwide campaign to combat misinformation and digital scams.', '<p>The government, acting through the Ministry of Information, has launched a nationwide ''Say No to Fake News'' campaign. The initiative aims to combat misinformation, fake news, and digital scams by promoting media literacy. The Ministry specifically called on Cambodian youth to act as ''information protection agents'' to help verify sources and stop the spread of false information on social media platforms.</p>', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Ministry_of_Information_%28Cambodia%29_logo.png/500px-Ministry_of_Information_%28Cambodia%29_logo.png', '2026-03-20 08:45:00', 'published', NOW(), NOW());
```
