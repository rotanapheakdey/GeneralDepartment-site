<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Breadcrumb.vue";

defineProps({
    post: Object,
    recentPosts: Array, // Accept the new data from the controller
});
</script>

<template>
    <GovLayout>
        <Head :title="post.title" />

        <div class="max-w-7xl mx-auto px-4 py-8 md:py-12">

            <div class="mb-8">
                <Breadcrumb
                    :items="[
                        { label: 'Home', url: '/' },
                        { label: 'Activities', url: route('news.index') },
                        { label: post.title.length > 40 ? post.title.substring(0, 40) + '...' : post.title },
                    ]"
                />
            </div>

            <div class="flex flex-col lg:flex-row gap-12">

                <article class="lg:w-2/3 bg-base-100 text-base-content">

                    <div class="w-full mb-8">
                        <img
                            :src="post.image ? post.image : 'https://placehold.co/1200x600/002B5B/FFFFFF?text=News+Update'"
                            @error="(e) => e.target.src = 'https://placehold.co/1200x600/002B5B/FFFFFF?text=News+Update'"
                            :alt="post.title"
                            class="w-full h-[300px] md:h-[450px] object-cover rounded-2xl shadow-md border border-base-200"
                        />
                    </div>

                    <div class="space-y-4 mb-10">
                        <div class="flex items-center gap-3">
                            <span class="badge badge-primary font-bold px-3 py-3 uppercase text-[10px] tracking-widest">
                                {{ post.category }}
                            </span>
                            <span class="text-sm opacity-60">
                                {{ post.created_at }}
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-3xl font-extrabold leading-[1.7] text-slate-900 pb-6">
                            {{ post.title }}
                        </h1>
                    </div>

                    <div
                        class="prose prose-lg max-w-none prose-slate prose-img:rounded-xl prose-headings:text-slate-900"
                        v-html="post.content"
                    ></div>

                    <div class="mt-16 pt-8 border-t border-base-300">
                        <Link
                            :href="route('news.index')"
                            class="inline-flex items-center gap-2 text-primary font-semibold hover:underline"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to all activities
                        </Link>
                    </div>
                </article>

                <aside class="lg:w-1/3">
                    <div class="sticky top-24 space-y-8">



                        <div>
                            <div class="flex items-center gap-2 mb-6 border-b border-slate-200 pb-3">
                                <div class="w-2 h-6 bg-[#D4AF37] rounded-full"></div>
                                <h3 class="text-2xl font-black text-slate-900">Latest Updates</h3>
                            </div>

                            <div class="space-y-6">
                                <Link
                                    v-for="recent in recentPosts"
                                    :key="recent.id"
                                    :href="route('news.show', recent.id)"
                                    class="group flex gap-4 items-start"
                                >
                                    <div class="shrink-0 w-24 h-24 rounded-xl overflow-hidden shadow-sm bg-slate-100">
                                        <img
                                            :src="recent.image ? recent.image : 'https://placehold.co/200x200/002B5B/FFFFFF?text=News'"
                                            @error="(e) => e.target.src = 'https://placehold.co/200x200/002B5B/FFFFFF?text=News'"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            alt="Thumbnail"
                                        />
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <span class="text-[10px] font-bold text-[#002B5B] uppercase tracking-wider mb-1">
                                            {{ recent.category }}
                                        </span>
                                        <h4 class="text-sm font-bold text-slate-900 leading-snug line-clamp-2 group-hover:text-primary transition-colors">
                                            {{ recent.title }}
                                        </h4>
                                        <span class="text-xs text-slate-500 mt-2">
                                            {{ recent.created_at }}
                                        </span>
                                    </div>
                                </Link>
                            </div>
                        </div>

                    </div>
                </aside>

            </div>
        </div>
    </GovLayout>
</template>
