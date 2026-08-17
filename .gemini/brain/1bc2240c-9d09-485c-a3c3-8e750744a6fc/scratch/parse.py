import json
import uuid
import re
from datetime import datetime

try:
    with open('/home/rotana/CMS/temp_news.json', 'r', encoding='utf-8') as f:
        data = json.load(f)
    
    if not isinstance(data, list):
        print('Error: API did not return a list of posts.')
        exit(1)
        
    records = []
    for post in data:
        title = post.get('title', {}).get('rendered', 'Untitled')
        
        # Clean HTML from title
        title = re.sub('<[^<]+>', '', title).replace('&#8211;', '-').replace('&#8217;', "'").strip()
        
        content = post.get('content', {}).get('rendered', '')
        
        excerpt_html = post.get('excerpt', {}).get('rendered', '')
        excerpt = re.sub('<[^<]+>', '', excerpt_html).replace('&#8211;', '-').replace('&#8217;', "'").replace('[&hellip;]', '...').strip()
        
        featured_image = ''
        yoast = post.get('yoast_head_json', {})
        og_images = yoast.get('og_image', [])
        if og_images and len(og_images) > 0:
            featured_image = og_images[0].get('url', '')
            
        if not featured_image:
            img_match = re.search(r'src="([^"]+)"', content)
            if img_match:
                featured_image = img_match.group(1)
                
        if not featured_image:
            featured_image = 'https://www.khmertimeskh.com/wp-content/uploads/2021/05/KHMER-TIMES.jpg'
            
        published_at = post.get('date', datetime.now().strftime('%Y-%m-%dT%H:%M:%S'))
        published_at = published_at.replace('T', ' ')
        
        record = {
            'id': str(uuid.uuid4()),
            'category_id': str(uuid.uuid4()), # Placeholder
            'title': title,
            'content': content,
            'excerpt': excerpt,
            'featured_image': featured_image,
            'published_at': published_at,
            'status': 'published'
        }
        records.append(record)
        
    with open('/home/rotana/CMS/database_records.json', 'w', encoding='utf-8') as out:
        json.dump(records, out, indent=4, ensure_ascii=False)
        
    print(f'Successfully processed {len(records)} records.')
except Exception as e:
    print(f'Error: {e}')
