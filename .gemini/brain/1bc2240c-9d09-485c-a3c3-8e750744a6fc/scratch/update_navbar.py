import re

filepath = "/mnt/c/Users/rotana/.gemini/antigravity-ide/brain/1bc2240c-9d09-485c-a3c3-8e750744a6fc/scratch/Navbar.vue"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace Desktop News Dropdown
content = re.sub(
    r'<!-- 2\. News & Events -->\s*<div class="relative group h-full flex items-center">.*?</div>\s*</div>',
    r"""<!-- 2. News & Events -->
                    <Link :href="route('news.index')" class="flex items-center h-full hover:text-moi-blue-50 transition border-b-2" :class="[$page.url.startsWith('/news') ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                        <span>{{ $t("nav.news_events") }}</span>
                    </Link>""",
    content,
    flags=re.DOTALL
)

# Remove Desktop Press Room
content = re.sub(
    r'<!-- 6\. Press Room -->\s*<div class="relative group h-full flex items-center">.*?</div>\s*</div>',
    '',
    content,
    flags=re.DOTALL
)

# Replace Mobile News Dropdown
content = re.sub(
    r'<!-- Mobile: News & Events -->\s*<div>\s*<button @click="toggleMobileDropdown\(\'news\'\).*?</div>\s*</div>',
    r"""<!-- Mobile: News & Events -->
            <Link :href="route('news.index')" class="block py-3 px-2 rounded-lg hover:bg-white/5">{{ $t("nav.news_events") }}</Link>""",
    content,
    flags=re.DOTALL
)

# Remove Mobile Press Room
content = re.sub(
    r'<!-- Mobile: Press Room -->\s*<div>\s*<button @click="toggleMobileDropdown\(\'press\'\).*?</div>\s*</div>',
    '',
    content,
    flags=re.DOTALL
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Navbar.vue updated successfully.")
