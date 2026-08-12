<script setup>
import { useI18n } from "vue-i18n";
import { ref, onMounted, onUnmounted } from "vue";

const props = defineProps({
    banners: {
        type: Array,
        required: true,
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
        slideInterval = setInterval(nextSlide, 5000);
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full mb-12">
        <div 
            class="relative w-full h-[40vh] md:h-[60vh] bg-slate-900 overflow-hidden rounded-2xl shadow-xl" 
            @mouseenter="stopAutoPlay" 
            @mouseleave="startAutoPlay"
        >
            <!-- Banners -->
            <div 
                v-if="banners && banners.length > 0"
                class="w-full h-full relative"
            >
            <div 
                v-for="(banner, index) in banners" 
                :key="banner.id"
                class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                :class="index === currentSlide ? 'opacity-100 z-10' : 'opacity-0 z-0'"
            >
                <img 
                    v-if="banner.image_url"
                    :src="banner.image_url" 
                    class="w-full h-full object-cover" 
                    alt="Banner" 
                />
                <div v-else class="w-full h-full bg-slate-800 flex items-center justify-center text-white">
                    <span class="opacity-50">No Image</span>
                </div>
                
                <!-- Overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

                <!-- Content -->
                <div class="absolute bottom-0 left-0 w-full p-8 md:p-16 flex flex-col justify-end">
                    <div class="max-w-7xl mx-auto w-full">
                        <h2 v-if="locale === 'km' && banner.title_km" class="text-3xl md:text-5xl font-bold text-white mb-4 shadow-sm">
                            {{ banner.title_km }}
                        </h2>
                        <h2 v-else-if="locale === 'en' && banner.title_en" class="text-3xl md:text-5xl font-bold text-white mb-4 shadow-sm">
                            {{ banner.title_en }}
                        </h2>
                        <a 
                            v-if="banner.link" 
                            :href="banner.link" 
                            class="inline-block px-6 py-3 bg-[#D4AF37] text-slate-900 font-bold rounded-full hover:bg-white transition-colors"
                        >
                            {{ $t('news.read_article') || 'Read More' }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button 
                v-if="banners.length > 1"
                @click="prevSlide" 
                class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center bg-black/30 hover:bg-black/60 text-white rounded-full backdrop-blur-sm transition-all"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button 
                v-if="banners.length > 1"
                @click="nextSlide" 
                class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-12 h-12 flex items-center justify-center bg-black/30 hover:bg-black/60 text-white rounded-full backdrop-blur-sm transition-all"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Indicators -->
            <div v-if="banners.length > 1" class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2">
                <button 
                    v-for="(banner, index) in banners" 
                    :key="banner.id"
                    @click="goToSlide(index)"
                    class="w-3 h-3 rounded-full transition-all"
                    :class="index === currentSlide ? 'bg-[#D4AF37] w-8' : 'bg-white/50 hover:bg-white'"
                ></button>
            </div>
        </div>
        
            <!-- Placeholder if no banners -->
            <div v-else class="w-full h-full flex flex-col items-center justify-center text-white p-8 text-center bg-slate-800">
                <h1 class="text-4xl md:text-6xl font-black mb-4">Ministry of Information</h1>
                <p class="text-xl text-slate-300">Welcome to the official portal.</p>
            </div>
        </div>
    </div>
</template>
