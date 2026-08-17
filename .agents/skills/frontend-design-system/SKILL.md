---
name: frontend-design-system
description: Enforces modern, cohesive UI/UX standards, design tokens, micro-interactions, and component architecture for the CMS project.
---

# Modern Frontend Design Standard (Vue 3 + Inertia + DaisyUI)

## 1. Golden Rules for UI Generation

- **Never invent ad-hoc colors or spacing:** Strictly use established DaisyUI components and Tailwind/CSS utility tokens.
- **Use the custom GDIB theme:** The project uses a custom `gdib` DaisyUI theme. DO NOT use generic colors. Use `text-primary` (Navy Blue #002B5B), `text-secondary` (Red #E00000), and `text-accent` (Gold #FFD700) to maintain brand consistency.
- **No bland, default styles:** Use DaisyUI components like `<button class="btn btn-primary">` which automatically handle hover, focus, and active states seamlessly.

## 2. Visual Polish Standards

- **Typography:**
    - Clear scale: `text-xs` (meta/labels), `text-sm` (body/inputs), `text-base` (lead), `text-xl/2xl` (headers).
    - Use `tracking-tight` on headings and `leading-relaxed` on body text.
- **Surfaces & Cards:**
    - Use DaisyUI card component: `<div class="card bg-base-100 shadow-xl">...</div>`.
    - Rely on `bg-base-100`, `bg-base-200`, and `bg-base-300` for consistent container and background contrast.
- **Depth & Polish:**
    - Subtle borders over heavy shadows (`border border-base-300`).

## 3. Mandatory UX States

Every Vue component must account for:

1. **Loading State:** Skeleton loaders (`skeleton` class from DaisyUI) or DaisyUI loading spinners (`loading loading-spinner`).
2. **Empty State:** Clean illustration/icon, clear header, short subtext, and a primary CTA button.
3. **Error State:** Inline alert with destructive styling (`alert alert-error`) and a retry action.
