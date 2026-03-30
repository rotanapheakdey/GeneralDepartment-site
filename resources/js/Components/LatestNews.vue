<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";

defineProps({
    posts: {
        type: Array,
        required: true,
    }
});

// Setup the Auto-Scroll Logic
const scrollContainer = ref(null);
let scrollInterval = null;

const startAutoScroll = () => {
    // Scroll every 3.5 seconds
    scrollInterval = setInterval(() => {
        if (scrollContainer.value) {
            const { scrollLeft, scrollWidth, clientWidth } = scrollContainer.value;

            // If we have reached the end of the scroll container, snap back to the start
            if (scrollLeft + clientWidth >= scrollWidth - 10) {
                scrollContainer.value.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                // Otherwise, scroll right by roughly the width of one card (350px)
                scrollContainer.value.scrollBy({ left: 370, behavior: 'smooth' });
            }
        }
    }, 3500);
};

const stopAutoScroll = () => {
    if (scrollInterval) {
        clearInterval(scrollInterval);
    }
};

// Start when component loads, clean up when it unloads
onMounted(() => startAutoScroll());
onUnmounted(() => stopAutoScroll());
</script>

<template>
    <section class="py-20 max-w-7xl mx-auto px-4 overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                    <span class="w-2 h-8 bg-secondary rounded-full"></span> {{ $t("welcome.latest_news") }}
                </h3>
                <p class="text-slate-500 mt-2">
                    Stay updated with our latest activities and announcements
                </p>
            </div>
            <Link
                :href="route('news.index')"
                class="btn btn-primary btn-outline border-2 rounded-xl px-8 hover:bg-primary hover:text-white transition-colors"
            >
                {{ $t("welcome.view_all") }}
            </Link>
        </div>

        <div
            ref="scrollContainer"
            @mouseenter="stopAutoScroll"
            @mouseleave="startAutoScroll"
            @touchstart="stopAutoScroll"
            @touchend="startAutoScroll"
            class="flex gap-8 overflow-x-auto pb-8 snap-x snap-mandatory hide-scrollbar cursor-grab active:cursor-grabbing"
            style="scrollbar-width: none; -ms-overflow-style: none;"
        >
            <div
                v-for="post in posts"
                :key="post.id"
                class="group flex flex-col bg-base-100 rounded-3xl transition-all duration-500 hover:-translate-y-2 shrink-0 w-[300px] md:w-[350px] snap-start border border-base-200 shadow-sm hover:shadow-xl"
            >
                <div class="relative h-56 w-full overflow-hidden rounded-t-3xl bg-base-200">
                    <img
                        v-if="post.image"
                        :src="post.image"
                        @error="(e) => e.target.src = 'https://placehold.co/600x400/002B5B/FFFFFF?text=News+Update'"
                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="News Image"
                    />
                    <img
                        v-else
                        src="https://placehold.co/600x400/002B5B/FFFFFF?text=News+Update"
                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Placeholder Image"
                    />

                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-black uppercase text-primary shadow-sm border border-white/20">
                            {{ post.category }}
                        </span>
                    </div>
                </div>

                <div class="p-6 flex flex-col grow justify-between">
                    <div>
                        <span class="text-xs text-slate-500 mb-2 block">
                            {{ post.created_at || 'Recent' }}
                        </span>
                        <h2 class="text-lg font-bold text-slate-900 leading-snug group-hover:text-primary transition-colors line-clamp-3 mb-4">
                            {{ post.title }}
                        </h2>
                    </div>

                    <div class="flex items-center mt-auto">
                        <Link
                            :href="route('news.show', post.id)"
                            class="text-sm font-bold text-secondary flex items-center gap-1 group/link"
                        >
                            Read Article
                            <span class="transition-transform group-hover/link:translate-x-1">→</span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Ensures the scrollbar remains hidden on webkit browsers (Chrome/Safari) */
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
</style>
