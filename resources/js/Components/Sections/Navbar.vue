<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import { ref, computed } from "vue";

const { locale } = useI18n({ useScope: 'global' });

// Explicitly grab settings from Inertia page props
const settings = computed(() => usePage().props.settings || {});

const changeLanguage = (lang) => {
    locale.value = lang;
    localStorage.setItem("locale", lang);
};

const isMobileMenuOpen = ref(false);
const isAboutMenuOpen = ref(false);
</script>

<template>
    <nav class="bg-[#002B5B] text-white shadow-md border-b-4 border-[#FFD700] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <Link href="/" class="flex items-center gap-3">
                    <img
                        v-if="settings.site_logo?.image_url"
                        :src="settings.site_logo.image_url"
                        alt="Ministry Logo"
                        class="h-20 w-auto object-contain p-1 rounded-full"
                    />
                    <div
                        v-else
                        class="w-12 h-12 bg-[#FFD700] text-[#002B5B] rounded-lg flex items-center justify-center font-bold text-xl"
                    >
                        MoI
                    </div>

                    <h1 class="font-bold text-lg leading-tight text-white">
                        {{ settings.dept_name?.[locale] || "Ministry of Information" }}
                    </h1>
                </Link>

                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold uppercase tracking-wider">
                    <Link href="/" class="hover:text-[#FFD700] transition" :class="{ 'text-[#FFD700]': $page.url === '/' }">
                        {{ $t("nav.home") }}
                    </Link>
                    <Link :href="route('news.index')" class="hover:text-[#FFD700] transition" :class="{ 'text-[#FFD700]': $page.url.startsWith('/news') }">
                        {{ $t("nav.news") }}
                    </Link>
                    <Link :href="route('documents.index')" class="hover:text-[#FFD700] transition" :class="{ 'text-[#FFD700]': $page.url.startsWith('/documents') }">
                        {{ $t("nav.documents") }}
                    </Link>
                    <div class="relative group">
                        <button class="flex items-center gap-1 hover:text-[#FFD700] transition" :class="{ 'text-[#FFD700]': $page.url.startsWith('/about-us') }">
                            {{ $t("nav.about_us") || 'ABOUT US' }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div class="absolute left-0 mt-2 w-48 bg-white text-slate-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-slate-100 overflow-hidden">
                            <Link :href="route('about_us.index')" class="block px-4 py-3 text-sm hover:bg-slate-50 hover:text-gov-blue transition-colors border-b border-slate-100" :class="{ 'bg-slate-50 font-bold text-gov-blue': $page.url === '/about-us' }">
                                {{ locale === 'km' ? 'អំពីយើង' : 'About Us' }}
                            </Link>
                            <Link :href="route('about_us.structure')" class="block px-4 py-3 text-sm hover:bg-slate-50 hover:text-gov-blue transition-colors border-b border-slate-100" :class="{ 'bg-slate-50 font-bold text-gov-blue': $page.url === '/about-us/structure' }">
                                {{ locale === 'km' ? 'រចនាសម្ព័ន្ធ' : 'Structure' }}
                            </Link>
                            <Link :href="route('about_us.units')" class="block px-4 py-3 text-sm hover:bg-slate-50 hover:text-gov-blue transition-colors border-b border-slate-100" :class="{ 'bg-slate-50 font-bold text-gov-blue': $page.url === '/about-us/units' }">
                                {{ locale === 'km' ? 'អង្គភាព' : 'Units' }}
                            </Link>
                            <Link :href="route('about_us.leadership')" class="block px-4 py-3 text-sm hover:bg-slate-50 hover:text-gov-blue transition-colors" :class="{ 'bg-slate-50 font-bold text-gov-blue': $page.url === '/about-us/leadership' }">
                                {{ locale === 'km' ? 'ថ្នាក់ដឹកនាំ' : 'Leadership' }}
                            </Link>
                        </div>
                    </div>
                    <Link :href="route('about')" class="hover:text-[#FFD700] transition" :class="{ 'text-[#FFD700]': $page.url === '/about' }">
                        {{ $t("nav.about") }}
                    </Link>

                    <div class="flex items-center gap-3 ml-4 border-l pl-4 border-white/20">
                        <button
                            @click="changeLanguage('km')"
                            class="transition-all hover:scale-110 p-0.5 rounded-full border-2"
                            :class="locale === 'km' ? 'border-[#FFD700]' : 'border-transparent grayscale opacity-50'"
                        >
                            <img src="https://flagcdn.com/w40/kh.png" class="w-6 h-6 rounded-full object-cover" alt="KM" />
                        </button>
                        <button
                            @click="changeLanguage('en')"
                            class="transition-all hover:scale-110 p-0.5 rounded-full border-2"
                            :class="locale === 'en' ? 'border-[#FFD700]' : 'border-transparent grayscale opacity-50'"
                        >
                            <img src="https://flagcdn.com/w40/us.png" class="w-6 h-6 rounded-full object-cover" alt="EN" />
                        </button>
                    </div>
                </div>

                <div class="md:hidden flex items-center gap-4">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-white hover:text-[#FFD700] focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div v-show="isMobileMenuOpen" class="md:hidden bg-[#002B5B] border-t border-white/10 px-4 py-4 space-y-2 text-white">
            <Link href="/" class="block py-2 hover:text-[#FFD700]">{{ $t("nav.home") }}</Link>
            <Link :href="route('news.index')" class="block py-2 hover:text-[#FFD700]">{{ $t("nav.news") }}</Link>
            <Link :href="route('documents.index')" class="block py-2 hover:text-[#FFD700]">{{ $t("nav.documents") }}</Link>
            <div>
                <button @click="isAboutMenuOpen = !isAboutMenuOpen" class="flex items-center justify-between w-full py-2 hover:text-[#FFD700]">
                    <span>{{ $t("nav.about_us") || 'About Us' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': isAboutMenuOpen }" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div v-show="isAboutMenuOpen" class="pl-4 py-2 space-y-2 border-l-2 border-white/20 ml-2 mt-1">
                    <Link :href="route('about_us.index')" class="block py-1 text-sm text-slate-300 hover:text-white" :class="{ 'text-white font-bold': $page.url === '/about-us' }">
                        {{ locale === 'km' ? 'អំពីយើង' : 'About Us' }}
                    </Link>
                    <Link :href="route('about_us.structure')" class="block py-1 text-sm text-slate-300 hover:text-white" :class="{ 'text-white font-bold': $page.url === '/about-us/structure' }">
                        {{ locale === 'km' ? 'រចនាសម្ព័ន្ធ' : 'Structure' }}
                    </Link>
                    <Link :href="route('about_us.units')" class="block py-1 text-sm text-slate-300 hover:text-white" :class="{ 'text-white font-bold': $page.url === '/about-us/units' }">
                        {{ locale === 'km' ? 'អង្គភាព' : 'Units' }}
                    </Link>
                    <Link :href="route('about_us.leadership')" class="block py-1 text-sm text-slate-300 hover:text-white" :class="{ 'text-white font-bold': $page.url === '/about-us/leadership' }">
                        {{ locale === 'km' ? 'ថ្នាក់ដឹកនាំ' : 'Leadership' }}
                    </Link>
                </div>
            </div>
            <Link :href="route('about')" class="block py-2 hover:text-[#FFD700]">{{ $t("nav.about") }}</Link>

            <div class="flex gap-4 pt-4 mt-2 border-t border-white/10">
                <button @click="changeLanguage('km')" class="flex items-center gap-2 text-sm" :class="locale === 'km' ? 'text-[#FFD700]' : 'opacity-70'">
                    <img src="https://flagcdn.com/w40/kh.png" class="w-5 h-5 rounded-full object-cover" /> Khmer
                </button>
                <button @click="changeLanguage('en')" class="flex items-center gap-2 text-sm" :class="locale === 'en' ? 'text-[#FFD700]' : 'opacity-70'">
                    <img src="https://flagcdn.com/w40/us.png" class="w-5 h-5 rounded-full object-cover" /> English
                </button>
            </div>
        </div>
    </nav>
</template>
