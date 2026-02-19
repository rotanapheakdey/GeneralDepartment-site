<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen bg-slate-50 flex flex-col">
        <nav
            class="bg-[#002B5B] text-white shadow-md border-b-4 border-[#FFD700]"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#002B5B] font-bold shadow-sm"
                        >
                            MOI
                        </div>

                        <div class="flex flex-col">
                            <span
                                class="text-xl font-bold text-white leading-none"
                            >
                                អគ្គនាយកដ្ឋានព័ត៌មាន និងសោតទស្សន៍
                            </span>
                            <span
                                class="text-[10px] uppercase tracking-widest text-blue-200 font-medium"
                            >
                                General Department of Information and
                                Broadcasting
                            </span>
                        </div>
                    </div>
                    <div
                        class="hidden md:flex space-x-8 text-sm font-semibold uppercase tracking-wider"
                    >
                        <Link href="/" class="hover:text-[#FFD700] transition"
                            >Home</Link
                        >
                        <Link
                            :href="route('news.index')"
                            class="hover:text-[#FFD700] transition"
                            >Activities</Link
                        >
                        <Link href="#" class="hover:text-[#FFD700] transition"
                            >Services</Link
                        >
                        <Link href="#" class="hover:text-[#FFD700] transition"
                            >About Us</Link
                        >
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            <slot />
        </main>

        <footer class="bg-slate-900 text-white py-12 mt-20">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-sm opacity-60">
                    © 2026 Ministry of Information. All rights reserved.
                </p>
                <p
                    class="text-[10px] mt-2 opacity-40 uppercase tracking-[0.2em]"
                >
                    Official Government Portal
                </p>
            </div>
        </footer>
    </div>
</template>
