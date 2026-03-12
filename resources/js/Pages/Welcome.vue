<script setup>
import { Head, Link } from '@inertiajs/vue3';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="GDIB | គេហទំព័រផ្លូវការ" />

    <div class="min-h-screen bg-slate-50" data-theme="corporate">
        <nav class="navbar bg-white border-b border-slate-200 px-4 md:px-12 sticky top-0 z-50">
            <div class="flex-1">
                <Link href="/" class="text-2xl font-black text-primary tracking-tighter">GDIB <span class="text-slate-400 font-light">CMS</span></Link>
            </div>
            <div class="flex-none gap-4">
                <Link href="/posts" class="btn btn-ghost btn-sm">ព័ត៌មាន (News)</Link>
                <Link href="/documents" class="btn btn-ghost btn-sm">ឯកសារ (Documents)</Link>
                <Link v-if="!$page.props.auth.user" :href="route('login')" class="btn btn-primary btn-sm px-6">Login</Link>
                <Link v-else href="/admin" class="btn btn-outline btn-sm">Dashboard</Link>
            </div>
        </nav>

        <header class="relative bg-primary py-24 px-4 overflow-hidden">
            <div class="max-w-7xl mx-auto relative z-10">
                <div class="max-w-2xl">
                    <h1 class="text-5xl md:text-6xl font-black text-white mb-6 leading-tight">
                        ប្រព័ន្ធគ្រប់គ្រងព័ត៌មាន និងឯកសារផ្លូវការ
                    </h1>
                    <p class="text-primary-content/80 text-xl mb-10">
                        Official Portal for General Department of Identification (GDIB) — Access the latest news, regulations, and public documents in one place.
                    </p>
                    <div class="flex gap-4">
                        <Link href="/documents" class="btn btn-secondary btn-lg shadow-lg">ស្វែងរកឯកសារ</Link>
                        <Link href="/posts" class="btn btn-ghost btn-lg text-white border-white/20">មើលព័ត៌មានថ្មីៗ</Link>
                    </div>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-1/3 h-full bg-white/5 skew-x-12 transform translate-x-20"></div>
        </header>

        <section class="max-w-7xl mx-auto py-20 px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="card lg:card-side bg-white shadow-xl border border-slate-100 hover:border-primary transition-all">
                <figure class="bg-slate-100 p-8 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l2 2h3a2 2 0 012 2v10a2 2 0 01-2 2z" /></svg>
                </figure>
                <div class="card-body">
                    <h2 class="card-title text-2xl font-bold">បណ្ណាល័យឯកសារ</h2>
                    <p class="text-slate-500">Access Prakas, Sub-decrees, and official notifications. Filter by category and download PDF versions instantly.</p>
                    <div class="card-actions justify-end">
                        <Link href="/documents" class="btn btn-link text-primary font-bold px-0">Go to Documents →</Link>
                    </div>
                </div>
            </div>

            <div class="card lg:card-side bg-white shadow-xl border border-slate-100 hover:border-primary transition-all">
                <figure class="bg-slate-100 p-8 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>
                </figure>
                <div class="card-body">
                    <h2 class="card-title text-2xl font-bold">ព័ត៌មាន និងព្រឹត្តិការណ៍</h2>
                    <p class="text-slate-500">Read the latest announcements from the department. Stay updated with photo-rich articles and press releases.</p>
                    <div class="card-actions justify-end">
                        <Link href="/posts" class="btn btn-link text-primary font-bold px-0">View News Feed →</Link>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer p-10 bg-slate-900 text-slate-400">
            <div>
                <span class="footer-title text-white">GDIB CMS</span>
                <p>Developing professional government <br/>infrastructure for 2026.</p>
            </div>
            <div>
                <span class="footer-title text-white">Quick Links</span>
                <Link href="/posts" class="link link-hover">News</Link>
                <Link href="/documents" class="link link-hover">Documents</Link>
                <Link href="/login" class="link link-hover">Admin Login</Link>
            </div>
            <div>
                <span class="footer-title text-white">System Status</span>
                <div class="flex items-center gap-2">
                    <div class="badge badge-success badge-xs"></div>
                    <span class="text-xs">All Systems Operational</span>
                </div>
            </div>
        </footer>
    </div>
</template>
