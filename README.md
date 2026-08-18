# 🇰🇭 MoINFO (Ministry of Information) - Digital Newsroom & Ministerial Portal

A modernized, high-performance Content Management System (CMS) and bilingual public information portal for the **Ministry of Information (MoINFO)**, Cambodia. This platform is redesigned to meet international newsroom and government portal standards (e.g., BBC, GOV.UK) with full Khmer (`ភាសាខ្មែរ`) and English (`EN`) localization.

---

## 📋 Table of Contents
1. [🎨 Design System & Brand Identity](#-design-system--brand-identity)
2. [🌟 Key Features & Redesigns](#-key-features--redesigns)
3. [🛠 Technical Architecture & Stack](#-technical-architecture--stack)
4. [🚀 Developer Quick Start](#-developer-quick-start)
5. [🔄 Multi-PC Git Sync Helper](#-multi-pc-git-sync-helper)
6. [🏛 Presentation & Walkthrough Guide](#-presentation--walkthrough-guide)

---

## 🎨 Design System & Brand Identity

The portal follows the official **MoINFO Design System** to deliver a premium, authoritative, and clean user experience.

| Element | Specification | Value / Hex |
| :--- | :--- | :--- |
| **Primary Color** | Royal Blue | `#0B3C95` |
| **Accent Color** | Crimson Red | `#D91A2A` |
| **Dark Accents** | Navy Slate | `#0F172A` |
| **Khmer Typography** | Kantumruy Pro, Siemreap | Legible, high-hierarchy Khmer |
| **English Typography** | Outfit, Inter | Modern sans-serif |

*Design elements like buttons, borders, and cards utilize subtle micro-animations and rounded edges (`rounded-2xl`) for a premium modern feel.*

---

## 🌟 Key Features & Redesigns

### 1. 2-Tier Modular Navigation
* **Tier 1 (Utility Bar):** Real-time localized date, a **live breaking news marquee ticker**, language selector (KM/EN), and quick government action buttons.
* **Tier 2 (Main Navbar):** Sticky navy navbar housing a streamlined mega-menu for desktop and an intuitive, fluid accordion menu for mobile.

### 2. Dynamic Media & Broadcasting Hub (`/media`)
* Replaced bloated media pages with a single dynamic hub.
* Admins can manage TV channels, radio networks, and photo galleries directly in the admin panel.
* Dynamic card layout displays uploadable SVG/PNG logos (managed via Spatie Media Library) and handles fallbacks gracefully.

### 3. Fully Localized Khmer / English Core
* Implemented clean multi-language routing.
* Language strings are managed via `resources/js/lang/km.json` and `en.json` for easy translation updates.

### 4. Modern Contact Hub (`/contact`)
* Clean modern layout with a responsive two-column grid.
* Left column contains verified Ministry details (No. 62 Preah Monivong Blvd, Phnom Penh, hotline `+855 (0)23 724 159`, official email, and office hours) backed by an interactive **Google Map**.
* Right column features a modern contact form matching official UX standards.

---

## 🛠 Technical Architecture & Stack

The portal utilizes a hybrid single-page application structure for maximum SEO capability and speed.

* **Backend Framework:** Laravel 12.x
* **Admin Dashboard:** Filament PHP v3 (managing News, Documents, Media Links, Settings, and Users)
* **Frontend UI:** Vue.js 3 (Composition API) with Inertia.js (Single-Page App routing)
* **CSS & Tailwind:** Tailwind CSS & DaisyUI v5 (custom variables mapped to MoINFO colors)
* **Database:** MySQL 8.0+
* **Environment:** Laravel Sail (Docker)

---

## 🚀 Developer Quick Start

### Prerequisites
* Docker & Docker Compose
* WSL 2 (for Windows developers)
* Node.js v20+ & npm

### Setup Instructions

1. **Clone the repository and enter the directory:**
   ```bash
   git clone <repository-url>
   cd CMS
   ```

2. **Boot the environment (Laravel Sail):**
   ```bash
   ./vendor/bin/sail up -d
   ```

3. **Install dependencies:**
   ```bash
   ./vendor/bin/sail composer install
   ./vendor/bin/sail npm install
   ```

4. **Prepare the database:**
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

5. **Build and watch assets:**
   ```bash
   # Development hot-reload
   ./vendor/bin/sail npm run dev

   # Production build
   ./vendor/bin/sail npm run build
   ```

---

## 🔄 Multi-PC Git Sync Helper

To support developers working across multiple machines, a Git-based synchronization helper is included. The script links your global Antigravity brain directory with this repository so you can commit your active chats and continue on a different PC.

### How to Sync:
1. **Push your work:** Commit and push the `.gemini/` folder and your changes on PC 1.
2. **Pull on PC 2:** Do a standard `git pull` on your other computer.
3. **Execute link script:**
   * Close Antigravity IDE.
   * Right-click **`setup_git_brain_sync.bat`** in the repository root and select **"Run as administrator"**.
   * Reopen the IDE—your chat state, memory, and history will be loaded!

---

## 🏛 Presentation & Walkthrough Guide

Use these points to highlight your work during reviews or presentations:

### 💡 High-Velocity News vs. Official Portal
Demonstrate how the **2-Tier Navbar** successfully keeps high-velocity widgets (the news ticker and public alerts) inside the utility bar, freeing up the primary navigation for ministerial structure and official legal documents.

### ⚙️ The Power of Filament Integration
Log into the admin panel (`/admin`) and show how easy it is to manage the external **Media & Broadcasting** grid dynamically. Upload a new channel logo, set the order weight, toggle the active switch, and instantly see the `/media` page update in real-time.

### 🌐 Dual-Language Fidelity
Demonstrate the fluid toggle between Khmer and English on the navigation bar and Contact page. Note how the Khmer typography seamlessly matches the official governmental branding while maintaining high legibility.
