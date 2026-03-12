<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <GovLayout>
        <Head title="About Us" />

        <section class="bg-[#002B5B] py-20 text-white">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 italic">ស្វែងយល់ពីយើង</h1>
                <h2 class="text-xl text-blue-200 uppercase tracking-widest">About the Department</h2>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-slate-900 border-l-4 border-[#D4AF37] pl-4">Our Mission</h3>
                    <p class="text-slate-600 leading-relaxed">
                        To manage, facilitate, and improve the quality of digital content across the Kingdom of Cambodia,
                        ensuring that the General Department of Information and Broadcasting remains a trusted source of
                        official information for all citizens.
                    </p>
                </div>
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-slate-900 border-l-4 border-[#D4AF37] pl-4">Our Vision</h3>
                    <p class="text-slate-600 leading-relaxed">
                        To become a leading digital hub in the ASEAN region for broadcasting excellence and
                        information transparency through innovative technology and professional journalism.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden flex flex-col lg:flex-row">
                    <div class="lg:w-1/3 p-10 bg-slate-900 text-white">
                        <h3 class="text-2xl font-bold mb-8">Contact Information</h3>
                        <div class="space-y-6">
                            <div>
                                <p class="text-blue-400 text-sm uppercase">Address</p>
                                <p>#62, Preah Monivong Blvd, Phnom Penh, Cambodia</p>
                            </div>
                            <div>
                                <p class="text-blue-400 text-sm uppercase">Email</p>
                                <p>ministry@email.com</p>
                            </div>
                            <div>
                                <p class="text-blue-400 text-sm uppercase">Phone</p>
                                <p>+855 12 345 678</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-2/3 h-[400px] bg-slate-200">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3908.770664923145!2d104.9191!3d11.5684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951466037a345%3A0x6b6944e8c187425e!2sMinistry%20of%20Information!5e0!3m2!1sen!2skh!4v1710000000000"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </GovLayout>
</template>
