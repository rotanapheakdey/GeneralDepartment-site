<script setup>
import { useI18n } from "vue-i18n";

defineProps({
    settings: {
        type: Object,
        required: true,
    }
});

const { locale } = useI18n();
</script>

<template>
    <section class="py-16 bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] shadow-2xl shadow-slate-200/50 overflow-hidden flex flex-col md:flex-row border border-white">
                <div class="md:w-1/3 bg-[#002B5B] relative flex items-center justify-center p-8">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                        <svg width="100%" height="100%">
                            <pattern id="pattern" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                                <circle cx="2" cy="2" r="1" fill="white" />
                            </pattern>
                            <rect width="100%" height="100%" fill="url(#pattern)" />
                        </svg>
                    </div>

                    <img
                        v-if="settings.director_image?.image_url"
                        :src="settings.director_image.image_url"
                        :alt="settings.director_name?.text"
                        class="relative z-10 aspect-[3/4] w-full object-cover  "
                    />
                    <div
                        v-else
                        class="relative z-10 aspect-[3/4] w-full bg-slate-800 rounded-2xl shadow-2xl flex items-center justify-center overflow-hidden border-2 border-white/20"
                    >
                        <span class="text-white/20 italic">{{
                            settings.director_name?.text || "Director Photo"
                        }}</span>
                    </div>
                </div>

                <div class="md:w-2/3 p-8 md:p-16 flex flex-col justify-center">
                    <div class="inline-block px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold uppercase tracking-widest mb-6 w-fit">
                        {{ settings.director_title?.[locale] }}
                    </div>

                    <h2 class="text-4xl font-extrabold text-slate-900 mb-6 leading-tight">
                        {{ settings.director_name?.[locale] }}
                    </h2>

                    <p class="text-xl text-slate-600 leading-relaxed mb-8 font-serif italic">
                        "{{ settings.director_quote?.[locale] }}"
                    </p>
                    <div class="h-1 w-20 bg-[#D4AF37] rounded-full"></div>
                </div>
            </div>
        </div>
    </section>
</template>
