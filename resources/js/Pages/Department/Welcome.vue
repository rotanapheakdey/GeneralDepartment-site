<script setup>
import GovLayout from '@/Layouts/GovLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
});
</script>

<template>
<section class="py-16 bg-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/3 bg-[#002B5B] flex items-center justify-center p-12">
                <div class="aspect-[3/4] w-full bg-slate-200 rounded-lg shadow-inner flex items-center justify-center text-slate-400 italic">
                    [ Director Photo ]
                </div>
            </div>

            <div class="md:w-2/3 p-12 flex flex-col justify-center">
                <h2 class="text-3xl font-bold text-slate-900 mb-6 border-b-2 border-gov-gold pb-4">Director's Welcome</h2>
                <p class="text-lg text-slate-700 leading-relaxed mb-6 italic">
                    "Our mission at the Department of Digital Content is to ensure that every citizen has access to accurate, timely, and secure information. Through digital transformation, we are building a more transparent and connected future for the Ministry."
                </p>
                <div>
                    <p class="font-bold text-xl text-gov-blue">Rotana Pheakdey</p>
                    <p class="text-sm text-slate-500 uppercase tracking-widest">Head of Department</p>
                </div>
            </div>
        </div>
    </div>
</section>
</template>
