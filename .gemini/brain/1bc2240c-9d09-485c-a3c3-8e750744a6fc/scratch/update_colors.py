import os
import re

directory = "/home/rotana/CMS/resources/js"

# Color mappings based on the new MoINFO design system
replacements = {
    # Replace the old deep blue and its variants
    r'#002B5B': 'moi-navy',  # Often used in classes like bg-[#002B5B], text-[#002B5B]
    r'bg-\[\#002B5B\]': 'bg-moi-navy',
    r'text-\[\#002B5B\]': 'text-moi-navy',
    r'border-\[\#002B5B\]': 'border-moi-navy',
    
    # Replace the old gold/yellow and its variants
    r'#FFD700': 'white', # Or moi-blue-50 depending on context, but white is safer
    r'text-\[\#FFD700\]': 'text-white',
    r'hover:text-\[\#FFD700\]': 'hover:text-moi-blue-50',
    r'border-\[\#FFD700\]': 'border-moi-blue-hover',
    r'bg-\[\#FFD700\]': 'bg-moi-blue',
    
    # Replace the old red
    r'#E00000': 'moi-red',
    r'bg-\[\#E00000\]': 'bg-moi-red',
    r'text-\[\#E00000\]': 'text-moi-red',
    
    # Replace the old gold/bronze
    r'#D4AF37': 'moi-blue-hover',
    r'border-\[\#D4AF37\]': 'border-moi-blue-hover',
    r'bg-\[\#D4AF37\]': 'bg-moi-blue-hover',
}

# Advanced component specific rules
# Navbar.vue: 
# bg-[#002B5B]/90 -> bg-moi-navy/95
# border-b-4 border-[#FFD700] -> border-b border-white/10 shadow-sm

for root, _, files in os.walk(directory):
    for file in files:
        if file.endswith(('.vue', '.js', '.json')):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            new_content = content
            
            # Navbar specifics
            if file == 'Navbar.vue':
                new_content = new_content.replace('bg-[#002B5B]/90', 'bg-moi-navy/95')
                new_content = new_content.replace('border-b-4 border-[#FFD700]', 'border-b border-white/10 shadow-sm')
                new_content = new_content.replace('text-[#FFD700]', 'text-moi-blue-50')
                new_content = new_content.replace('border-[#FFD700]', 'border-moi-blue-50')
                new_content = new_content.replace('bg-[#FFD700]', 'bg-moi-blue-50')
                new_content = new_content.replace('text-[#002B5B]', 'text-moi-navy')
                new_content = new_content.replace('bg-[#002B5B]', 'bg-moi-navy')
            else:
                for old, new in replacements.items():
                    new_content = re.sub(old, new, new_content)
            
            if new_content != content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f"Updated {filepath}")
