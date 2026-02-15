<script setup>
import GovLayout from '@/Layouts/GovLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

// Receiving the 'post' object from the NewsController
defineProps({
    post: Object
});

/**
 * Formats the ISO date into a more formal government-style date
 */
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
};
</script>

<template>
    <GovLayout>
        <Head :title="post.title" />

        <div class="py-12 bg-white min-h-screen">
            <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

                <nav class="flex mb-10 text-xs font-bold uppercase tracking-widest text-slate-400" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <Link href="/" class="hover:text-gov-blue transition">Home</Link>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-2" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                                <Link :href="route('news.index')" class="hover:text-gov-blue transition">Activities</Link>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center text-slate-300">
                                <svg class="w-3 h-3 mx-2" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                                <span class="truncate max-w-[150px] md:max-w-xs">Article Details</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <header class="mb-12 border-b border-slate-100 pb-10">
                    <div class="mb-6">
                        <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-md text-xs font-bold bg-blue-50 text-gov-blue uppercase border border-blue-100">
                            Official Press Release
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-[1.15] mb-8">
                        {{ post.title }}
                    </h1>

                    <div class="flex flex-wrap items-center justify-between gap-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gov-blue rounded-xl flex items-center justify-center text-white text-[10px] font-black shadow-lg shadow-blue-900/20">
                                MOI
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900 uppercase tracking-tight">Department of Digital Content</p>
                                <p class="text-xs text-slate-500 font-medium italic">Ministry of Information</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest mb-1">Release Date</p>
                            <time class="text-sm font-bold text-slate-700">{{ formatDate(post.created_at) }}</time>
                        </div>
                    </div>
                </header>

                <div class="prose prose-lg prose-slate max-w-none
                            prose-headings:text-gov-blue prose-headings:font-extrabold
                            prose-p:text-slate-700 prose-p:leading-relaxed
                            prose-a:text-blue-600 prose-a:font-bold hover:prose-a:text-gov-blue
                            prose-img:rounded-2xl prose-img:shadow-xl
                            prose-blockquote:border-l-gov-blue prose-blockquote:bg-slate-50 prose-blockquote:p-6 prose-blockquote:rounded-r-xl">

                    <div v-html="post.content"></div>

                </div>

                <footer class="mt-20 pt-10 border-t-2 border-slate-100">
                    <div class="flex items-center justify-between">
                        <Link :href="route('news.index')" class="inline-flex items-center gap-x-2 text-sm font-bold text-gov-blue hover:text-blue-800 transition group">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            Back to All Activities
                        </Link>

                        <button @click="window.print()" class="hidden md:inline-flex items-center gap-x-2 text-xs font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            Print Document
                        </button>
                    </div>
                </footer>

            </article>
        </div>
    </GovLayout>
</template>

<style scoped>
/* Optional: Adding a subtle Khmer-friendly font fallback if needed for your local context */
article {
    text-rendering: optimizeLegibility;
}
</style>
