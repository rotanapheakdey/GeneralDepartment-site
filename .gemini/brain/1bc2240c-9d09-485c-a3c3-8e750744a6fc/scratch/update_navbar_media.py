import re

filepath = "/mnt/c/Users/rotana/.gemini/antigravity-ide/brain/1bc2240c-9d09-485c-a3c3-8e750744a6fc/scratch/Navbar.vue"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace Desktop Media Dropdown
content = re.sub(
    r'<!-- 5\. Media & Broadcasting -->\s*<div class="relative group h-full flex items-center">.*?</div>\s*</div>',
    r"""<!-- 5. Media & Broadcasting -->
                    <Link :href="route('media.index')" class="flex items-center h-full hover:text-moi-blue-50 transition border-b-2" :class="[$page.url.startsWith('/media') ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                        <span>{{ $t("nav.media_broadcasting") }}</span>
                    </Link>""",
    content,
    flags=re.DOTALL
)

# Replace Mobile Media Dropdown
content = re.sub(
    r'<!-- Mobile: Media -->\s*<div>\s*<button @click="toggleMobileDropdown\(\'media\'\).*?</div>\s*</div>',
    r"""<!-- Mobile: Media -->
            <Link :href="route('media.index')" class="block py-3 px-2 rounded-lg hover:bg-white/5">{{ $t("nav.media_broadcasting") }}</Link>""",
    content,
    flags=re.DOTALL
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Navbar.vue updated successfully for Media.")
