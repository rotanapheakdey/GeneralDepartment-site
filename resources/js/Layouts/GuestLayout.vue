<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-slate-50" data-theme="corporate">
        <nav class="navbar bg-white border-b border-slate-200 px-4 md:px-12 sticky top-0 z-50">
            <div class="flex-1">
                <Link href="/" class="text-2xl font-black text-primary tracking-tighter">GDIB <span class="text-slate-400 font-light">CMS</span></Link>
            </div>
            <div class="flex-none gap-4">
                <Link href="/posts" class="btn btn-ghost btn-sm">News</Link>
                <Link href="/documents" class="btn btn-ghost btn-sm">Documents</Link>
                <Link v-if="!$page.props.auth.user" :href="route('login')" class="btn btn-primary btn-sm px-6">Login</Link>
                <Link v-else href="/admin" class="btn btn-outline btn-sm">Admin</Link>
            </div>
        </nav>

        <main>
            <slot />
        </main>

        <footer class="footer p-10 bg-slate-900 text-slate-400 mt-20">
            <div>
                <span class="footer-title text-white">GDIB CMS</span>
                <p>Official Information Management System</p>
            </div>
            <div>
                <span class="footer-title text-white">Resources</span>
                <Link href="/posts" class="link link-hover">News Feed</Link>
                <Link href="/documents" class="link link-hover">Public Documents</Link>
            </div>
        </footer>
    </div>
</template>
