---
name: moinfo-design-system
description: Enforces official Ministry of Information (MoINFO) brand theme, white-dominant UI palette, Khmer/English typography, and modern news layout standards.
---

# Ministry of Information (MoINFO) Design System & Theme Standards

## 1. Brand Color System (60-30-10 Rule)

- **Dominant Clean Background & Surfaces (~60%):**
    - App Background: `#FFFFFF` (Pure White)
    - Card/Container Surface: `#F8FAFC` (Slate-50) or `#FFFFFF`
    - Borders: `#E2E8F0` (Slate-200) or `#CBD5E1` (Slate-300)
    - Primary Text: `#0F172A` (Slate-900 / Deep Charcoal)
    - Muted Meta Text: `#64748B` (Slate-500)

- **Brand Primary Blue (~30%):**
    - Official Royal Blue: `#0B3C95`
    - Deep Navy (Navbars / Footers / Dark Accents): `#082866`
    - Hover / Interactive Blue: `#1D4ED8`
    - Soft Tint (Pills / Highlights): `#EFF6FF` (Blue-50)

- **Accent Crimson Red (~10% - Use Sparingly for Urgency):**
    - Official Accent Red: `#D91A2A`
    - Use Cases: Breaking news badges, live broadcast tags, urgent alerts, active tab indicators.

---

## 2. Bilingual & Typography Guidelines

- **Khmer Font Stack:** `Kantumruy Pro`, `Siemreap`, or `Koh Santepheap` with `Inter` / `sans-serif` as Latin fallbacks.
- **Line Heights:** Always use a minimum line height of `1.6` - `1.8` (`leading-relaxed`) to prevent clipping subscript vowels and sub-consonant clusters (ជើង).
- **Localization:** Never hardcode raw strings. Use centralized translation keys (`lang/km/` and `lang/en/`).

---

## 3. UI Component Patterns

- **Cards:** `bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow`
- **Primary Buttons:** `bg-[#0B3C95] hover:bg-[#1D4ED8] text-white rounded-lg px-4 py-2 font-medium transition-colors`
- **Breaking News Badges:** `bg-[#D91A2A] text-white text-xs font-semibold px-2.5 py-1 rounded-full uppercase tracking-wide`
- **Empty & Loading States:** Always provide skeleton loaders (`animate-pulse`) and empty-state placeholders.
