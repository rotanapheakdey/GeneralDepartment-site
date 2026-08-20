<script setup>
import { useI18n } from "vue-i18n";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const { t, locale } = useI18n();
const settings = computed(() => usePage().props.settings || {});
const currentYear = new Date().getFullYear();

// ── Language toggle ──────────────────────────────────────────────
function switchLocale(lang) {
    locale.value = lang;
    try { localStorage.setItem("moi_locale", lang); } catch {}
}

// ── Back to top ──────────────────────────────────────────────────
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

// ── Social links ─────────────────────────────────────────────────
const socials = [
    { label: "Telegram", href: "https://t.me/moi_cambodia", color: "#26A5E4",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>` },
    { label: "Facebook", href: "https://facebook.com/moicambodia", color: "#1877F2",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>` },
    { label: "YouTube",  href: "https://youtube.com/@tvkcambodia", color: "#FF0000",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>` },
];

const quickLinks = [
    { labelKey: "footer.col1_national", href: "/news?category=national" },
    { labelKey: "footer.col3_reports",  href: "/documents" },
    { labelKey: "footer.col4_akp",      href: "https://akp.gov.kh", external: true },
    { labelKey: "footer.col5_press",    href: "/contact" },
];

const contactInfo = [
    { labelKey: "footer.col5_hotline",  href: "tel:1800200300" },
    { labelKey: "footer.col5_email",    href: "mailto:info@moi.gov.kh" },
    { labelKey: "footer.col5_address",  href: "https://maps.google.com/?q=62+Monivong+Blvd+Phnom+Penh", external: true },
];
</script>

<template>
    <footer class="bg-[#0f172a] border-t border-moi-blue relative overflow-hidden">
        <!-- Modern UI/UX Pro Max Glassmorphism Glow -->
        <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-moi-blue/10 via-transparent to-transparent opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8 relative z-10">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8 mb-16">
                <!-- Branding & Tagline -->
                <div class="md:col-span-12 lg:col-span-4 space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 shrink-0 flex items-center justify-center rounded-2xl bg-white/5 border border-white/10 p-2 backdrop-blur-md shadow-2xl ring-1 ring-white/5 transition-transform hover:scale-105 duration-300">
                            <img
                                v-if="settings.site_logo?.image_url"
                                :src="settings.site_logo.image_url"
                                alt="Ministry Logo"
                                class="w-full h-full object-contain drop-shadow-md"
                            />
                            <div
                                v-else
                                class="w-full h-full text-moi-blue-50 font-bold flex items-center justify-center"
                            >
                                MoI
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-white font-bold text-lg leading-tight tracking-wide font-sans">
                                {{ settings.dept_name?.[locale] || t("footer.legal_title") }}
                            </h3>
                            <span class="text-xs text-moi-blue-50 tracking-widest uppercase hidden md:block">
                                {{ locale === 'km' ? "Ministry of Information" : "ក្រសួងព័ត៌មាន" }}
                            </span>
                        </div>
                    </div>
                    <p class="text-[13px] text-slate-400 leading-relaxed max-w-sm">
                        {{ t("footer.tagline") }}
                    </p>
                    
                    <div class="flex flex-wrap gap-3 pt-2">
                        <a v-for="s in socials" :key="s.label" :href="s.href" target="_blank" rel="noopener noreferrer" :title="s.label"
                           class="group w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 hover:-translate-y-1 hover:shadow-lg transition-all duration-300"
                           :style="`--social-color: ${s.color}`">
                            <span class="w-5 h-5 text-slate-400 group-hover:text-[--social-color] transition-colors duration-300" v-html="s.icon"></span>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="md:col-span-6 lg:col-span-4 lg:pl-12">
                    <h4 class="text-white font-semibold mb-6 tracking-wide text-sm uppercase opacity-90">{{ t("footer.col3_title") }}</h4>
                    <ul class="space-y-4">
                        <li v-for="link in quickLinks" :key="link.labelKey">
                            <a :href="link.href" :target="link.external ? '_blank' : undefined"
                               class="text-[13px] text-slate-400 hover:text-amber-400 transition-colors duration-300 flex items-center gap-2 group">
                                <span class="w-0 group-hover:w-2 h-px bg-amber-400 transition-all duration-300 shrink-0"></span>
                                {{ t(link.labelKey) }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="md:col-span-6 lg:col-span-4">
                     <h4 class="text-white font-semibold mb-6 tracking-wide text-sm uppercase opacity-90">{{ t("footer.col5_title") }}</h4>
                     <ul class="space-y-4">
                        <li v-for="info in contactInfo" :key="info.labelKey">
                            <a :href="info.href" :target="info.external ? '_blank' : undefined"
                               class="text-[13px] text-slate-400 hover:text-amber-400 transition-colors duration-300 flex items-center gap-2 group">
                                <span class="w-0 group-hover:w-2 h-px bg-amber-400 transition-all duration-300 shrink-0"></span>
                                {{ t(info.labelKey) }}
                            </a>
                        </li>
                     </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-800 to-transparent my-8"></div>

            <!-- Bottom Area -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Copyright & Legal -->
                <div class="flex flex-col sm:flex-row items-center gap-4 text-[11px] text-slate-500">
                    <p>{{ t("footer.copyright").replace("{year}", currentYear) }}</p>
                    <div class="hidden sm:block w-1 h-1 rounded-full bg-slate-700"></div>
                    <nav class="flex gap-4">
                        <a href="#" class="hover:text-amber-400 transition-colors">{{ t("footer.terms") }}</a>
                        <a href="#" class="hover:text-amber-400 transition-colors">{{ t("footer.privacy") }}</a>
                    </nav>
                </div>

                <!-- Language & Top -->
                <div class="flex items-center gap-6">
                     <button @click="scrollToTop" class="text-xs text-slate-400 hover:text-amber-400 transition-colors flex items-center gap-1.5 group">
                        <svg class="w-4 h-4 group-hover:-translate-y-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                        </svg>
                        {{ t("footer.back_to_top") }}
                     </button>
                     
                     <div class="flex bg-slate-900/50 rounded-full p-1 border border-slate-800 backdrop-blur-md shadow-inner">
                        <button @click="switchLocale('km')" 
                            class="px-4 py-1.5 rounded-full text-[11px] font-bold transition-all duration-300"
                            :class="locale === 'km' ? 'bg-amber-400 text-slate-950 shadow-md' : 'text-slate-400 hover:text-slate-200'">
                            {{ t("footer.lang_km") }}
                        </button>
                        <button @click="switchLocale('en')" 
                            class="px-4 py-1.5 rounded-full text-[11px] font-bold transition-all duration-300"
                            :class="locale === 'en' ? 'bg-amber-400 text-slate-950 shadow-md' : 'text-slate-400 hover:text-slate-200'">
                            {{ t("footer.lang_en") }}
                        </button>
                     </div>
                </div>
            </div>
            
            <div class="mt-8 text-center text-[10px] text-slate-600/50 font-mono">
                 {{ t("footer.designed_by") }}: Rotana Pheakdey · KEO Chournsocheat · Khom Socheat
            </div>
        </div>
    </footer>
</template>

<style scoped>
footer {
    font-family: 'Kantumruy Pro', 'Siemreap', 'Inter', sans-serif;
    line-height: 1.7;
}

.group:hover [style*="--social-color"] {
    color: var(--social-color);
}
</style>
