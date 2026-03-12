# GDIB Content Management System (CMS)

Official Information and Document Management Portal for the **General Department of Identification (GDIB)**.

## 🚀 Project Overview
This is a high-performance, secure CMS built to manage public news and official government documents. It features a private administrative dashboard for editors and a public-facing portal for citizens.

### 🛠 Technology Stack
* **Framework:** Laravel 11
* **Admin Panel:** Filament PHP v3
* **Frontend:** Vue 3 & Inertia.js
* **Styling:** Tailwind CSS & daisyUI
* **Infrastructure:** Laravel Sail (Docker)
* **Database:** MySQL (UUID-based records)

## ✨ Key Features
* **News Management:** Full CRUD with Spatie Media Library for featured images.
* **Document Library:** Publicly accessible archive for Prakas and official PDF notifications.
* **Secure Administration:** Role-based access control via Filament.
* **Modern UI:** Responsive design following government branding standards.
* **UUIDs:** Enhanced security with non-sequential identifiers.

## 🛠 Installation & Setup

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/cms-gdib.git](https://github.com/your-username/cms-gdib.git)
    cd cms-gdib
    ```

2.  **Start the environment (Sail/Docker):**
    ```bash
    ./vendor/bin/sail up -d
    ```

3.  **Install dependencies:**
    ```bash
    sail npm install
    sail composer install
    ```

4.  **Database & Storage:**
    ```bash
    sail artisan migrate
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
