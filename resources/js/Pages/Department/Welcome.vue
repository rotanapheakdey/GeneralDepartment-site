<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { useI18n } from "vue-i18n";

defineProps({
    canLogin: Boolean,
    latestPosts: Array,
    latestDocuments: Array,
});

// Now Vue knows what 'computed' is!
const settings = computed(() => usePage().props.settings || {});
const { locale } = useI18n();
</script>

<template>
    <GovLayout>
        <Head :title="$t('nav.home') + ' - GDIB'" />

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
                            v-if="$page.props.settings.director_image?.image_url"
                            :src="$page.props.settings.director_image.image_url"
                            :alt="$page.props.settings.director_name?.text"
                            class="relative z-10 aspect-[3/4] w-full object-cover rounded-2xl shadow-2xl border-2 border-white/20"
                        />
                        <div v-else class="relative z-10 aspect-[3/4] w-full bg-slate-800 rounded-2xl shadow-2xl flex items-center justify-center overflow-hidden border-2 border-white/20">
                            <span class="text-white/20 italic">{{ $page.props.settings.director_name?.text || 'Director Photo' }}</span>
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

        <section class="py-20 max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight">
                        {{ $t("welcome.latest_news") }}
                    </h3>
                    <p class="text-slate-500 mt-2">
                        Stay updated with our latest activities and announcements
                    </p>
                </div>
                <Link
                    :href="route('news.index')"
                    class="btn btn-primary btn-outline border-2 rounded-xl px-8 hover:bg-[#002B5B]"
                >
                    {{ $t("welcome.view_all") }}
                </Link>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    v-for="post in latestPosts"
                    :key="post.id"
                    class="group flex flex-col bg-white rounded-3xl transition-all duration-500 hover:-translate-y-2"
                >
                    <div class="relative h-64 w-full overflow-hidden rounded-3xl shadow-lg">
                        <img
                            v-if="post.image"
                            :src="post.image ? post.image : 'https://placehold.co/600x400/002B5B/FFFFFF?text=News+Update'"
                            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                        />
                        <div v-else class="h-full w-full bg-slate-200 flex items-center justify-center text-slate-400">
                            No Image
                        </div>

                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-black uppercase text-[#002B5B] shadow-sm">
                                {{ post.category }}
                            </span>
                        </div>
                    </div>
                    <div class="pt-6 px-2">
                        <h2 class="text-xl font-bold text-slate-900 leading-snug group-hover:text-[#002B5B] transition-colors line-clamp-2">
                            {{ post.title }}
                        </h2>
                        <div class="flex items-center gap-3 mt-4">
                            <Link
                                :href="route('news.show', post.id)"
                                class="text-sm font-bold text-[#D4AF37] flex items-center gap-1 group/link"
                            >
                                Read Article
                                <span class="transition-transform group-hover/link:translate-x-1">→</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center gap-4 mb-10">
                    <div class="p-3 bg-slate-100 rounded-2xl text-[#002B5B]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900">
                        {{ $t("welcome.recent_docs") }}
                    </h3>
                </div>

                <div class="bg-slate-50 rounded-[2rem] p-4 md:p-8 border border-slate-100 shadow-inner">
                    <div class="overflow-x-auto">
                        <table class="table w-full border-separate border-spacing-y-3">
                            <thead>
                                <tr class="text-slate-400 uppercase text-[10px] tracking-[0.2em] border-none">
                                    <th class="bg-transparent">{{ $t("documents.title_column") }}</th>
                                    <th class="bg-transparent">{{ $t("documents.type_column") }}</th>
                                    <th class="bg-transparent text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="doc in latestDocuments" :key="doc.id" class="group shadow-sm hover:shadow-md transition-all">
                                    <td class="bg-white rounded-l-2xl py-5 font-semibold text-slate-700">
                                        {{ doc.title }}
                                    </td>
                                    <td class="bg-white">
                                        <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-xs font-medium uppercase">
                                            {{ doc.document_type }}
                                        </span>
                                    </td>
                                    <td class="bg-white rounded-r-2xl text-right">
                                        <a
                                            :href="'/storage/' + doc.file_path"
                                            target="_blank"
                                            class="btn btn-circle btn-ghost btn-sm text-primary"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </GovLayout>
</template>
