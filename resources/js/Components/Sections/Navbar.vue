<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import { ref, computed, onMounted } from "vue";

const { locale } = useI18n({ useScope: 'global' });
const settings = computed(() => usePage().props.settings || {});

const changeLanguage = (lang) => {
    locale.value = lang;
    localStorage.setItem("locale", lang);
};

const isMobileMenuOpen = ref(false);
const activeMobileDropdown = ref(null);

const toggleMobileDropdown = (menu) => {
    activeMobileDropdown.value = activeMobileDropdown.value === menu ? null : menu;
};

// Date logic for top bar
const currentDate = ref('');
onMounted(() => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    currentDate.value = new Date().toLocaleDateString(locale.value === 'km' ? 'km-KH' : 'en-US', options);
});
</script>

<template>
    <!-- TOP UTILITY BAR (Tier 1) -->
    <div class="bg-slate-900 text-slate-300 text-xs hidden md:block border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-10 flex items-center justify-between">
            <!-- Left: Date -->
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-moi-blue-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ currentDate }}</span>
            </div>

            <!-- Middle: Breaking News Ticker (Marquee) -->
            <div class="flex-1 flex items-center justify-center overflow-hidden px-8">
                <div class="flex items-center gap-2 max-w-lg w-full bg-slate-800/50 rounded-full px-3 py-1">
                    <span class="bg-moi-red text-white px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider animate-pulse whitespace-nowrap">{{ $t('nav.breaking_news') }}</span>
                    <marquee class="text-slate-200 text-xs truncate" scrollamount="4">
                        <span class="mr-8">ក្រសួងព័ត៌មានប្រកាសដាក់ឱ្យប្រើប្រាស់ប្រព័ន្ធព័ត៌មានវិទ្យាថ្មី (Ministry of Information launches new IT system)</span>
                        <span class="mr-8">សន្និសីទសារព័ត៌មានស្តីពីសមិទ្ធផល (Press Conference on Achievements)</span>
                    </marquee>
                </div>
            </div>

            <!-- Right: Quick Links, Search, Lang -->
            <div class="flex items-center gap-4">
                <Link :href="route('contact')" class="hover:text-white transition">{{ $t('nav.public_services') }}</Link>
                <span class="text-slate-600">|</span>
                <a href="https://media.inb.gov.kh/" target="_blank" class="hover:text-white transition">{{ $t('nav.press_accreditation') }}</a>
                
                <button class="flex items-center gap-1 hover:text-white bg-white/5 px-2 py-1 rounded transition ml-2">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>{{ $t('nav.search') }}</span>
                    <span class="ml-1 opacity-50 font-mono">⌘K</span>
                </button>

                <!-- Language Switcher inside top bar -->
                <div class="flex items-center gap-2 ml-4">
                    <button @click="changeLanguage('km')" class="transition hover:opacity-100" :class="locale === 'km' ? 'opacity-100' : 'opacity-40 grayscale'">
                        <img src="https://flagcdn.com/w20/kh.png" class="w-4 h-4 rounded-full object-cover" alt="KM" />
                    </button>
                    <button @click="changeLanguage('en')" class="transition hover:opacity-100" :class="locale === 'en' ? 'opacity-100' : 'opacity-40 grayscale'">
                        <img src="https://flagcdn.com/w20/us.png" class="w-4 h-4 rounded-full object-cover" alt="EN" />
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR (Tier 2) -->
    <nav class="bg-moi-navy/95 backdrop-blur-md text-white shadow-md border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <Link href="/" class="flex items-center gap-3 shrink-0">
                    <img
                        v-if="settings.site_logo?.image_url"
                        :src="settings.site_logo.image_url"
                        alt="Ministry Logo"
                        class="h-16 w-auto object-contain p-1 rounded-full"
                    />
                    <div
                        v-else
                        class="w-12 h-12 bg-moi-blue-50 text-moi-navy rounded-lg flex items-center justify-center font-bold text-xl"
                    >
                        MoI
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-bold text-base md:text-lg leading-tight text-white font-sans">
                            {{ settings.dept_name?.[locale] || "ក្រសួងព័ត៌មាន" }}
                        </h1>
                        <span class="text-xs text-moi-blue-50 tracking-widest uppercase hidden md:block">
                            {{ locale === 'km' ? "Ministry of Information" : "ក្រសួងព័ត៌មាន" }}
                        </span>
                    </div>
                </Link>

                <!-- Desktop Mega Menus -->
                <div class="hidden lg:flex items-center space-x-6 text-sm font-semibold tracking-wide h-full">
                    
                    <!-- 1. Home -->
                    <Link href="/" class="flex items-center h-full hover:text-moi-blue-50 transition border-b-2" :class="[$page.url === '/' ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                        <span class="hidden xl:inline">{{ $t("nav.home") }}</span>
                    </Link>

                    <!-- 2. News & Events -->
                    <Link :href="route('news.index')" class="flex items-center h-full hover:text-moi-blue-50 transition border-b-2" :class="[$page.url.startsWith('/news') ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                        <span>{{ $t("nav.news_events") }}</span>
                    </Link>

                    <!-- 3. Leadership & Org -->
                    <div class="relative group h-full flex items-center">
                        <Link :href="route('about_us.index')" class="flex items-center gap-1 hover:text-moi-blue-50 transition border-b-2 h-full" :class="[$page.url.startsWith('/leadership') ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                            {{ $t("nav.leadership_org") }}
                            <svg class="h-4 w-4 opacity-50" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </Link>
                        <div class="absolute top-full left-0 w-64 bg-white text-slate-800 rounded-b-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border-t-2 border-moi-blue">
                            <Link :href="route('about_us.leadership')" class="block px-4 py-3 hover:bg-slate-50 hover:text-moi-blue transition border-b border-slate-100">{{ $t("nav.minister_activity") }}</Link>
                            <Link :href="route('about_us.structure')" class="block px-4 py-3 hover:bg-slate-50 hover:text-moi-blue transition border-b border-slate-100">{{ $t("nav.general_departments") }}</Link>
                            <Link :href="route('about_us.units')" class="block px-4 py-3 hover:bg-slate-50 hover:text-moi-blue transition rounded-b-xl">{{ $t("nav.provincial_departments") }}</Link>
                        </div>
                    </div>

                    <!-- 4. Legal Documents -->
                    <div class="relative group h-full flex items-center">
                        <Link :href="route('documents.index')" class="flex items-center gap-1 hover:text-moi-blue-50 transition border-b-2 h-full" :class="[$page.url.startsWith('/documents') ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                            {{ $t("nav.legal_documents") }}
                            <svg class="h-4 w-4 opacity-50" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </Link>
                        <div class="absolute top-full left-0 w-56 bg-white text-slate-800 rounded-b-xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border-t-2 border-moi-blue">
                            <Link :href="route('documents.index')" class="block px-4 py-3 hover:bg-slate-50 hover:text-moi-blue transition border-b border-slate-100">{{ $t("nav.decrees") }}</Link>
                            <Link :href="route('documents.index')" class="block px-4 py-3 hover:bg-slate-50 hover:text-moi-blue transition border-b border-slate-100">{{ $t("nav.prakas") }}</Link>
                            <Link :href="route('documents.index')" class="block px-4 py-3 hover:bg-slate-50 hover:text-moi-blue transition border-b border-slate-100">{{ $t("nav.decisions") }}</Link>
                            <Link :href="route('documents.index')" class="block px-4 py-3 hover:bg-slate-50 hover:text-moi-blue transition rounded-b-xl">{{ $t("nav.circulars") }}</Link>
                        </div>
                    </div>

                    <!-- 5. Media & Broadcasting -->
                    <Link :href="route('media.index')" class="flex items-center h-full hover:text-moi-blue-50 transition border-b-2" :class="[$page.url.startsWith('/media') ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                        <span>{{ $t("nav.media_broadcasting") }}</span>
                    </Link>

                    

                    <!-- 7. Contact -->
                    <Link :href="route('contact')" class="flex items-center h-full hover:text-moi-blue-50 transition border-b-2" :class="[$page.url === '/contact' ? 'border-moi-blue-50 text-moi-blue-50' : 'border-transparent']">
                        <span class="hidden xl:inline">{{ $t("nav.contact_tipoff") }}</span>
                        <svg class="w-4 h-4 ml-1 xl:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </Link>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center gap-4">
                    <button class="text-white hover:text-moi-blue-50 bg-white/5 p-2 rounded">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-white hover:text-moi-blue-50 focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE ACCORDION MENU -->
        <div v-show="isMobileMenuOpen" class="lg:hidden bg-moi-navy border-t border-white/10 px-4 py-4 space-y-1 text-white shadow-inner max-h-[80vh] overflow-y-auto">
            
            <Link href="/" class="block py-3 px-2 rounded-lg hover:bg-white/5">{{ $t("nav.home") }}</Link>
            
            <!-- Mobile: News & Events -->
            <Link :href="route('news.index')" class="block py-3 px-2 rounded-lg hover:bg-white/5">{{ $t("nav.news_events") }}</Link>

            <!-- Mobile: Leadership & Org -->
            <div>
                <button @click="toggleMobileDropdown('org')" class="flex items-center justify-between w-full py-3 px-2 rounded-lg hover:bg-white/5 font-semibold">
                    <span>{{ $t("nav.leadership_org") }}</span>
                    <svg class="h-4 w-4 transition-transform" :class="{'rotate-180': activeMobileDropdown === 'org'}" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </button>
                <div v-show="activeMobileDropdown === 'org'" class="pl-6 py-2 space-y-2 border-l-2 border-moi-blue/50 ml-4 mb-2">
                    <Link :href="route('about_us.leadership')" class="block py-2 text-sm text-slate-300 hover:text-white">{{ $t("nav.minister_activity") }}</Link>
                    <Link :href="route('about_us.structure')" class="block py-2 text-sm text-slate-300 hover:text-white">{{ $t("nav.general_departments") }}</Link>
                    <Link :href="route('about_us.units')" class="block py-2 text-sm text-slate-300 hover:text-white">{{ $t("nav.provincial_departments") }}</Link>
                </div>
            </div>

            <!-- Mobile: Legal Docs -->
            <div>
                <button @click="toggleMobileDropdown('docs')" class="flex items-center justify-between w-full py-3 px-2 rounded-lg hover:bg-white/5 font-semibold">
                    <span>{{ $t("nav.legal_documents") }}</span>
                    <svg class="h-4 w-4 transition-transform" :class="{'rotate-180': activeMobileDropdown === 'docs'}" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </button>
                <div v-show="activeMobileDropdown === 'docs'" class="pl-6 py-2 space-y-2 border-l-2 border-moi-blue/50 ml-4 mb-2">
                    <Link :href="route('documents.index')" class="block py-2 text-sm text-slate-300 hover:text-white">{{ $t("nav.decrees") }}</Link>
                    <Link :href="route('documents.index')" class="block py-2 text-sm text-slate-300 hover:text-white">{{ $t("nav.prakas") }}</Link>
                    <Link :href="route('documents.index')" class="block py-2 text-sm text-slate-300 hover:text-white">{{ $t("nav.decisions") }}</Link>
                    <Link :href="route('documents.index')" class="block py-2 text-sm text-slate-300 hover:text-white">{{ $t("nav.circulars") }}</Link>
                </div>
            </div>

            <!-- Mobile: Media -->
            <Link :href="route('media.index')" class="block py-3 px-2 rounded-lg hover:bg-white/5">{{ $t("nav.media_broadcasting") }}</Link>

            

            <Link :href="route('contact')" class="block py-3 px-2 rounded-lg hover:bg-white/5">{{ $t("nav.contact_tipoff") }}</Link>

            <!-- Mobile Utilities (Lang Switch) -->
            <div class="flex gap-4 pt-6 pb-4 mt-2 border-t border-white/10 px-2">
                <button @click="changeLanguage('km')" class="flex items-center gap-2 text-sm py-2 px-4 rounded-lg bg-white/5" :class="locale === 'km' ? 'text-moi-blue-50 border border-moi-blue-50/30' : 'opacity-70'">
                    <img src="https://flagcdn.com/w40/kh.png" class="w-5 h-5 rounded-full object-cover" /> ខ្មែរ
                </button>
                <button @click="changeLanguage('en')" class="flex items-center gap-2 text-sm py-2 px-4 rounded-lg bg-white/5" :class="locale === 'en' ? 'text-moi-blue-50 border border-moi-blue-50/30' : 'opacity-70'">
                    <img src="https://flagcdn.com/w40/us.png" class="w-5 h-5 rounded-full object-cover" /> English
                </button>
            </div>
        </div>
    </nav>
</template>
