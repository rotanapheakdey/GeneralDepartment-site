<script setup>
import { ref, computed } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import { useI18n } from "vue-i18n";
import { Link } from "@inertiajs/vue3";

const page = usePage();
const { t, locale } = useI18n();

const settings = computed(() => page.props.settings || {});
const currentYear = new Date().getFullYear();

// ── Language toggle ──────────────────────────────────────────────
function switchLocale(lang) {
    locale.value = lang;
    try { localStorage.setItem("moi_locale", lang); } catch {}
}

// ── Newsletter subscription ──────────────────────────────────────
const email       = ref("");
const subState    = ref("idle"); // idle | loading | success | error
const emailError  = ref("");

function validateEmail(val) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
}

function handleSubscribe() {
    if (!validateEmail(email.value)) {
        emailError.value = locale.value === "km"
            ? "អ៊ីមែលមិនត្រឹមត្រូវ"
            : "Please enter a valid email address.";
        return;
    }
    emailError.value = "";
    subState.value   = "loading";
    // Simulate async — replace with real API call when endpoint exists
    setTimeout(() => { subState.value = "success"; }, 1500);
}

// ── Back to top ──────────────────────────────────────────────────
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

// ── Collapsible accordion for mobile ────────────────────────────
const openColumns = ref(new Set());
function toggleCol(idx) {
    if (openColumns.value.has(idx)) {
        openColumns.value.delete(idx);
    } else {
        openColumns.value.add(idx);
    }
}
function isOpen(idx) { return openColumns.value.has(idx); }

// ── Nav columns data (keys resolved at render time via $t) ───────
const columns = [
    {
        titleKey: "footer.col1_title",
        links: [
            { labelKey: "footer.col1_national",      href: "/news?category=national" },
            { labelKey: "footer.col1_international",  href: "/news?category=international" },
            { labelKey: "footer.col1_economy",        href: "/news?category=economy" },
            { labelKey: "footer.col1_society",        href: "/news?category=society" },
            { labelKey: "footer.col1_culture",        href: "/news?category=culture" },
            { labelKey: "footer.col1_sports",         href: "/news?category=sports" },
        ],
    },
    {
        titleKey: "footer.col2_title",
        links: [
            { labelKey: "footer.col2_live_tv",  href: "#" },
            { labelKey: "footer.col2_radio_am", href: "#" },
            { labelKey: "footer.col2_radio_fm", href: "#" },
            { labelKey: "footer.col2_gallery",  href: "#" },
            { labelKey: "footer.col2_briefings",href: "#" },
        ],
    },
    {
        titleKey: "footer.col3_title",
        links: [
            { labelKey: "footer.col3_kram",     href: "/documents?type=royal_decree" },
            { labelKey: "footer.col3_anukret",  href: "/documents?type=sub_decree" },
            { labelKey: "footer.col3_prakas",   href: "/documents?type=prakas" },
            { labelKey: "footer.col3_sarachea", href: "/documents?type=directive" },
            { labelKey: "footer.col3_reports",  href: "/documents" },
        ],
    },
    {
        titleKey: "footer.col4_title",
        links: [
            { labelKey: "footer.col4_info",       href: "#" },
            { labelKey: "footer.col4_admin",      href: "#" },
            { labelKey: "footer.col4_akp",        href: "https://akp.gov.kh", external: true },
            { labelKey: "footer.col4_provincial", href: "#" },
        ],
    },
    {
        titleKey: "footer.col5_title",
        links: [
            { labelKey: "footer.col5_address",  href: "https://maps.google.com/?q=62+Monivong+Blvd+Phnom+Penh", external: true },
            { labelKey: "footer.col5_hotline",  href: "tel:1800200300" },
            { labelKey: "footer.col5_press",    href: "/contact" },
            { labelKey: "footer.col5_feedback", href: "/contact" },
            { labelKey: "footer.col5_email",    href: "mailto:info@moi.gov.kh" },
        ],
    },
];

