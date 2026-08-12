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
    <section class="relative w-full py-20 md:py-32 flex items-center justify-center bg-[#002B5B] overflow-hidden border-b-[6px] border-[#D4AF37]">
        <!-- Subtle Pattern Overlay -->
        <div class="absolute inset-0 z-0 opacity-10">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="currentColor" stroke-width="2" fill="none"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
            </svg>
        </div>

        <!-- Background Image (Optional, kept subtle) -->
        <div class="absolute inset-0 z-0 mix-blend-overlay">
            <img
                :src="settings.site_hero_image?.image_url || 'https://placehold.co/1920x600/001730/FFFFFF?text=Ministry+of+Information'"
                alt="Ministry Background"
                class="w-full h-full object-cover opacity-20"
            />
        </div>
        
        <!-- Gradient Mask to blend image -->
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-[#002B5B] via-transparent to-[#002B5B]/80"></div>

        <div class="relative z-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex flex-col items-center justify-center">
            
            <!-- Center: Text Content -->
            <div class="w-full text-center flex flex-col items-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-md mb-6 shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
                    <span class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest">
                        គេហទំព័រផ្លូវការ / Official Portal
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 drop-shadow-lg">
                    {{ settings.dept_name?.[locale] || 'ក្រសួងព័ត៌មាន' }}
                </h1>

                <h2 class="text-sm md:text-lg text-slate-300 font-serif font-medium tracking-[0.15em] uppercase mb-10 drop-shadow-sm flex items-center justify-center gap-4">
                    <span class="hidden md:block w-12 h-[1px] bg-[#D4AF37]"></span>
                    {{ locale === 'km' ? settings.dept_name?.en : settings.dept_name?.km }}
                    <span class="hidden md:block w-12 h-[1px] bg-[#D4AF37]"></span>
                </h2>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">
                    <Link
                        :href="route('news.index')"
                        class="w-full sm:w-auto btn bg-[#D4AF37] hover:bg-[#FFF3A3] text-slate-900 border-none rounded-xl px-8 h-12 text-base shadow-lg shadow-black/20 transition-all hover:-translate-y-0.5 font-bold"
                    >
                        ព័ត៌មានថ្មីៗ / Latest News
                    </Link>
                    <a
                        href="#documents"
                        class="w-full sm:w-auto btn btn-outline border-white/30 text-white hover:bg-white hover:text-[#002B5B] hover:border-white rounded-xl px-8 h-12 text-base backdrop-blur-sm transition-all hover:-translate-y-0.5 font-semibold"
                    >
                        ឯកសារផ្លូវការ / Official Docs
                    </a>
                </div>
            </div>

        </div>
    </section>
</template>
