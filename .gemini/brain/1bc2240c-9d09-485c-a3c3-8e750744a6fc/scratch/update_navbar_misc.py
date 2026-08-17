import re

filepath = "/mnt/c/Users/rotana/.gemini/antigravity-ide/brain/1bc2240c-9d09-485c-a3c3-8e750744a6fc/scratch/Navbar.vue"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Remove Home Icon
content = re.sub(
    r'<svg class="w-4 h-4 mr-1 mb-0\.5".*?</svg>\s*<span class="hidden xl:inline">{{ \$t\("nav\.home"\) }}</span>',
    r'<span class="hidden xl:inline">{{ $t("nav.home") }}</span>',
    content
)

# Update Press Accreditation Link
content = content.replace(
    '''<Link :href="route('contact')" class="hover:text-white transition">{{ $t('nav.press_accreditation') }}</Link>''',
    '''<a href="https://media.inb.gov.kh/" target="_blank" class="hover:text-white transition">{{ $t('nav.press_accreditation') }}</a>'''
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Navbar.vue updated successfully for home icon and press accreditation.")
