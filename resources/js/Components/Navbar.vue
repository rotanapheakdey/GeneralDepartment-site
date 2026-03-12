<script setup>
import { Link } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
const { locale } = useI18n();

const changeLanguage = (lang) => {
    locale.value = lang;
    localStorage.setItem("locale", lang);
};

const currentDate = new Date().toLocaleDateString('km-KH', {
    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
});
</script>

<template>
    <nav class="bg-[#002B5B] text-white shadow-md border-b-4 border-[#FFD700] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <Link href="/" class="flex items-center gap-4 group">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#002B5B] font-bold shadow-sm transition-transform group-hover:scale-105">
                        MOI
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold text-white leading-none">
                            {{ $t("nav.dept_name") }}
                        </span>
                        <span class="text-[10px] uppercase tracking-widest text-blue-200 font-medium">
                            General Department of Information and Broadcasting
                        </span>
                    </div>
                </Link>

                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold uppercase tracking-wider">
                    <Link href="/" class="hover:text-[#FFD700] transition" :class="{'text-[#FFD700]': $page.url === '/'}">
                        {{ $t("nav.home") }}
                    </Link>
                    <Link :href="route('news.index')" class="hover:text-[#FFD700] transition" :class="{'text-[#FFD700]': $page.url.startsWith('/news')}">
                        {{ $t("nav.news") }}
                    </Link>
                    <Link :href="route('documents.index')" class="hover:text-[#FFD700] transition" :class="{'text-[#FFD700]': $page.url.startsWith('/documents')}">
                        {{ $t("nav.documents") }}
                    </Link>
                    <Link :href="route('about')" class="hover:text-[#FFD700] transition" :class="{'text-[#FFD700]': $page.url === '/about'}">
                        {{ $t("nav.about") }}
                    </Link>

                    <div class="flex items-center gap-3 ml-4 border-l pl-4 border-white/20">
                        <button @click="changeLanguage('km')"
                            class="transition-all hover:scale-110 p-0.5 rounded-full border-2"
                            :class="locale === 'km' ? 'border-[#FFD700]' : 'border-transparent grayscale opacity-50'">
                            <img src="https://flagcdn.com/w40/kh.png" class="w-6 h-6 rounded-full object-cover" alt="KM">
                        </button>
                        <button @click="changeLanguage('en')"
                            class="transition-all hover:scale-110 p-0.5 rounded-full border-2"
                            :class="locale === 'en' ? 'border-[#FFD700]' : 'border-transparent grayscale opacity-50'">
                            <img src="https://flagcdn.com/w40/us.png" class="w-6 h-6 rounded-full object-cover" alt="EN">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
