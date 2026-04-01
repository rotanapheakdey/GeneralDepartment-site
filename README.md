# 🇰🇭 GDIB Public Information Portal

A modern **Content Management System (CMS)** and public information portal for the **General Department of Information and Broadcasting (GDIB)**.

This project provides a bilingual (Khmer / English) platform for sharing:

- 📰 Government news and updates
- 📄 Official documents (Prakas)
- 📢 Public announcements and notices

The portal is designed to feel like a real government website while remaining simple enough for academic and demonstration purposes.

**Project Type:** Academic Assignment (March 2026)  
**Status:** Actively Developed

---

## 🎯 Project Goals

- 📡 Make official information easier for the public to access online
- 🌐 Support both Khmer and English users in a single system
- 🧩 Provide a clear structure for managing news, documents, and settings
- 🔒 Follow good practices for access control and content publishing
- 🧱 Demonstrate a clean, maintainable architecture suitable for real institutions

---

## ✨ Key Features

- 🌐 Bilingual interface (Khmer / English) with remembered language preference
- 📰 News management with cover images and rich content
- 📚 Document repository for official PDFs (Prakas) with download links
- 📊 Admin dashboard for creating, editing, and organizing content
- 🧭 Category-based navigation for clearer content discovery
- ⚙️ Global settings management (logo, site title, contact info, etc.)
- 📱 Modern, responsive UI that works on desktop, tablet, and mobile

---

## 👤 User Roles & Permissions

- 👑 Administrator
	- Full access to manage users, roles, settings, categories, posts, and documents
	- Can configure what appears on the public portal

- ✍️ Editor / Staff
	- Can create, edit, and publish news articles and documents
	- Limited access to system-level settings

- 🌍 Public Visitor
	- Reads news, views documents, and downloads public files
	- Can switch between Khmer and English

---

## 🧱 Main Modules

- 📰 News Module
	- Manage news posts with title, content, thumbnail image, category, and publish status
	- Show latest and featured posts on the homepage

- 📂 Category Module
	- Organize posts into logical groups (e.g., Announcements, Policies, Events)
	- Help users quickly find relevant information

- 📄 Document Module
	- Store and manage official PDF documents (Prakas and other files)
	- Provide clear titles, descriptions, and download options

- ⚙️ Settings Module
	- Manage site-wide configuration such as logo, favicon, department name, and footer text
	- Keep important system values in one place for easier maintenance

---

## 🧰 Tech Stack

- 🖥️ Backend: **Laravel 11**, **Filament PHP v3**, **Spatie Media Library**
- 💻 Frontend: **Vue.js 3 (Composition API)**, **Inertia.js**, **Ziggy**
- 🎨 Styling: **Tailwind CSS**, **daisyUI** (custom theme)
- 🐳 Environment: **Laravel Sail (Docker)**
- 🌏 Localization: **vue-i18n** with persistent locale storage

These technologies were chosen to balance developer productivity, performance, and a modern user experience.

---

## 👥 Development Team

This project was developed collaboratively as a student team project:

- **Rotana Pheakdey (ភក្តី រតនា)**
- **Khom Socheat (ខុម សុជាត)**
- **KEO Chournsocheat (កែវ ជួនសុជាតិ)**

Roles and responsibilities were shared and rotated during development to support learning.

---

## 🔍 Typical User Flow

- A public visitor opens the portal and lands on the homepage
- They browse the latest news and can filter by category
- They switch language between Khmer and English when needed
- They access the documents section to download official PDFs
- Administrators and staff log in to the Filament dashboard to manage content

---

## 🧠 What This Project Demonstrates

- Full‑stack development with **Laravel + Vue (Inertia)** in a single-page style setup
- Practical CMS architecture for government and public sector portals
- Clean separation between public-facing pages and an internal admin panel
- Use of UUIDs, categories, and localized content to keep data organized
- Focus on readability, consistency, and maintainability of the codebase

Although it is an academic project, the structure and concepts are aligned with real public information systems.

---

## 🧩 System Architecture (High Level)

- The system follows a monolithic architecture using Laravel on the backend and Vue.js (Inertia) on the frontend.
- Public pages (home, news, documents, about, profile, etc.) are rendered through Inertia, giving a smooth single-page experience.
- An internal admin area powered by Filament PHP is used for managing content and configuration.
- Media files (images, PDFs) are stored in a structured way and linked to posts and documents using a media library.

This design keeps the public experience simple while giving administrators powerful tools behind the scenes.

---

## 🗂️ Data Model Overview (Conceptual)

- Category
	- Represents logical groups such as Announcements, Events, Policies
	- Used to organize both news posts and possibly documents

- Post (News)
	- Contains title, summary, body content, cover image, and language
	- Linked to a category and a created date
	- Uses UUID-based routing to improve security and avoid ID guesswork

- Document
	- Represents an official file (for example Prakas in PDF format)
	- Includes a title, short description, file attachment, and visibility status

- Setting
	- Stores global values like site name, department name, logo path, and contact information
	- Helps keep configuration consistent across different environments

- User and Roles
	- Users can log in to the admin panel
	- Roles and permissions control what each user can see and edit

---

## 📊 Admin Dashboard (Filament)

- Content is managed through a Filament-based admin panel.
- Dedicated sections exist for managing categories, posts, documents, users, and settings.
- Tables, forms, and filters make it easy to search, edit, and review content.
- Validation and structured forms help reduce mistakes when entering official information.

The goal is to make non-technical staff comfortable managing a government-style portal.

---

## 🔒 Security & Good Practices

- Role-based access control separates administrative actions from public visitors.
- UUIDs are used in routes to make it harder to guess internal records.
- Files are stored in managed storage instead of being placed directly in the public folder.
- Only published items are visible to the public; drafts remain internal.

These choices support safer handling of official content, even in a student project.

---

## 🚀 Future Improvements (Ideas)

- 🔎 Full-text search for news and documents
- 📬 Email or SMS notifications for important announcements
- 📈 Basic analytics dashboard (page views, popular posts, document downloads)
- 🧾 Audit logs to track who changed which content and when
- 🌐 API layer for integrating with other government systems in the future

These ideas can help evolve the project from an academic assignment into a more production-ready public information platform.
