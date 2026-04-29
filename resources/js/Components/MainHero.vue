<script setup>
import { useI18n } from "vue-i18n";
import { Link } from "@inertiajs/vue3";

defineProps({
    settings: {
        type: Object,
        required: true,
    }
});

const { locale } = useI18n();
</script>

<template>
    <section class="relative w-full min-h-[75vh] flex items-center justify-center bg-slate-900 overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img
                :src="settings.site_hero_image?.image_url || 'https://placehold.co/1920x1080/001730/FFFFFF?text=Ministry+of+Information+Building'"
                alt="GDIB Background"
                class="w-full h-full object-cover opacity-30"
            />
        </div>

        <div class="absolute inset-0 z-10 bg-gradient-to-b from-[#002B5B]/90 via-[#002B5B]/60 to-[#002B5B]/90"></div>

        <div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center text-center">

            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-md mb-8">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-pulse"></span>
                <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest">
                    គេហទំព័រផ្លូវការ / Official Portal
                </span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 drop-shadow-2xl">
                {{ settings.dept_name?.[locale] || 'អគ្គនាយកដ្ឋានព័ត៌មាន និងសោតទស្សន៍' }}
            </h1>

            <h2 v-if="locale === 'km'" class="text-sm md:text-xl text-slate-300 font-serif font-medium tracking-[0.2em] uppercase mb-12 drop-shadow-lg">
                {{ settings.dept_name?.en }}
            </h2>
            <h2 v-if="locale === 'en'" class="text-sm md:text-xl text-slate-300 font-serif font-medium tracking-[0.2em] uppercase mb-12 drop-shadow-lg">
                {{ settings.dept_name?.km }}
            </h2>

            <div class="flex flex-col sm:flex-row items-center gap-6">
                <Link
                    :href="route('news.index')"
                    class="btn bg-[#D4AF37] hover:bg-[#B5952F] text-slate-900 border-none rounded-xl px-10 h-14 text-lg shadow-xl shadow-black/30 transition-transform hover:scale-105"
                >
                    ព័ត៌មានថ្មីៗ / Latest News
                </Link>
                <a
                    href="#documents"
                    class="btn btn-outline border-white/30 text-white hover:bg-white hover:text-[#002B5B] rounded-xl px-10 h-14 text-lg backdrop-blur-sm transition-all hover:scale-105"
                >
                    ឯកសារផ្លូវការ / Official Docs
                </a>
            </div>

        </div>
    </section>
</template>
