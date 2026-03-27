# 🇰🇭 GDIB Public Information Portal

A modern **Content Management System (CMS)** and public information platform developed for the **General Department of Information and Broadcasting (GDIB)**.

This project delivers a **bilingual (Khmer / English)** digital solution for publishing:

* Government news
* Official documents (*Prakas*)
* Public announcements

Built with a focus on **performance, usability, and maintainability**, the system reflects real-world government portal requirements while demonstrating full-stack development capability.

**Project Type:** Academic Assignment (March 2026)
**Status:** Actively Developed

---

## 👥 Development Team

* **Rotana Pheakdey (ភក្តី រតនា)** — Lead Developer / Backend Architect
* **KEO Chournsocheat (កែវ ជួនសុជាតិ)** — Frontend / UI Designer
* **Khom Socheat (ខុម សុជាត)** — QA / Documentation

---

## ⚙️ Tech Stack

| Layer        | Technology                                        |
| ------------ | ------------------------------------------------- |
| Backend      | Laravel 11, Filament PHP v3, Spatie Media Library |
| Frontend     | Vue.js 3 (Composition API), Inertia.js, Ziggy     |
| Styling      | Tailwind CSS, daisyUI (Custom Theme)              |
| Environment  | Laravel Sail (Docker)                             |
| Localization | vue-i18n (Persistent Locale)                      |

---

## 🏗️ Architecture & Design

This project follows a **Monolithic SPA architecture using Inertia.js**, allowing seamless integration between Laravel and Vue.js while maintaining a single codebase.

### Key Highlights

* **Single-Page Application (SPA) Experience**
  Fast navigation without full page reloads using Inertia.js

* **Reusable Layout System**
  `GovLayout.vue` centralizes layout structure (Navbar + Footer)
  → Enforces DRY principle and clean separation of concerns

* **Secure Routing Strategy**
  UUID-based routing:

  ```
  /news/{uuid}
  ```

  * Prevents ID enumeration
  * Removes dependency on slugs
  * Improves security and scalability

* **Component-Based UI**
  Modular Vue components ensure maintainability and scalability

---

## ✅ Core Features

* **Bilingual System**

  * Khmer / English toggle
  * Persistent language preference (local storage)

* **News Management System**

  * Full CRUD operations
  * Image upload & processing via Spatie Media Library

* **Admin Dashboard**

  * Built with Filament PHP
  * Clean and structured content management interface

* **Document Repository**

  * Organized storage of official PDFs (*Prakas*)
  * Easy public access and download

* **Modern UI/UX**

  * Glassmorphism-inspired design
  * Fully responsive layout
  * Built with Tailwind + daisyUI

---

## 🧠 Technical Challenges & Solutions

### 1. Environment Synchronization (Seeding)

**Problem:**
Data inconsistencies between development environments after pulling from Git.

**Solution:**

* Standardized `SettingSeeder`
* Enforced consistent workflow:

```bash
php artisan db:seed
```

→ Ensures database state matches codebase across all machines

---

### 2. UI Framework Conflict

**Problem:**
Preline UI conflicted with daisyUI, causing build errors and styling issues.

**Solution:**

* Removed Preline dependency
* Standardized UI using Tailwind + daisyUI
  → Improved stability and consistency

---

### 3. Eloquent Date Casting Issue

**Problem:**

```
Call to a member function format() on string
```

**Solution:**
Explicit casting in model:

```php
protected $casts = [
    'created_at' => 'datetime',
];
```

→ Ensures proper handling of date objects

---

## 🛠️ Installation & Setup

```bash
# 1. Clone repository
git clone https://github.com/rotanapheakdey/CMS.git
cd CMS

# 2. Start Docker environment
./vendor/bin/sail up -d

# 3. Install dependencies
sail composer install
sail npm install
sail npm run dev

# 4. Setup application
sail artisan migrate --seed
sail artisan storage:link
```

---

## 📌 Development Workflow

To avoid environment inconsistencies:

* Always run after pulling:

```bash
sail artisan db:seed
```

* Keep seeders updated when adding system configurations
* Do not manually modify critical config records in database

---

## 🎯 Project Value

This project demonstrates:

* Full-stack development with **Laravel + Vue (Inertia)**
* Real-world **CMS architecture and design patterns**
* Secure and scalable routing strategies
* Clean UI/UX implementation using modern tools
* Team collaboration with structured workflows

---

## 🏛️ Academic & Institutional Context

Developed as part of an academic assignment aligned with **government-level system design standards**.

The project emphasizes:

* Clean architecture
* Maintainable code practices
* Real-world applicability in public sector systems
