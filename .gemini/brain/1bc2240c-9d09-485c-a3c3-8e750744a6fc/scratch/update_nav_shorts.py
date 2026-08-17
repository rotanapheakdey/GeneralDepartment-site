import json
import os

km_file = '/home/rotana/CMS/resources/js/lang/km.json'
en_file = '/home/rotana/CMS/resources/js/lang/en.json'

with open(km_file, 'r', encoding='utf-8') as f:
    km_data = json.load(f)

with open(en_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

# Update EN
en_data['nav']['legal_documents'] = "Documents"
en_data['nav']['media_broadcasting'] = "Media"
en_data['nav']['leadership_org'] = "About the Ministry"

# Update KM
km_data['nav']['legal_documents'] = "ឯកសារ"
km_data['nav']['media_broadcasting'] = "ផ្សព្វផ្សាយ"
km_data['nav']['leadership_org'] = "អំពីក្រសួង"

with open(km_file, 'w', encoding='utf-8') as f:
    json.dump(km_data, f, ensure_ascii=False, indent=4)

with open(en_file, 'w', encoding='utf-8') as f:
    json.dump(en_data, f, ensure_ascii=False, indent=4)

print("Translations updated successfully.")
