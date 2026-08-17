import re

filepath = "/mnt/c/Users/rotana/.gemini/antigravity-ide/brain/1bc2240c-9d09-485c-a3c3-8e750744a6fc/scratch/Footer.vue"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace zinc with slate for standard typography
content = re.sub(r'text-zinc-(\d+)', r'text-moi-slate-\1', content)
content = re.sub(r'border-zinc-(\d+)', r'border-moi-slate-\1', content)

# Dark backgrounds inside the navy container (like the email input, social buttons)
# bg-zinc-900 -> bg-moi-blue (so it stands out on the navy)
content = re.sub(r'bg-zinc-900', r'bg-moi-blue', content)
content = re.sub(r'bg-zinc-800', r'bg-moi-blue-hover', content)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Updated Footer.vue zincs")
