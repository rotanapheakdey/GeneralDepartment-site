# GDIB Public Information Portal

A modern **content management and public information portal** built with Laravel and Vue.  
This system provides a bilingual platform for publishing government news, official documents, and public announcements.

Designed and developed by **Rotana Pheakdey (ភក្តី រតនា)**.

---

## 🧑‍💻 Project Information

| Field | Details |
|------|--------|
| Project Name | GDIB Content Management System |
| Lead Developer | Rotana Pheakdey (ភក្តី រតនា) |
| Role | Full-stack System Engineer |
| Academic Context | Web Development Frameworks Assignment |
| Date | March 2026 |

---

## 🏗️ System Architecture

This project follows a **Modular Component-Driven Architecture**.

Navigation and footer components are separated from the main layout to improve maintainability and enforce the **DRY (Don't Repeat Yourself)** principle.

The system is structured as a **monolithic SPA using Laravel + Inertia + Vue**, combining backend and frontend into a seamless application.

---

## ⚙️ Tech Stack

### Backend
- Laravel 11
- Filament PHP v3 (Admin CMS)
- Laravel Sail (Docker)

### Frontend
- Vue.js 3
- Inertia.js

### UI & Styling
- Tailwind CSS
- daisyUI (Custom theme)

### Additional Tools
- vue-i18n for internationalization
- Spatie Media Library for image and file management
- UUID routing for enhanced security

---

## 🧩 Core Components

### `GovLayout.vue`
The main layout shell responsible for structuring:
- Navigation
- Page content
- Footer

### `Navbar.vue`
Centralized navigation logic featuring:
- 🇰🇭 Khmer / 🇺🇸 English language switcher
- Sticky navigation bar
- Dynamic active-route highlighting

### `Footer.vue`
Decoupled footer containing:
- Organizational credits
- Developer attribution
- Branding

---

## 🌟 Key Features

### 🌐 Bilingual Interface
- Khmer and English support
- Flag-based language toggle
- Persistent locale storage
- Script-optimized fonts

### 🎨 Premium UI / UX
- Custom-designed news cards
- Glassmorphism badges
- Hover-lift transitions
- Card-style data tables

### 📰 Dynamic News Engine
- Full CRUD functionality
- Featured image support
- Media management via Spatie Media Library

### 📄 Document Repository
- Organized storage for official **Prakas** and PDF documents
- Public document downloads

### 🔐 Security
- Public routes use **UUIDs** to prevent ID enumeration attacks

---

## 🛠️ Installation & Setup (Laravel Sail / Docker)

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/GDIB-Portal.git
cd GDIB-Portal

2.  **Start the environment (Sail/Docker):**
    ```bash
    ./vendor/bin/sail up -d
    ```

3.  **Install dependencies:**
    ```bash
    sail npm install
    sail composer install
    ```

4.  **Application Setup**
    ```bash
    sail artisan key:generate
    sail artisan migrate --seed
    sail artisan storage:link
    ```

5.  **Compile Assets:**
    ```bash
    sail npm run dev
    ```

## 🌐 Routes
* **Public Portal:** `http://localhost/`
* **Admin Dashboard:** `http://localhost/admin`

---
*Developed for General Department of Information and Broadcasting.*
