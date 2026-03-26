<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";

const page = usePage();
const settings = page.props.settings || {};
</script>

<template>
    <GovLayout>
        <Head :title="$t('nav.about') + ' - GDIB'" />

        <section class="bg-[#002B5B] py-20 border-b-8 border-[#D4AF37]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">
                    About the General Department
                </h1>
                <p class="text-xl text-slate-300 max-w-3xl mx-auto font-serif italic">
                    Regulating, managing, and guiding the information and broadcasting sector in the Kingdom of Cambodia.
                </p>
            </div>
        </section>

        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-8 -mt-28">
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl shadow-slate-200/50 border border-slate-100">
                        <div class="w-14 h-14 bg-blue-100 text-[#002B5B] rounded-2xl flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Our Mission</h2>
                        <p class="text-slate-600 leading-relaxed">
                            To ensure the flow of accurate, timely, and comprehensive information to the public while maintaining the integrity and quality of broadcasting services nationwide. We act as the bridge between the government and the citizens.
                        </p>
                    </div>

                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl shadow-slate-200/50 border border-slate-100">
                        <div class="w-14 h-14 bg-yellow-100 text-yellow-700 rounded-2xl flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Our Vision</h2>
                        <p class="text-slate-600 leading-relaxed">
                            To be the leading digitalized public institution in Southeast Asia, fostering a transparent, modern, and highly ethical media landscape that empowers every Cambodian citizen.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12">
                    <h3 class="text-3xl font-black text-slate-900">Location & Contact</h3>
                    <div class="h-1 w-20 bg-[#D4AF37] mt-4 rounded-full"></div>
                </div>

                <div class="bg-slate-50 rounded-[2rem] border border-slate-200 overflow-hidden flex flex-col lg:flex-row shadow-lg">
                    <div class="lg:w-1/3 p-8 md:p-12 bg-[#002B5B] text-white flex flex-col justify-center">
                        <h4 class="text-2xl font-bold mb-8 text-[#D4AF37]">Get in Touch</h4>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="font-bold">Ministry of Information</p>
                                    <p class="text-slate-300 text-sm mt-1">Monivong Blvd, Sangkat Srah Chork, Daun Penh, Phnom Penh, Cambodia</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>{{ settings.site_phone || '(+855) 23 123 456' }}</span>
                            </div>

                            <div class="flex items-center gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>{{ settings.site_email || 'info@information.gov.kh' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-2/3 h-96 lg:h-auto min-h-[400px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.675669922241!2d104.91811807604432!3d11.575084988625692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31095146c6eb5611%3A0xcda65955ba9b26b3!2sMinistry%20of%20Information!5e0!3m2!1sen!2skh!4v1700000000000!5m2!1sen!2skh"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </GovLayout>
</template>
