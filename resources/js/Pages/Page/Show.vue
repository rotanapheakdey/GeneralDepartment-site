<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    page: Object,
    leaders: Object
});

const inertiaPage = usePage();
const locale = computed(() => inertiaPage.props.locale || 'en');
const settings = computed(() => inertiaPage.props.settings || {});

const title = computed(() => {
    return locale.value === 'km' ? props.page.title_km : props.page.title_en;
});

const content = computed(() => {
    return locale.value === 'km' ? props.page.content_km : props.page.content_en;
});
</script>

<template>
    <GovLayout>
        <Head :title="title + ' - MoI'" />

        <section class="bg-[moi-navy] py-10 border-b-8 border-[moi-blue-hover]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl md:text-4xl font-black text-white mb-0 tracking-tight">
                    {{ title }}
                </h1>
            </div>
        </section>

        <section class="py-16 bg-white min-h-[500px]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Prose is a Tailwind Typography class for rich text -->
                <div v-if="props.page.slug !== 'leadership'" class="prose prose-lg prose-blue max-w-none prose-img:rounded-xl prose-img:shadow-lg" v-html="content">
                </div>

                <!-- History Timeline Section -->
                <div v-if="props.page.slug !== 'leadership' && props.page.timeline_data && props.page.timeline_data.length > 0" class="mt-20">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-black text-slate-900">History & Leadership</h2>
                        <div class="h-1 w-24 bg-[moi-blue-hover] mx-auto mt-4 rounded-full"></div>
                    </div>
                    
                    <div class="relative wrap overflow-hidden p-4 md:p-10 h-full">
                        <div class="border-2-2 absolute border-opacity-20 border-slate-700 h-full border" style="left: 50%;"></div>
                        
                        <div v-for="(event, index) in props.page.timeline_data" :key="index" class="mb-12 flex justify-between items-center w-full" :class="{ 'flex-row-reverse': index % 2 !== 0 }">
                            <div class="order-1 w-5/12"></div>
                            <div class="z-20 flex items-center justify-center order-1 bg-[moi-navy] shadow-xl w-12 h-12 rounded-full border-4 border-white">
                                <h1 class="mx-auto font-semibold text-lg text-white">
                                    <svg v-if="event.type === 'leadership'" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                </h1>
                            </div>
                            <div class="order-1 rounded-2xl shadow-xl w-5/12 p-6" :class="event.type === 'leadership' ? 'bg-amber-50 border border-[moi-blue-hover]' : 'bg-slate-50 border border-slate-200'">
                                <div class="flex items-center gap-4 mb-4">
                                    <div v-if="event.image_path" class="w-16 h-16 rounded-full overflow-hidden shadow border-2 border-white flex-shrink-0">
                                        <img :src="'/storage/' + event.image_path" :alt="locale === 'km' ? event.title_km : event.title_en" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-slate-800 text-xl">{{ locale === 'km' ? event.title_km : event.title_en }}</h3>
                                        <div class="text-sm font-bold text-[moi-navy]">{{ event.year }}</div>
                                    </div>
                                </div>
                                <p class="text-sm leading-relaxed tracking-wide text-slate-600 text-opacity-100">{{ locale === 'km' ? event.description_km : event.description_en }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Units Structure Diagram Section -->
                <div v-if="props.page.slug !== 'leadership' && props.page.units_data && props.page.units_data.length > 0" class="mt-20">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-black text-slate-900">{{ locale === 'km' ? 'រចនាសម្ព័ន្ធអង្គភាព' : 'Organizational Structure' }}</h2>
                        <div class="h-1 w-24 bg-[moi-blue-hover] mx-auto mt-4 rounded-full"></div>
                    </div>

                    <div class="flex flex-col items-center">
                        <!-- Top Level: Ministry -->
                        <div class="bg-[moi-navy] text-white font-bold text-xl px-10 py-4 rounded-xl shadow-lg border-b-4 border-[white] z-10 relative">
                            {{ settings.dept_name?.[locale] || "Ministry of Information" }}
                        </div>
                        <div class="w-1 bg-slate-300 h-8"></div>
                        <div class="w-full max-w-4xl border-t-2 border-slate-300 h-8 relative">
                            <div class="absolute w-1 h-8 bg-slate-300 top-0 left-1/4"></div>
                            <div class="absolute w-1 h-8 bg-slate-300 top-0 right-1/4"></div>
                        </div>
                        
                        <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div v-for="(dept, i) in props.page.units_data" :key="i" class="flex flex-col items-center relative">
                                <div class="bg-slate-100 border-2 border-[moi-navy] text-slate-800 font-bold px-4 py-3 rounded-lg shadow-md text-center w-full min-h-[80px] flex items-center justify-center z-10 bg-white">
                                    {{ locale === 'km' ? dept.name_km : dept.name_en }}
                                </div>
                                
                                <template v-if="dept.departments && dept.departments.length > 0">
                                    <div class="w-1 bg-slate-200 h-6"></div>
                                    <div class="w-full flex flex-col gap-3 relative pl-6 border-l-2 border-slate-200 pb-4">
                                        <div v-for="(sub, j) in dept.departments" :key="j" class="relative">
                                            <div class="absolute w-6 h-0 border-t-2 border-slate-200 top-1/2 -left-6"></div>
                                            <div class="bg-white border border-slate-200 text-slate-700 text-sm px-4 py-2 rounded-md shadow-sm">
                                                {{ locale === 'km' ? sub.name_km : sub.name_en }}
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Leadership Hierarchy Grid Section -->
                <div v-if="props.page.slug === 'leadership'" class="mt-12">
                    
                    <!-- Minister Section -->
                    <div v-if="props.leaders?.minister && props.leaders.minister.length > 0" class="mb-16">
                        <div class="flex justify-center mb-8">
                            <div class="bg-[moi-navy] text-[white] px-8 py-3 rounded-full text-xl font-bold shadow-lg">
                                {{ locale === 'km' ? 'រដ្ឋមន្រ្តី' : 'Minister' }}
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div v-for="leader in props.leaders.minister" :key="leader.id" class="flex flex-col items-center bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100 max-w-sm w-full transition-transform hover:-translate-y-1">
                                <div class="w-full aspect-[3/4] bg-slate-100 relative overflow-hidden">
                                    <img v-if="leader.image_url" :src="leader.image_url" :alt="locale === 'km' ? leader.name_km : leader.name_en" class="w-full h-full object-cover">
                                    <div v-else class="w-full h-full flex items-center justify-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <div class="absolute bottom-0 left-0 w-full p-6 text-center">
                                        <h3 class="font-bold text-white text-2xl mb-1">{{ locale === 'km' ? leader.name_km : leader.name_en }}</h3>
                                    </div>
                                </div>
                                <div class="w-full bg-[moi-navy] py-3 text-center">
                                    <p class="text-[white] font-semibold tracking-wide text-sm">{{ locale === 'km' ? 'រដ្ឋមន្រ្តី' : 'Minister' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Secretary of State Section -->
                    <div v-if="props.leaders?.secretary_of_state && props.leaders.secretary_of_state.length > 0" class="mb-16">
                        <div class="flex justify-center mb-10">
                            <div class="border-b-4 border-[moi-navy] pb-2 px-6">
                                <h2 class="text-2xl font-bold text-slate-800">{{ locale === 'km' ? 'រដ្ឋលេខាធិការ' : 'Secretary of State' }}</h2>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            <div v-for="leader in props.leaders.secretary_of_state" :key="leader.id" class="flex flex-col items-center group">
                                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-slate-200 shadow-md group-hover:border-[moi-blue-hover] group-hover:shadow-lg transition-all mb-4 relative bg-slate-50">
                                    <img v-if="leader.image_url" :src="leader.image_url" :alt="locale === 'km' ? leader.name_km : leader.name_en" class="w-full h-full object-cover">
                                    <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="font-bold text-slate-800 text-center text-sm md:text-base group-hover:text-[moi-navy] transition-colors">{{ locale === 'km' ? leader.name_km : leader.name_en }}</h3>
                                <p class="text-xs text-slate-500 mt-1">{{ locale === 'km' ? 'រដ្ឋលេខាធិការ' : 'Secretary of State' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Under Secretary of State Section -->
                    <div v-if="props.leaders?.under_secretary_of_state && props.leaders.under_secretary_of_state.length > 0" class="mb-10">
                        <div class="flex justify-center mb-10">
                            <div class="border-b-4 border-[moi-navy] pb-2 px-6">
                                <h2 class="text-2xl font-bold text-slate-800">{{ locale === 'km' ? 'អនុរដ្ឋលេខាធិការ' : 'Under Secretary of State' }}</h2>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            <div v-for="leader in props.leaders.under_secretary_of_state" :key="leader.id" class="flex flex-col items-center group">
                                <div class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden border-4 border-slate-100 shadow-sm group-hover:border-[moi-blue-hover] group-hover:shadow-md transition-all mb-4 relative bg-slate-50">
                                    <img v-if="leader.image_url" :src="leader.image_url" :alt="locale === 'km' ? leader.name_km : leader.name_en" class="w-full h-full object-cover">
                                    <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <h3 class="font-bold text-slate-700 text-center text-sm md:text-base group-hover:text-[moi-navy] transition-colors">{{ locale === 'km' ? leader.name_km : leader.name_en }}</h3>
                                <p class="text-xs text-slate-500 mt-1">{{ locale === 'km' ? 'អនុរដ្ឋលេខាធិការ' : 'Under Sec. of State' }}</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </GovLayout>
</template>
