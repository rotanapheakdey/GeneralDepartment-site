import json
import os

km_file = '/home/rotana/CMS/resources/js/lang/km.json'
en_file = '/home/rotana/CMS/resources/js/lang/en.json'

with open(km_file, 'r', encoding='utf-8') as f:
    km_data = json.load(f)

with open(en_file, 'r', encoding='utf-8') as f:
    en_data = json.load(f)

# Update EN
en_data['nav']['contact_tipoff'] = "Contact"

# Update KM (already "ទំនាក់ទំនង" but let's make sure it's exactly that)
km_data['nav']['contact_tipoff'] = "ទំនាក់ទំនង"

with open(km_file, 'w', encoding='utf-8') as f:
    json.dump(km_data, f, ensure_ascii=False, indent=4)

with open(en_file, 'w', encoding='utf-8') as f:
    json.dump(en_data, f, ensure_ascii=False, indent=4)

print("Translations updated successfully.")
