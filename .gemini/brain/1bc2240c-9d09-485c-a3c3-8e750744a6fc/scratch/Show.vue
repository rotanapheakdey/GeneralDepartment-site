<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/UI/Breadcrumb.vue";
import { computed } from "vue";

const props = defineProps({
    post:        Object,
    recentPosts: Array,
    jsonLd:      Object,
});

const pageUrl = computed(() => usePage().url);
const canonicalUrl = computed(() => `${window.location.origin}/news/${props.post.slug}`);

// Social share helpers
function shareUrl(platform) {
    const url = encodeURIComponent(canonicalUrl.value);
    const title = encodeURIComponent(props.post.title);
    const map = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        twitter:  `https://twitter.com/intent/tweet?url=${url}&text=${title}`,
        telegram: `https://t.me/share/url?url=${url}&text=${title}`,
    };
    return map[platform];
}

function copyLink() {
    navigator.clipboard.writeText(canonicalUrl.value);
}
</script>

<template>
    <GovLayout>
        <Head :title="post.seo_title || post.title">
            <!-- SEO Meta -->
            <meta name="description" :content="post.seo_description" />
            <link rel="canonical" :href="canonicalUrl" />

            <!-- OpenGraph -->
            <meta property="og:type"        content="article" />
            <meta property="og:title"        :content="post.seo_title || post.title" />
            <meta property="og:description"  :content="post.seo_description" />
            <meta property="og:image"        :content="post.image" />
            <meta property="og:url"          :content="canonicalUrl" />
            <meta property="og:site_name"    content="Ministry of Information, Cambodia" />
            <meta property="article:published_time" :content="post.created_at_iso" />

            <!-- Twitter Card -->
            <meta name="twitter:card"        content="summary_large_image" />
            <meta name="twitter:title"       :content="post.seo_title || post.title" />
            <meta name="twitter:description" :content="post.seo_description" />
            <meta name="twitter:image"       :content="post.image" />

            <!-- Schema.org JSON-LD -->
            <component :is="'script'" type="application/ld+json">{{ JSON.stringify(jsonLd) }}</component>
        </Head>

        <div class="max-w-7xl mx-auto px-4 py-8 md:py-12">

            <!-- Breadcrumb -->
            <div class="mb-8" v-reveal>
                <Breadcrumb
                    :items="[
                        { label: 'Home', url: '/' },
                        { label: 'News', url: route('news.index') },
                        { label: post.title.length > 50 ? post.title.substring(0, 50) + '...' : post.title },
                    ]"
                />
            </div>

            <!-- Breaking badge (if applicable) -->
            <div v-if="post.is_breaking" class="mb-4 inline-flex items-center gap-2 bg-red-600 text-white text-xs font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-lg animate-pulse">
                🔴 Breaking News
            </div>

            <div class="flex flex-col lg:flex-row gap-12">

                <!-- Main Article -->
                <article class="lg:w-2/3 bg-base-100 text-base-content" v-reveal>

                    <!-- Hero Image with skeleton -->
                    <div class="w-full mb-8 rounded-2xl overflow-hidden bg-slate-200 animate-pulse relative">
                        <img
                            :src="post.image || 'https://placehold.co/1200x600/002B5B/FFFFFF?text=News+Update'"
                            @load="e => { e.target.classList.remove('opacity-0'); e.target.parentElement.classList.remove('animate-pulse') }"
                            @error="e => e.target.src = 'https://placehold.co/1200x600/002B5B/FFFFFF?text=News+Update'"
                            :alt="post.title"
                            class="w-full h-[300px] md:h-[450px] object-cover opacity-0 transition-opacity duration-700"
                        />
                    </div>

                    <!-- Article Meta -->
                    <div class="space-y-4 mb-8">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="badge badge-primary font-bold px-3 py-3 uppercase text-[10px] tracking-widest">
                                {{ post.category }}
                            </span>
                            <span class="text-sm text-slate-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                {{ post.created_at }}
                            </span>
                            <span v-if="post.read_time" class="text-sm text-slate-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ post.read_time }} min read
                            </span>
                            <span v-if="post.views_count" class="text-sm text-slate-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                {{ post.views_count.toLocaleString() }}
                            </span>
                        </div>

                        <h1 class="text-2xl md:text-3xl font-extrabold leading-snug text-slate-900">
                            {{ post.title }}
                        </h1>

                        <!-- Source credit -->
                        <p v-if="post.source_credit" class="text-sm text-slate-500 italic border-l-2 border-primary pl-3">
                            Source: {{ post.source_credit }}
                        </p>
                    </div>

                    <!-- Article Content -->
                    <div
                        class="prose prose-lg max-w-none prose-slate prose-img:rounded-xl prose-headings:text-slate-900 prose-a:text-primary"
                        v-html="post.content"
                    ></div>

                    <!-- Social Share Bar -->
                    <div class="mt-12 pt-8 border-t border-base-300">
                        <p class="text-sm font-bold text-slate-700 mb-4 uppercase tracking-widest">Share this article</p>
                        <div class="flex flex-wrap items-center gap-3">
                            <a :href="shareUrl('facebook')" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#1877F2] text-white text-sm font-bold hover:opacity-90 transition-opacity active:scale-95">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                            <a :href="shareUrl('twitter')" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-black text-white text-sm font-bold hover:opacity-90 transition-opacity active:scale-95">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                X / Twitter
                            </a>
                            <a :href="shareUrl('telegram')" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#26A5E4] text-white text-sm font-bold hover:opacity-90 transition-opacity active:scale-95">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                                Telegram
                            </a>
                            <button @click="copyLink"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-sm font-bold hover:bg-slate-200 transition active:scale-95">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                                Copy Link
                            </button>
                        </div>
                    </div>

                    <!-- Back to News -->
                    <div class="mt-8">
                        <Link
                            :href="route('news.index')"
                            class="inline-flex items-center gap-2 text-primary font-semibold hover:underline"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            {{ $t('news.back_to_news') }}
                        </Link>
                    </div>
                </article>

                <!-- Sidebar: Related Posts -->
                <aside class="lg:w-1/3">
                    <div class="sticky top-24 space-y-8" v-reveal>
                        <div>
                            <div class="flex items-center gap-2 mb-6 border-b border-slate-200 pb-3">
                                <div class="w-2 h-6 bg-secondary rounded-full"></div>
                                <h3 class="text-xl font-black text-slate-900">{{ $t('welcome.latest_news') }}</h3>
                            </div>

                            <div class="space-y-5">
                                <Link
                                    v-for="recent in recentPosts"
                                    :key="recent.id"
                                    :href="route('news.show', recent.slug)"
                                    class="group flex gap-4 items-start"
                                >
                                    <div class="shrink-0 w-20 h-20 rounded-xl overflow-hidden bg-slate-100 animate-pulse relative">
                                        <img
                                            :src="recent.image || 'https://placehold.co/200x200/002B5B/FFFFFF?text=News'"
                                            @load="e => { e.target.classList.remove('opacity-0'); e.target.parentElement.classList.remove('animate-pulse') }"
                                            class="absolute inset-0 w-full h-full object-cover opacity-0 group-hover:scale-110 transition-all duration-500"
                                            alt="Thumbnail"
                                        />
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <span class="text-[9px] font-black text-primary uppercase tracking-wider mb-1">{{ recent.category }}</span>
                                        <h4 class="text-sm font-bold text-slate-900 leading-snug line-clamp-3 group-hover:text-primary transition-colors">
                                            {{ recent.title }}
                                        </h4>
                                        <div class="flex items-center gap-2 mt-1.5">
                                            <span class="text-xs text-slate-400">{{ recent.created_at }}</span>
                                            <span v-if="recent.read_time" class="text-xs text-slate-400">· {{ recent.read_time }}min</span>
                                        </div>
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
