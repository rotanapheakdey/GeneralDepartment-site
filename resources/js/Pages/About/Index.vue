<template>
    <GovLayout>
        <Head :title="$t('nav.about') + ' - GDIB'" />

        <section class="bg-[#002B5B] py-20 text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg width="100%" height="100%"><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern><rect width="100%" height="100%" fill="url(#grid)" /></svg>
            </div>
            <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tight italic mb-4">
                    {{ $t('nav.about') }}
                </h1>
                <div class="h-1.5 w-24 bg-[#FFD700] mx-auto rounded-full"></div>
            </div>
        </section>

        <section class="py-20 max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-slate-100 group hover:border-[#FFD700] transition-colors">
                    <div class="w-16 h-16 bg-blue-50 text-[#002B5B] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FFD700] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 italic">Our Mission</h2>
                    <p class="text-slate-600 leading-relaxed">
                        {{ $t('welcome.quote') }}
                    </p>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-slate-100 group hover:border-[#FFD700] transition-colors">
                    <div class="w-16 h-16 bg-blue-50 text-[#002B5B] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#FFD700] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-4 italic">Our Vision</h2>
                    <p class="text-slate-600 leading-relaxed">
                        To become a leading digital information hub for the General Department of Information and Broadcasting, ensuring transparency and trust.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold text-slate-900 mb-16 uppercase">Leadership</h2>
                <div class="bg-white p-8 rounded-[3rem] shadow-2xl inline-block border-t-8 border-[#FFD700]">
                    <div class="w-48 h-64 bg-slate-200 rounded-2xl mx-auto mb-6 flex items-center justify-center text-slate-400 italic">
                        [Leader Image]
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">{{ $t('welcome.director_name') }}</h3>
                    <p class="text-[#002B5B] font-bold text-sm uppercase mt-1">{{ $t('welcome.director_title') }}</p>
                </div>
            </div>
        </section>
    </GovLayout>
</template>

<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>
