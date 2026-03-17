# GDIB Public Information Portal

A modern **content management and public information portal** built with Laravel and Vue.  
This system provides a bilingual platform for publishing government news, official documents, and public announcements.

Developed as part of a **Web Development Frameworks Assignment (March 2026)**.

---

# 👥 Group Members

- **Rotana Pheakdey (ភក្តី រតនា)**
- **KEO Chournsocheat (កែវ ជួនសុជាតិ)**
- **Khom Socheat (ខុម សុជាត)**

---

# 🏗️ System Architecture

This project follows a **Modular Component-Driven Architecture**.

Navigation and footer components are separated from the main layout to improve maintainability and enforce the **DRY (Don't Repeat Yourself)** principle.

The system is structured as a **monolithic SPA using Laravel + Inertia + Vue**, combining backend and frontend into a seamless application.

---

# ⚙️ Tech Stack

### Backend
- Laravel 11
- Filament PHP v3
- Spatie Media Library
- Laravel Sail (Docker)

### Frontend
- Vue.js 3 (Composition API)
- Inertia.js

### UI & Styling
- Tailwind CSS
- daisyUI (Custom theme)

### Routing
- Ziggy Vue (Laravel named routes inside Vue)

### Internationalization
- vue-i18n with persistent locale storage

---

# 🧩 Core Components

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

# 🌟 Key Features

### 🌐 Bilingual Interface
- Khmer and English support
- Flag-based language toggle
- Persistent locale storage
- Script-optimized fonts
- Proper text direction handling
- Seamless content switching 

### 🎨 Premium UI / UX
- Custom-designed news cards
- Glassmorphism badges
- Hover-lift transitions
- Card-style data tables

### 📰 Dynamic News Engine
- Full CRUD functionality
- Featured image upload
- Media management via **Spatie Media Library**

### 📄 Document Repository
- Organized storage for official **Prakas** and PDF documents
- Public document downloads

### 🔐 Security

**Slugless UUID Routing:**  
Public routes use UUIDs exclusively for lookups (for example `/news/{uuid}`).  
This enhances security by preventing ID enumeration and simplifies the content workflow by removing the need for manual slug management.

---

# 🛠️ Installation & Setup (Laravel Sail / Docker)

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/GDIB-Portal.git
cd GDIB-Portal
```

---

### 2. Start Docker Environment

```bash
./vendor/bin/sail up -d
```

---

### 3. Install Dependencies

```bash
sail composer install
sail npm install
```

---

### 4. Application Setup

```bash
sail artisan key:generate
sail artisan migrate --seed
sail artisan storage:link
sail artisan route:clear
```

---

### 5. Compile Frontend Assets

```bash
sail npm run dev
```

---

# ⚡ Developer Quick-Start

If you need to **reset the entire project and reseed the database**, run the following command:

```bash
# Full Reset & Seed (The "Fresh Start" Command)
sail artisan migrate:fresh --seed && sail artisan storage:link && sail artisan route:clear
```

This command will:

- Reset the database
- Reseed all data
- Re-link storage
- Clear cached routes

---

# 🌐 Application Routes

| Service | URL |
|------|------|
| Public Portal | http://localhost |
| Admin Dashboard | http://localhost/admin |

---

# 📌 Development Notes

The project emphasizes:

- Clean component-based architecture
- Reusable Vue components
- Modern Laravel development practices
- Government-style UI presentation
- Maintainable modular design

---

## 🧠 Technical Challenges & Solutions

### 1. Framework Integration Conflicts

**The Problem:**  
Conflict between **Preline UI** and **daisyUI** caused Vite compilation errors and layout shifts.

**The Solution:**  
Removed the Preline dependency and its JavaScript imports to allow **daisyUI (built on pure Tailwind)** to handle the component logic cleanly.

---

### 2. Environment Synchronization (Docker)

**The Problem:**  
Running Laravel commands inside a **Dockerized environment (Sail)** versus the local host machine.

**The Source of Confusion:**  
Errors occurred when running `php artisan` directly instead of `./vendor/bin/sail artisan`.

**The Solution:**  
Established a consistent workflow using the **Sail wrapper** for all CLI operations to ensure the database and PHP versions matched the container environment.

---

### 3. Data Type Mismatch (Date Casting)

**The Problem:**  
The `Call to a member function format() on string` error.

**The Technical Cause:**  
Database timestamps are returned as **strings by default in Eloquent**.

**The Solution:**  
Implemented **Attribute Casting** in the `Post` model:

```php
protected $casts = [
    'published_at' => 'datetime',
];
```

---

# 🏛️ Architectural Decisions (March 2026)

- Decoupled **slugs** from the `posts` and `categories` tables to streamline the database schema.
- Implemented `getRouteKeyName()` in Laravel Models to ensure seamless **Route Model Binding with UUIDs**.
- Configured **Spatie Media Library fallbacks** to support both seeded dummy images and uploaded production media.

---

# 📄 License

This project was created for **academic and demonstration purposes**.
