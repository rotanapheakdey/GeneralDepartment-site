<script setup>
import { useI18n } from "vue-i18n";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";

const props = defineProps({
    settings: {
        type: Object,
        required: true,
    },
    banners: {
        type: Array,
        default: () => [],
    }
});

const { locale } = useI18n();

const currentSlide = ref(0);
let slideInterval = null;

const nextSlide = () => {
    if (props.banners.length === 0) return;
    currentSlide.value = (currentSlide.value + 1) % props.banners.length;
};

const prevSlide = () => {
    if (props.banners.length === 0) return;
    currentSlide.value = (currentSlide.value - 1 + props.banners.length) % props.banners.length;
};

const goToSlide = (index) => {
    currentSlide.value = index;
};

const startAutoPlay = () => {
    if (props.banners.length > 1) {
        slideInterval = setInterval(nextSlide, 6000);
    }
};

const stopAutoPlay = () => {
    if (slideInterval) clearInterval(slideInterval);
};

onMounted(() => {
    startAutoPlay();
});

onUnmounted(() => {
    stopAutoPlay();
});
</script>

<template>
    <section class="relative w-full py-20 lg:py-32 flex items-center justify-center bg-moi-navy overflow-hidden border-b border-moi-blue">
        <!-- Subtle Pattern Overlay -->
        <div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="currentColor" stroke-width="2" fill="none"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
            </svg>
        </div>

        <!-- Optional subtle background image -->
        <div class="absolute inset-0 z-0 mix-blend-overlay opacity-20 pointer-events-none">
            <img
                :src="settings.site_hero_image?.image_url || 'https://placehold.co/1920x600/082866/FFFFFF?text=Ministry+of+Information'"
                alt="Ministry Background"
                class="w-full h-full object-cover"
            />
        </div>
        <div class="absolute inset-0 z-1 bg-gradient-to-t from-moi-navy via-transparent to-moi-navy/80 pointer-events-none"></div>

        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">
                
                <!-- Left: Text Content -->
                <div class="w-full lg:w-1/2 flex flex-col items-start text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 backdrop-blur-md mb-6 shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-moi-red animate-pulse"></span>
                        <span class="text-white text-xs font-bold uppercase tracking-widest">
                            គេហទំព័រផ្លូវការ / Official Portal
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-4 drop-shadow-lg font-sans">
                        {{ settings.dept_name?.[locale] || 'ក្រសួងព័ត៌មាន' }}
                    </h1>

                    <h2 class="text-base md:text-lg text-moi-blue-50 font-medium tracking-[0.15em] uppercase mb-10 drop-shadow-sm flex items-center gap-4">
                        <span class="w-12 h-[2px] bg-moi-blue"></span>
                        {{ locale === 'km' ? settings.dept_name?.en : settings.dept_name?.km }}
                    </h2>

                    <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                        <Link
                            :href="route('news.index')"
                            class="w-full sm:w-auto flex items-center justify-center gap-2 bg-moi-blue hover:bg-moi-blue-hover text-white border-none rounded-xl px-8 h-14 text-base shadow-lg shadow-moi-blue/30 transition-all hover:-translate-y-1 font-bold"
                        >
                            ព័ត៌មានថ្មីៗ / Latest News
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </Link>
                        <a
                            href="#documents"
                            class="w-full sm:w-auto flex items-center justify-center bg-white/10 border border-white/30 text-white hover:bg-white hover:text-moi-navy hover:border-white rounded-xl px-8 h-14 text-base backdrop-blur-md transition-all hover:-translate-y-1 font-semibold"
                        >
                            ឯកសារផ្លូវការ / Official Docs
                        </a>
                    </div>
                </div>

                <!-- Right: Banner Slider -->
                <div class="w-full lg:w-1/2" @mouseenter="stopAutoPlay" @mouseleave="startAutoPlay">
                    <div class="relative w-full aspect-[16/10] rounded-2xl overflow-hidden shadow-2xl shadow-moi-navy/50 border border-white/10 bg-moi-navy">
                        <template v-if="banners && banners.length > 0">
                            <!-- Slides -->
                            <div 
                                v-for="(banner, index) in banners" 
                                :key="banner.id"
                                class="absolute inset-0 transition-opacity duration-700 ease-in-out"
                                :class="index === currentSlide ? 'opacity-100 z-10' : 'opacity-0 z-0'"
                            >
                                <a :href="banner.link || '#'" class="block w-full h-full">
                                    <img 
                                        v-if="banner.image_url"
                                        :src="banner.image_url" 
                                        class="w-full h-full object-cover scale-105 transform transition-transform duration-[10000ms] ease-out"
                                        :class="index === currentSlide ? 'scale-100' : 'scale-105'"
                                        alt="Banner" 
                                    />
                                    
                                    <!-- Gradient Overlay for title -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-moi-navy/90 via-moi-navy/30 to-transparent"></div>
                                    
                                    <!-- Banner Title -->
                                    <div class="absolute bottom-0 left-0 w-full p-6 pb-12">
                                        <h3 class="text-white font-bold text-lg md:text-xl line-clamp-2 drop-shadow-md">
                                            {{ locale === 'km' ? banner.title_km : banner.title_en }}
                                        </h3>
                                    </div>
                                </a>
                            </div>

                            <!-- Slider Controls -->
                            <div v-if="banners.length > 1" class="absolute bottom-4 left-6 z-20 flex items-center gap-3">
                                <button 
                                    v-for="(banner, index) in banners" 
                                    :key="banner.id"
                                    @click="goToSlide(index)"
                                    class="h-1.5 rounded-full transition-all duration-300"
                                    :class="index === currentSlide ? 'bg-moi-red w-8' : 'bg-white/50 hover:bg-white w-4'"
                                    :aria-label="'Go to slide ' + (index + 1)"
                                ></button>
                            </div>

                            <!-- Next/Prev Buttons -->
                            <div v-if="banners.length > 1" class="absolute bottom-4 right-4 z-20 flex items-center gap-2">
                                <button 
                                    @click="prevSlide" 
                                    class="w-8 h-8 flex items-center justify-center bg-white/10 border border-white/20 hover:bg-white/30 text-white rounded-full backdrop-blur-md transition-all"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                                </button>
                                <button 
                                    @click="nextSlide" 
                                    class="w-8 h-8 flex items-center justify-center bg-white/10 border border-white/20 hover:bg-white/30 text-white rounded-full backdrop-blur-md transition-all"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            </div>
                        </template>

                        <!-- Fallback if no banners -->
                        <div v-else class="w-full h-full flex items-center justify-center bg-moi-navy">
                            <span class="text-white/30 italic">No banners available</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>