// ── Social links ─────────────────────────────────────────────────
const socials = [
    { label: "Telegram", href: "https://t.me/moi_cambodia", color: "#26A5E4",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>` },
    { label: "Facebook", href: "https://facebook.com/moicambodia", color: "#1877F2",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>` },
    { label: "YouTube",  href: "https://youtube.com/@tvkcambodia", color: "#FF0000",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>` },
    { label: "X/Twitter",href: "https://x.com/moi_cambodia", color: "#000000",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>` },
    { label: "TikTok",   href: "https://tiktok.com/@moi_cambodia", color: "#010101",
      icon: `<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.74a4.85 4.85 0 0 1-1.01-.05z"/></svg>` },
];
</script>

<template>
    <footer class="bg-moi-navy border-t border-moi-blue text-moi-slate-300">

        <!-- ══════════════════════════════════════════════════════════
             TIER 1 — Engagement: Newsletter + Socials
        ══════════════════════════════════════════════════════════ -->
        <div class="border-b border-moi-blue/40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex flex-col lg:flex-row items-start lg:items-center gap-10">

                <!-- Newsletter -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1.5">
                        <span class="w-5 h-5 text-amber-400">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
                        </span>
                        <h3 class="text-white font-bold text-base tracking-tight">
                            {{ $t("footer.newsletter_heading") }}
                        </h3>
                    </div>
                    <p class="text-xs text-moi-slate-500 mb-4 max-w-md leading-relaxed break-words">
                        {{ $t("footer.newsletter_subheading") }}
                    </p>

                    <!-- Form -->
                    <div v-if="subState !== 'success'" class="flex flex-col sm:flex-row gap-2 max-w-lg">
                        <div class="flex-1">
                            <input
                                v-model="email"
                                type="email"
                                :placeholder="$t('footer.email_placeholder')"
                                @keyup.enter="handleSubscribe"
                                class="w-full bg-moi-blue border text-white text-sm rounded-lg px-4 py-2.5 placeholder-zinc-600 focus:outline-none focus:ring-2 focus:ring-amber-400/40 transition"
                                :class="emailError ? 'border-red-500/60' : 'border-moi-slate-700 focus:border-amber-400/60'"
                            />
                            <p v-if="emailError" class="text-red-400 text-[11px] mt-1">{{ emailError }}</p>
                        </div>
                        <button
                            @click="handleSubscribe"
                            :disabled="subState === 'loading'"
                            class="shrink-0 bg-amber-400 hover:bg-amber-300 active:scale-95 text-moi-slate-950 font-bold text-sm px-5 py-2.5 rounded-lg transition-all duration-200 disabled:opacity-60 disabled:cursor-not-allowed"
                        >
                            <span v-if="subState === 'loading'" class="flex items-center gap-1.5">
                                <svg class="animate-spin w-4 h-4" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                {{ $t("footer.subscribe_loading") }}
                            </span>
                            <span v-else>{{ $t("footer.subscribe_btn") }}</span>
                        </button>
                    </div>
                    <div v-else class="flex items-center gap-2 text-emerald-400 text-sm font-semibold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ $t("footer.subscribe_success") }}
                    </div>

                    <!-- Quick action badges -->
                    <div class="flex flex-wrap gap-2 mt-4">
                        <a href="#" class="inline-flex items-center gap-1.5 bg-red-600/10 border border-red-600/30 text-red-400 hover:bg-red-600/20 text-[11px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full transition group">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            {{ $t("footer.breaking_alert") }}
                        </a>
                        <a href="#" class="inline-flex items-center gap-1.5 bg-moi-blue-hover border border-moi-slate-700 text-moi-slate-400 hover:text-amber-400 hover:border-amber-400/40 text-[11px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-full transition">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M6.18 15.64a2.18 2.18 0 0 1 2.18 2.18C8.36 19.01 7.38 20 6.18 20C4.98 20 4 19.01 4 17.82a2.18 2.18 0 0 1 2.18-2.18M6.18 11.64A6.18 6.18 0 0 1 12.36 17.82h-2A4.18 4.18 0 0 0 6.18 13.64v-2m0-4A10.18 10.18 0 0 1 16.36 17.82h-2A8.18 8.18 0 0 0 6.18 9.64v-2M4 4h16v2H4V4z"/></svg>
                            {{ $t("footer.rss_feed") }}
                        </a>
                    </div>
                </div>

                <!-- Divider -->
                <div class="hidden lg:block w-px h-32 bg-moi-blue-hover"></div>

                <!-- Social channels -->
                <div class="shrink-0">
                    <p class="text-[11px] font-bold uppercase tracking-widest text-moi-slate-500 mb-4">
                        {{ $t("footer.follow_us") }}
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a
                            v-for="s in socials"
                            :key="s.label"
                            :href="s.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            :title="s.label"
                            class="group w-10 h-10 flex items-center justify-center rounded-xl bg-moi-blue border border-moi-slate-800 hover:border-moi-slate-600 hover:scale-110 hover:shadow-lg transition-all duration-200"
                            :style="`--social-color: ${s.color}`"
                        >
                            <span
                                class="w-5 h-5 text-moi-slate-500 group-hover:text-[--social-color] transition-colors duration-200"
                                v-html="s.icon"
                            ></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════════════════════════
             TIER 2 — 5-Column Navigation Grid
        ══════════════════════════════════════════════════════════ -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Desktop grid (lg+) -->
            <div class="hidden lg:grid grid-cols-5 gap-8">
                <div v-for="col in columns" :key="col.titleKey" class="space-y-4">
                    <h4 class="text-[11px] font-black uppercase tracking-widest text-amber-400">
                        {{ $t(col.titleKey) }}
                    </h4>
                    <ul class="space-y-2.5">
                        <li v-for="link in col.links" :key="link.labelKey">
                            <a
                                :href="link.href"
                                :target="link.external ? '_blank' : undefined"
                                :rel="link.external ? 'noopener noreferrer' : undefined"
                                class="text-[13px] text-moi-slate-500 hover:text-white leading-relaxed break-words transition-colors duration-200 flex items-center gap-1 group"
                            >
                                <span class="w-0 group-hover:w-2 h-px bg-amber-400 transition-all duration-300 shrink-0"></span>
                                {{ $t(link.labelKey) }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Mobile/Tablet accordion (< lg) -->
            <div class="lg:hidden space-y-1">
                <div v-for="(col, idx) in columns" :key="col.titleKey" class="border border-moi-slate-800 rounded-xl overflow-hidden">
                    <button
                        @click="toggleCol(idx)"
                        class="w-full flex items-center justify-between px-5 py-4 text-left focus:outline-none focus:ring-2 focus:ring-amber-400/30"
                    >
                        <span class="text-[11px] font-black uppercase tracking-widest text-amber-400">
                            {{ $t(col.titleKey) }}
                        </span>
                        <svg
                            class="w-4 h-4 text-moi-slate-500 transition-transform duration-300"
                            :class="isOpen(idx) ? 'rotate-180' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div
                        class="overflow-hidden transition-all duration-300"
                        :class="isOpen(idx) ? 'max-h-96' : 'max-h-0'"
                    >
                        <ul class="px-5 pb-4 space-y-3">
                            <li v-for="link in col.links" :key="link.labelKey">
                                <a
                                    :href="link.href"
                                    :target="link.external ? '_blank' : undefined"
                                    :rel="link.external ? 'noopener noreferrer' : undefined"
                                    class="text-[13px] text-moi-slate-400 hover:text-white leading-relaxed break-words transition-colors"
                                >
                                    {{ $t(link.labelKey) }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════════════════════════
             TIER 3 — Legal, Language Switcher, Attribution
        ══════════════════════════════════════════════════════════ -->
        <div class="border-t border-moi-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

                <!-- Top row: Emblem + Legal title + Back to top -->
                <div class="flex flex-col sm:flex-row items-center sm:items-start justify-between gap-6 mb-6">

                    <!-- Emblem & title -->
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 shrink-0 flex items-center justify-center rounded-full bg-moi-blue border border-moi-slate-800 p-1.5">
                            <img
                                src="/images/moi-emblem.png"
                                alt="Ministry of Information Emblem"
                                class="w-full h-full object-contain"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            />
                            <!-- Fallback shield when image missing -->
                            <div class="hidden w-full h-full items-center justify-center text-amber-400">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-left">
                            <p class="text-white font-bold text-sm leading-snug">
                                {{ $t("footer.legal_title") }}
                            </p>
                            <p class="text-moi-slate-500 text-[11px] mt-0.5 leading-relaxed break-words">
                                {{ $t("footer.tagline").substring(0, 70) }}…
                            </p>
                        </div>
                    </div>

                    <!-- Back to top -->
                    <button
                        @click="scrollToTop"
                        class="shrink-0 inline-flex items-center gap-2 text-xs text-moi-slate-500 hover:text-amber-400 transition-colors group"
                    >
                        <svg class="w-4 h-4 group-hover:-translate-y-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                        </svg>
                        {{ $t("footer.back_to_top") }}
                    </button>
                </div>

                <!-- Bottom row: Copyright + Legal links + Language switcher -->
                <div class="border-t border-moi-slate-800/60 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">

                    <!-- Copyright -->
                    <p class="text-[11px] text-moi-slate-600 text-center md:text-left">
                        {{ $t("footer.copyright").replace("{year}", currentYear) }}
                    </p>

                    <!-- Legal links -->
                    <nav class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2">
                        <a v-for="lnk in [
                            { key: 'footer.terms',     href: '#' },
                            { key: 'footer.privacy',   href: '#' },
                            { key: 'footer.media_kit', href: '#' },
                            { key: 'footer.cookie',    href: '#' },
                        ]"
                        :key="lnk.key"
                        :href="lnk.href"
                        class="text-[11px] text-moi-slate-600 hover:text-moi-slate-300 transition-colors"
                        >
                            {{ $t(lnk.key) }}
                        </a>
                    </nav>

                    <!-- Language switcher pill -->
                    <div class="flex items-center bg-moi-blue border border-moi-slate-800 rounded-full p-0.5 shrink-0">
                        <button
                            @click="switchLocale('km')"
                            class="px-4 py-1.5 rounded-full text-[11px] font-bold transition-all duration-200"
                            :class="locale === 'km'
                                ? 'bg-amber-400 text-moi-slate-950 shadow-sm'
                                : 'text-moi-slate-500 hover:text-moi-slate-300'"
                        >
                            {{ $t("footer.lang_km") }}
                        </button>
                        <button
                            @click="switchLocale('en')"
                            class="px-4 py-1.5 rounded-full text-[11px] font-bold transition-all duration-200"
                            :class="locale === 'en'
                                ? 'bg-amber-400 text-moi-slate-950 shadow-sm'
                                : 'text-moi-slate-500 hover:text-moi-slate-300'"
                        >
                            {{ $t("footer.lang_en") }}
                        </button>
                    </div>

                </div>

                <!-- Developer attribution (preserved) -->
                <div class="mt-4 pt-4 border-t border-moi-slate-900 flex flex-wrap gap-x-6 gap-y-1 justify-center">
                    <p class="text-[10px] text-moi-slate-700 italic">
                        {{ $t("footer.designed_by") }}:
                        <span class="text-moi-slate-600 not-italic">Rotana Pheakdey</span> ·
                        <span class="text-moi-slate-600 not-italic">KEO Chournsocheat</span> ·
                        <span class="text-moi-slate-600 not-italic">Khom Socheat</span>
                    </p>
                    <p class="text-[10px] text-moi-slate-800 italic">{{ $t("footer.academic") }}</p>
                </div>

            </div>
        </div>
    </footer>
</template>

<style scoped>
/* Khmer typography — ensure sub-consonants (ជើង) don't clip */
footer {
    font-family: 'Kantumruy Pro', 'Siemreap', 'Inter', sans-serif;
    line-height: 1.7;
    word-break: break-word;
    overflow-wrap: break-word;
}

/* Social icon CSS custom property scope */
.group:hover [style*="--social-color"] {
    color: var(--social-color);
}
</style>
