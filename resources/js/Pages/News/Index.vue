<template>
    <GovLayout>
        <Head :title="$t('news.recent_activities') + ' - MoI'" />

        <div class="max-w-7xl mx-auto px-4 py-12 bg-base-100 text-base-content overflow-hidden">

            <!-- Page Header -->
            <div v-reveal class="mb-10 border-b-2 border-base-300 pb-6">
                <h1 class="text-4xl font-extrabold text-base-content uppercase tracking-tight">
                    {{ $t('news.recent_activities') }}
                </h1>
                <p class="text-base-content opacity-70 mt-2">
                    {{ $t('news.latest_announcements') }}
                </p>
            </div>

            <!-- Search & Filter Bar -->
            <div v-reveal class="flex flex-col sm:flex-row gap-3 mb-8">
                <div class="relative flex-1">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input
                        v-model="searchQuery"
                        @keyup.enter="applyFilters"
                        type="text"
                        placeholder="Search news..."
                        class="w-full pl-10 pr-4 py-2.5 border border-base-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition bg-white"
                    />
                </div>

                <select
                    v-model="selectedCategory"
                    @change="applyFilters"
                    class="border border-base-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition bg-white min-w-[180px]"
                >
                    <option value="">All Categories</option>
                    <option v-for="cat in categories" :key="cat.id" :value="cat.slug">
                        {{ cat.name }}
                    </option>
                </select>

                <button
                    @click="applyFilters"
                    class="btn btn-primary rounded-xl px-6 text-white active:scale-95 transition-transform"
                >
                    Search
                </button>

                <button
                    v-if="hasActiveFilters"
                    @click="clearFilters"
                    class="btn btn-ghost rounded-xl px-4 text-sm text-slate-500 hover:text-red-500"
                >
                    ✕ Clear
                </button>
            </div>

            <!-- Active filter tags -->
            <div v-if="hasActiveFilters" class="flex flex-wrap gap-2 mb-6">
                <span v-if="filters.search" class="inline-flex items-center gap-1 bg-primary/10 text-primary text-xs font-bold px-3 py-1 rounded-full">
                    Search: "{{ filters.search }}"
                </span>
                <span v-if="filters.category" class="inline-flex items-center gap-1 bg-secondary/10 text-secondary text-xs font-bold px-3 py-1 rounded-full">
                    Category: {{ activeCategoryName }}
                </span>
            </div>

            <!-- News Grid -->
            <div v-if="posts.data && posts.data.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="(post, index) in posts.data"
                    :key="post.id"
                    v-reveal
                    :style="`transition-delay: ${(index % 3) * 60}ms`"
                    class="group flex flex-col h-full bg-white border border-base-300 rounded-2xl hover:-translate-y-2 transition-all duration-500 ease-out shadow-sm hover:shadow-2xl"
                >
                    <!-- Image with skeleton -->
                    <div class="relative h-48 w-full overflow-hidden rounded-t-2xl bg-slate-200 animate-pulse">
                        <!-- Breaking Badge -->
                        <span v-if="post.is_breaking" class="absolute top-3 left-3 z-10 bg-red-600 text-white text-[9px] font-black uppercase tracking-widest px-2.5 py-1 rounded-full shadow-lg animate-pulse">
                            🔴 Breaking
                        </span>

                        <img
                            :src="post.image || 'https://placehold.co/600x400/002B5B/FFFFFF?text=News'"
                            @load="e => { e.target.classList.remove('opacity-0'); e.target.parentElement.classList.remove('animate-pulse') }"
                            class="absolute inset-0 w-full h-full object-cover transition-all duration-700 opacity-0 group-hover:scale-110"
                            :alt="post.title"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-[10px] font-black tracking-wider uppercase text-primary bg-primary/10 px-2.5 py-1 rounded-full">
                                {{ post.category?.name || 'General' }}
                            </span>
                            <span v-if="post.read_time" class="text-[10px] text-slate-400 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ post.read_time }} min
                            </span>
                        </div>

                        <h2 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors duration-300 leading-snug line-clamp-3 mb-2">
                            {{ post.title }}
                        </h2>

                        <p class="text-slate-500 line-clamp-2 text-sm leading-relaxed mb-4">
                            {{ post.excerpt }}
                        </p>

                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-xs text-slate-400">{{ post.created_at }}</span>
                            <Link
                                :href="route('news.show', post.slug || post.id)"
                                class="inline-flex items-center gap-1 text-sm font-bold text-secondary hover:text-primary transition-colors"
                            >
                                {{ $t('news.read_article') }}
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="flex flex-col items-center justify-center py-24 text-center">
                <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-bold text-slate-700 mb-1">No articles found</h3>
                <p class="text-slate-400 text-sm mb-4">Try adjusting your search or filter criteria.</p>
                <button @click="clearFilters" class="btn btn-outline btn-sm rounded-xl">Clear Filters</button>
            </div>

            <!-- Pagination -->
            <div v-reveal class="mt-12 mb-6">
                <Pagination :links="posts.links" />
            </div>

        </div>
    </GovLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import GovLayout from '@/Layouts/GovLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/UI/Pagination.vue';

const props = defineProps({
    posts:      Object,
    categories: Array,
    filters:    Object,
});

// Local reactive state for search form
const searchQuery      = ref(props.filters?.search || '');
const selectedCategory = ref(props.filters?.category || '');

const hasActiveFilters = computed(() => !!(props.filters?.search || props.filters?.category));

const activeCategoryName = computed(() => {
    if (!props.filters?.category) return '';
    return props.categories?.find(c => c.slug === props.filters.category)?.name || props.filters.category;
});

function applyFilters() {
    router.get(route('news.index'), {
        search:   searchQuery.value || undefined,
        category: selectedCategory.value || undefined,
    }, { preserveState: true, replace: true });
}

function clearFilters() {
    searchQuery.value      = '';
    selectedCategory.value = '';
    router.get(route('news.index'), {}, { replace: true });
}
</script>
