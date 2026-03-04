# GDIB Content & Document Management System

A custom-tailored digital portal and Document Management System (DMS) built for the **General Department of Information and Broadcasting (GDIB)** at the Ministry of Information. 

This system modernizes internal document routing and public service delivery, transitioning manual, paper-based workflows into a secure, digital-first environment.

## 🚀 Tech Stack
* **Backend Framework:** Laravel
* **Admin Panel & Internal UI:** Filament PHP
* **Frontend (Public Portal):** Vue 3 + Inertia.js
* **Styling:** Tailwind CSS
* **Infrastructure:** Docker / Containerized deployment

## ✨ Key Features & Modules

### 1. Role-Based Access Control (RBAC)
Strict hierarchical access mapping to government chain of command:
* **Admin:** Full system configuration, oversight, and global user management.
* **Department-Head:** Approval authority, application review, and department-level resource management.
* **Staff:** Document uploading, drafting, and basic processing capabilities.

### 2. Document Management System (DMS)
The core engine for handling official government documents securely.
* Dynamic categorization via `document_type` (e.g., assignment letters, national IDs).
* Secure, private local storage for sensitive uploads (files are mapped in the database but protected from public internet access).

### 3. Public-Facing Portal & Services
A decoupled-style SPA for citizens and journalists interacting with the ministry.
* **Press Reporter Registration:** Fully digital application flow for media credentials.
* **Document Retrieval:** Public-facing search and filter functionality for verified records.
* **Digital Payments:** KHQR integration for seamless processing of public service fees.

## 📊 Current Project Status
**Overall Completion:** ~70% (Functional Milestone)

- [x] **System Foundation & Database Schema**
- [x] **Core Admin Panel (Filament)**
- [x] **User Roles & Permissions (RBAC)**
- [x] **Media Handling & Secure Uploads**
- [ ] **Public Portal UI (Vue 3)** - *In Progress*
- [ ] **Public Document Search/Filter** - *In Progress*
- [ ] **Press Registration Final Flow** - *In Progress*

---

## 🛠️ Local Installation & Docker Setup

This project uses Docker for local development and deployment to ensure environment consistency.

**1. Clone the repository**
`git clone https://github.com/yourusername/gdib-cms.git`
`cd gdib-cms`

**2. Configure Environment**
`cp .env.example .env`
*(Update your `.env` file with appropriate database credentials and API keys).*

**3. Build and spin up containers**
`docker compose up -d --build`

**4. Install Dependencies**
`docker compose exec app composer install`
`docker compose exec app npm install`

**5. Application Setup**
`docker compose exec app php artisan key:generate`
`docker compose exec app php artisan migrate:fresh --seed`
`docker compose exec app php artisan storage:link`

**6. Build Frontend Assets**
`docker compose exec app npm run build`

## 🔒 Security Note
Due to the nature of government data, ensure that the `.env` file is never committed to version control and that the `storage` directory has strict permission policies applied in production environments.
