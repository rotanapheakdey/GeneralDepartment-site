<script setup>
import GovLayout from '@/Layouts/GovLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useI18n } from 'vue-i18n';

const props = defineProps({
    links: Array,
    settings: Object,
});

const { locale } = useI18n({ useScope: 'global' });
</script>

<template>
    <Head :title="locale === 'km' ? 'ប្រព័ន្ធផ្សព្វផ្សាយ' : 'Media & Broadcasting'" />

    <GovLayout :settings="settings">
        <div class="bg-slate-50 min-h-screen py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Header -->
                <div class="mb-10 text-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-moi-navy mb-4 font-sans tracking-tight">
                        {{ locale === 'km' ? 'ប្រព័ន្ធផ្សព្វផ្សាយ' : 'Media & Broadcasting' }}
                    </h1>
                    <div class="w-24 h-1 bg-moi-red mx-auto rounded-full mb-6"></div>
                    <p class="text-slate-600 max-w-2xl mx-auto text-lg leading-relaxed">
                        {{ locale === 'km' ? 'បណ្តាញផ្សព្វផ្សាយផ្លូវការរបស់ក្រសួងព័ត៌មាន និងស្ថាប័នពាក់ព័ន្ធ។' : 'Official broadcasting channels and media partners of the Ministry of Information.' }}
                    </p>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a 
                        v-for="link in links" 
                        :key="link.id" 
                        :href="link.url" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden group flex flex-col items-center p-8 text-center"
                    >
                        <!-- Logo Placeholder / Image -->
                        <div class="w-32 h-32 mb-6 rounded-full bg-slate-50 flex items-center justify-center p-4 shadow-inner border border-slate-100 group-hover:border-moi-blue/30 transition-colors">
                            <img 
                                v-if="link.logo" 
                                :src="link.logo" 
                                :alt="locale === 'km' ? link.name_km : link.name_en"
                                class="w-full h-full object-contain filter group-hover:brightness-110 transition-all"
                            />
                            <svg v-else class="w-12 h-12 text-slate-300 group-hover:text-moi-blue-50 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        
                        <!-- Name -->
                        <h3 class="text-xl font-bold text-slate-800 group-hover:text-moi-blue transition-colors font-sans mb-2">
                            {{ locale === 'km' ? link.name_km : link.name_en }}
                        </h3>
                        
                        <!-- Subtitle/URL snippet -->
                        <p class="text-sm text-slate-500 line-clamp-1 opacity-70 group-hover:opacity-100 transition-opacity">
                            {{ link.url.replace(/^https?:\/\//, '').replace(/\/$/, '') }}
                        </p>
                    </a>
                </div>

                <!-- Empty State -->
                <div v-if="!links.length" class="text-center py-20 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-lg font-medium text-slate-900">{{ locale === 'km' ? 'មិនមានទិន្នន័យទេ' : 'No Media Links Available' }}</h3>
                </div>

            </div>
        </div>
    </GovLayout>
</template>
