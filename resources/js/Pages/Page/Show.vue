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

import { reactive } from 'vue';
const openTiers = reactive({
    sec: true,
    under_sec: false
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

                <!-- Leadership Hierarchy Grid Section (Pro Max Design) -->
                <div v-if="props.page.slug === 'leadership' || props.page.slug === 'structure'" class="mt-12 mb-20">
                    <div class="org-container max-w-5xl mx-auto flex flex-col items-center">
                        
                        <!-- 1. Minister Block -->
                        <div v-if="props.leaders?.minister && props.leaders.minister.length > 0" class="tier-block minister-block w-full flex flex-col items-center">
                            <div class="tier-label bg-moi-navy text-white px-8 py-3 rounded-t-xl font-bold text-base shadow-md inline-flex items-center gap-2 relative z-10 border-b-2 border-amber-400">
                                <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                {{ locale === 'km' ? 'រដ្ឋមន្រ្តី' : 'Minister' }}
                            </div>
                            <div class="minister-card-wrap bg-white border border-slate-200 rounded-b-2xl shadow-xl w-full max-w-lg p-8 flex flex-wrap justify-center gap-6 relative z-0 -mt-1">
                                <div v-for="leader in props.leaders.minister" :key="leader.id" class="minister-card flex flex-col items-center gap-4 group">
                                    <div class="avatar-wrap large w-32 h-32 rounded-full border-4 border-slate-100 shadow-md group-hover:border-moi-blue group-hover:shadow-2xl transition-all duration-300 overflow-hidden relative bg-slate-50">
                                        <img v-if="leader.image_url" :src="leader.image_url" :alt="locale === 'km' ? leader.name_km : leader.name_en" class="w-full h-full object-cover">
                                        <div v-else class="w-full h-full flex items-center justify-center text-slate-300">
                                            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        </div>
                                    </div>
                                    <div class="member-info text-center">
                                        <span class="member-title-badge bg-blue-50 text-moi-blue px-3 py-1 rounded-full text-xs font-bold mb-2 inline-block shadow-sm border border-blue-100">{{ locale === 'km' ? 'ឯកឧត្ដម' : 'H.E.' }}</span>
                                        <h3 class="member-name text-slate-900 font-bold text-xl">{{ locale === 'km' ? leader.name_km : leader.name_en }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Connector 1 -->
                        <div v-if="props.leaders?.secretary_of_state && props.leaders.secretary_of_state.length > 0" class="connector-main flex justify-center py-2">
                            <div class="connector-line w-1 h-10 bg-gradient-to-b from-slate-200 to-moi-blue/40 rounded-full"></div>
                        </div>

                        <!-- 2. Secretary of State Block -->
                        <div v-if="props.leaders?.secretary_of_state && props.leaders.secretary_of_state.length > 0" class="tier-block w-full flex flex-col items-center">
                            <button @click="openTiers['sec'] = !openTiers['sec']" class="tier-label clickable bg-moi-navy hover:bg-moi-blue transition-colors text-white px-6 py-3 rounded-xl font-bold text-[15px] shadow-md inline-flex items-center justify-between w-full max-w-3xl border-b-2 border-transparent hover:border-amber-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                                    {{ locale === 'km' ? 'រដ្ឋលេខាធិការ' : 'Secretary of State' }} 
                                    <span class="count-badge bg-white/20 text-white text-xs px-2 py-0.5 rounded-full ml-2">{{ props.leaders.secretary_of_state.length }} {{ locale === 'km' ? 'នាក់' : '' }}</span>
                                </div>
                                <svg class="chevron w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': openTiers['sec'] }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            
                            <Transition name="slide">
                                <div v-show="openTiers['sec']" class="members-grid-wrap w-full">
                                    <div class="members-grid bg-white border border-slate-200 rounded-b-2xl shadow-lg mt-0 p-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 relative z-0 max-w-6xl mx-auto">
                                        <div v-for="leader in props.leaders.secretary_of_state" :key="leader.id" class="member-card flex flex-col items-center p-4 bg-slate-50/50 border border-slate-100 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                                            <div class="avatar-wrap w-20 h-20 rounded-full border-2 border-slate-200 mb-3 overflow-hidden bg-white shadow-sm">
                                                <img v-if="leader.image_url" :src="leader.image_url" :alt="locale === 'km' ? leader.name_km : leader.name_en" class="w-full h-full object-cover">
                                                <div v-else class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100">
                                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                </div>
                                            </div>
                                            <div class="member-info text-center flex flex-col items-center">
                                                <span class="member-title-badge bg-blue-50 text-moi-blue px-2 py-0.5 rounded-full text-[10px] font-bold mb-1 border border-blue-100">{{ locale === 'km' ? 'ឯកឧត្ដម' : 'H.E.' }}</span>
                                                <h3 class="member-name text-slate-800 font-bold text-sm leading-tight">{{ locale === 'km' ? leader.name_km : leader.name_en }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Transition>
                        </div>

                        <!-- Connector 2 -->
                        <div v-if="props.leaders?.under_secretary_of_state && props.leaders.under_secretary_of_state.length > 0" class="connector-sub flex justify-center py-2">
                            <div class="connector-line w-1 h-10 bg-gradient-to-b from-moi-blue/40 to-slate-200 rounded-full"></div>
                        </div>

                        <!-- 3. Under Secretary of State Block -->
                        <div v-if="props.leaders?.under_secretary_of_state && props.leaders.under_secretary_of_state.length > 0" class="tier-block w-full flex flex-col items-center">
                            <button @click="openTiers['under_sec'] = !openTiers['under_sec']" class="tier-label clickable bg-moi-navy hover:bg-moi-blue transition-colors text-white px-6 py-3 rounded-xl font-bold text-[15px] shadow-md inline-flex items-center justify-between w-full max-w-3xl border-b-2 border-transparent hover:border-amber-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    {{ locale === 'km' ? 'អនុរដ្ឋលេខាធិការ' : 'Under Secretary of State' }} 
                                    <span class="count-badge bg-white/20 text-white text-xs px-2 py-0.5 rounded-full ml-2">{{ props.leaders.under_secretary_of_state.length }} {{ locale === 'km' ? 'នាក់' : '' }}</span>
                                </div>
                                <svg class="chevron w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': openTiers['under_sec'] }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            
                            <Transition name="slide">
                                <div v-show="openTiers['under_sec']" class="members-grid-wrap w-full">
                                    <div class="members-grid bg-white border border-slate-200 rounded-b-2xl shadow-lg mt-0 p-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 relative z-0 max-w-6xl mx-auto">
                                        <div v-for="leader in props.leaders.under_secretary_of_state" :key="leader.id" class="member-card flex flex-col items-center p-4 bg-slate-50/50 border border-slate-100 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                                            <div class="avatar-wrap w-16 h-16 rounded-full border-2 border-slate-200 mb-3 overflow-hidden bg-white shadow-sm">
                                                <img v-if="leader.image_url" :src="leader.image_url" :alt="locale === 'km' ? leader.name_km : leader.name_en" class="w-full h-full object-cover">
                                                <div v-else class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-100">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                </div>
                                            </div>
                                            <div class="member-info text-center flex flex-col items-center">
                                                <span class="member-title-badge bg-blue-50 text-moi-blue px-2 py-0.5 rounded-full text-[10px] font-bold mb-1 border border-blue-100">{{ locale === 'km' ? 'ឯកឧត្ដម' : 'H.E.' }}</span>
                                                <h3 class="member-name text-slate-700 font-bold text-sm leading-tight">{{ locale === 'km' ? leader.name_km : leader.name_en }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Transition>
                        </div>
                    </div>
                </div>

</div>
        </section>
    </GovLayout>
</template>
<style scoped>
.slide-enter-active, .slide-leave-active {
  transition: all 0.35s ease;
  overflow: hidden;
}
.slide-enter-from, .slide-leave-to {
  max-height: 0;
  opacity: 0;
  transform: translateY(-8px);
}
.slide-enter-to, .slide-leave-from {
  max-height: 2000px;
  opacity: 1;
}
</style>
