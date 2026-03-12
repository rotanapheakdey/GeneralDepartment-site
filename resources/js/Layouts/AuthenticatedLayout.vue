<template>
    <div class="min-h-screen bg-base-200" data-theme="corporate">
        <div class="navbar bg-white shadow-md px-8 sticky top-0 z-50">
            <div class="flex-1">
                <Link href="/" class="text-2xl font-black text-primary tracking-tighter">GDIB <span class="text-slate-500 font-light">CMS</span></Link>
            </div>
            <div class="flex-none gap-2">
                <ul class="menu menu-horizontal px-1 font-bold text-slate-600">
                    <li><Link href="/posts">News</Link></li>
                    <li><Link href="/documents">Documents</Link></li>
                </ul>
                <div class="dropdown dropdown-end ml-4">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                            <span>{{ $page.props.auth.user.name[0] }}</span>
                        </div>
                    </label>
                    <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li><Link href="/admin">Admin Dashboard</Link></li>
                        <li><Link href="/logout" method="post" as="button">Logout</Link></li>
                    </ul>
                </div>
            </div>
        </div>

        <main class="py-12">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
