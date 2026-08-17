import json
import os

km_file = '/home/rotana/CMS/resources/js/lang/km.json'
en_file = '/home/rotana/CMS/resources/js/lang/en.json'

with open(km_file, 'r', encoding='utf-8') as f:
    km_data = json.load(f)

with open(en_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

# Add navigation keys for KM
km_data.setdefault('nav', {})
km_data['nav'].update({
    "news_events": "ព័ត៌មាន និងព្រឹត្តិការណ៍",
    "national": "ជាតិ",
    "economy": "សេដ្ឋកិច្ច",
    "society": "សង្គម",
    "international": "អន្តរជាតិ",
    "leadership_org": "ថ្នាក់ដឹកនាំ និងរចនាសម្ព័ន្ធ",
    "minister_activity": "សកម្មភាពថ្នាក់ដឹកនាំ",
    "general_departments": "អគ្គនាយកដ្ឋាន",
    "provincial_departments": "មន្ទីររាជធានី-ខេត្ត",
    "legal_documents": "លិខិតបទដ្ឋានគតិយុត្ត",
    "decrees": "ព្រះរាជក្រម/ព្រះរាជក្រឹត្យ",
    "prakas": "ប្រកាស",
    "decisions": "សេចក្តីសម្រេច",
    "circulars": "សារាចរ",
    "media_broadcasting": "ប្រព័ន្ធផ្សព្វផ្សាយ",
    "tvk_live": "ទូរទស្សន៍ជាតិ TVK",
    "national_radio": "វិទ្យុជាតិ RNK",
    "akp_agency": "ទីភ្នាក់ងារសារព័ត៌មាន AKP",
    "photo_galleries": "បណ្ណាល័យរូបភាព",
    "press_room": "ការិយាល័យអ្នកនាំពាក្យ",
    "press_releases": "សេចក្តីប្រកាសព័ត៌មាន",
    "spokesperson_statements": "សេចក្តីថ្លែងការណ៍",
    "clarifications": "សេចក្តីបំភ្លឺ",
    "contact_tipoff": "ទំនាក់ទំនង",
    "public_services": "សេវាសាធារណៈ",
    "press_accreditation": "ចុះបញ្ជីអ្នកសារព័ត៌មាន",
    "breaking_news": "ព័ត៌មានទាន់ហេតុការណ៍",
    "search": "ស្វែងរក"
})

# Add navigation keys for EN
en_data.setdefault('nav', {})
en_data['nav'].update({
    "news_events": "News & Events",
    "national": "National",
    "economy": "Economy",
    "society": "Society",
    "international": "International",
    "leadership_org": "Leadership & Organization",
    "minister_activity": "Minister's Activity",
    "general_departments": "General Departments",
    "provincial_departments": "Provincial Departments",
    "legal_documents": "Legal Documents",
    "decrees": "Royal Decrees",
    "prakas": "Prakas",
    "decisions": "Decisions",
    "circulars": "Circulars",
    "media_broadcasting": "Media & Broadcasting",
    "tvk_live": "TVK Live",
    "national_radio": "National Radio",
    "akp_agency": "AKP Agency",
    "photo_galleries": "Photo Galleries",
    "press_room": "Press Room",
    "press_releases": "Press Releases",
    "spokesperson_statements": "Spokesperson Statements",
    "clarifications": "Clarifications",
    "contact_tipoff": "Contact / Tip-off",
    "public_services": "Public Services",
    "press_accreditation": "Press Accreditation",
    "breaking_news": "Breaking News",
    "search": "Search"
})

with open(km_file, 'w', encoding='utf-8') as f:
    json.dump(km_data, f, ensure_ascii=False, indent=4)

with open(en_file, 'w', encoding='utf-8') as f:
    json.dump(en_data, f, ensure_ascii=False, indent=4)

print("Translation files updated successfully.")
