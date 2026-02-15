<script setup>
import GovLayout from '@/Layouts/GovLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    posts: Array
});
</script>

<template>
    <GovLayout>
        <Head title="Department Activities" />

        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="mb-12 border-b-2 border-slate-200 pb-6 flex justify-between items-end">
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-900 uppercase tracking-tight">Recent Activities</h1>
                    <p class="text-slate-500 mt-2">Latest news and announcements from the Department of Digital Content.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div v-for="post in posts" :key="post.id" class="flex flex-col bg-white border shadow-sm rounded-xl overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center gap-x-3 mb-4">
                            <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-md text-xs font-medium bg-blue-100 text-blue-800 uppercase">
                                News
                            </span>
                            <span class="text-xs text-slate-400 italic">
                                {{ new Date(post.created_at).toLocaleDateString() }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 line-clamp-2">
                            {{ post.title }}
                        </h3>
                        <p class="text-slate-600 text-sm mb-6 line-clamp-3">
                            {{ post.excerpt }}
                        </p>
                        <Link :href="route('news.show', post.slug)" class="mt-auto inline-flex items-center gap-x-2 text-sm font-semibold text-gov-blue hover:text-blue-800 transition">
                            Read Official Release
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </GovLayout>
</template>
