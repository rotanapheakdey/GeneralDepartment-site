<script setup>
import { Link } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
const { locale } = useI18n();
import { ref } from "vue";

const changeLanguage = (lang) => {
    locale.value = lang;
    localStorage.setItem("locale", lang);
};

const currentDate = new Date().toLocaleDateString("km-KH", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
});

const isMobileMenuOpen = ref(false);
</script>

<template>
    <nav
        class="bg-[#002B5B] text-white shadow-md border-b-4 border-[#FFD700] sticky top-0 z-50"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <Link href="/" class="flex items-center gap-4 group">
                    <div class="md:hidden flex items-center">
                        <button
                            @click="isMobileMenuOpen = !isMobileMenuOpen"
                            class="text-white focus:outline-none"
                        >
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    v-if="!isMobileMenuOpen"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    v-else
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                    <div
                        class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#002B5B] font-bold shadow-sm transition-transform group-hover:scale-105"
                    >
                        MOI
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold text-white leading-none">
                            {{ $t("nav.dept_name") }}
                        </span>
                        <span
                            class="text-[10px] uppercase tracking-widest text-blue-200 font-medium"
                        >
                            General Department of Information and Broadcasting
                        </span>
                    </div>
                </Link>

                <div
                    class="hidden md:flex items-center space-x-8 text-sm font-semibold uppercase tracking-wider"
                >
                    <Link
                        href="/"
                        class="hover:text-[#FFD700] transition"
                        :class="{ 'text-[#FFD700]': $page.url === '/' }"
                    >
                        {{ $t("nav.home") }}
                    </Link>
                    <Link
                        :href="route('news.index')"
                        class="hover:text-[#FFD700] transition"
                        :class="{
                            'text-[#FFD700]': $page.url.startsWith('/news'),
                        }"
                    >
                        {{ $t("nav.news") }}
                    </Link>
                    <Link
                        :href="route('documents.index')"
                        class="hover:text-[#FFD700] transition"
                        :class="{
                            'text-[#FFD700]':
                                $page.url.startsWith('/documents'),
                        }"
                    >
                        {{ $t("nav.documents") }}
                    </Link>
                    <Link
                        :href="route('about')"
                        class="hover:text-[#FFD700] transition"
                        :class="{ 'text-[#FFD700]': $page.url === '/about' }"
                    >
                        {{ $t("nav.about") }}
                    </Link>

                    <div
                        class="flex items-center gap-3 ml-4 border-l pl-4 border-white/20"
                    >
                        <button
                            @click="changeLanguage('km')"
                            class="transition-all hover:scale-110 p-0.5 rounded-full border-2"
                            :class="
                                locale === 'km'
                                    ? 'border-[#FFD700]'
                                    : 'border-transparent grayscale opacity-50'
                            "
                        >
                            <img
                                src="https://flagcdn.com/w40/kh.png"
                                class="w-6 h-6 rounded-full object-cover"
                                alt="KM"
                            />
                        </button>
                        <button
                            @click="changeLanguage('en')"
                            class="transition-all hover:scale-110 p-0.5 rounded-full border-2"
                            :class="
                                locale === 'en'
                                    ? 'border-[#FFD700]'
                                    : 'border-transparent grayscale opacity-50'
                            "
                        >
                            <img
                                src="https://flagcdn.com/w40/us.png"
                                class="w-6 h-6 rounded-full object-cover"
                                alt="EN"
                            />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div
        v-show="isMobileMenuOpen"
        class="md:hidden bg-[#002B5B] border-t border-white/10 px-4 py-4 space-y-2"
    >
        <Link href="/" class="block py-2 hover:text-[#FFD700]">{{
            $t("nav.home")
        }}</Link>
        <Link
            :href="route('news.index')"
            class="block py-2 hover:text-[#FFD700]"
            >{{ $t("nav.news") }}</Link
        >
        <Link
            :href="route('documents.index')"
            class="block py-2 hover:text-[#FFD700]"
            >{{ $t("nav.documents") }}</Link
        >
        <Link :href="route('about')" class="block py-2 hover:text-[#FFD700]">{{
            $t("nav.about")
        }}</Link>
    </div>
</template>
