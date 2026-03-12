<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    posts: Array,
    filters: Object,
});

const search = ref(props.filters.search);

watch(search, (value) => {
    router.get(
        "/posts",
        { search: value },
        { preserveState: true, replace: true },
    );
});
</script>

<template>
    <GovLayout>
        <Head title="News & Updates" />

        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 py-12">
                <h1 class="text-4xl font-bold text-slate-900 mb-4">
                    News & Updates
                </h1>
                <p class="text-slate-600 max-w-2xl">
                    Stay informed with the latest official announcements and
                    activities from the General Department.
                </p>

                <div class="mt-8 max-w-md">
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search articles..."
                        class="input input-bordered w-full focus:ring-primary"
                    />
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-12">
            <div
                v-if="posts.length > 0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
            >
                <div
                    v-for="post in posts"
                    :key="post.id"
                    class="card bg-white border border-slate-200 hover:shadow-lg transition"
                >
                    <figure
                        class="h-48 w-full bg-slate-200 overflow-hidden relative"
                    >
                        <img
                            v-if="post.featured_image_url"
                            :src="post.featured_image_url"
                            :alt="post.title"
                            class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500"
                        />

                        <div
                            v-else
                            class="flex items-center justify-center h-full w-full text-slate-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-12 w-12"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                        </div>
                    </figure>
                    <div class="card-body p-6">
                        <span
                            class="text-xs font-bold text-primary uppercase mb-2"
                            >{{ post.category }}</span
                        >
                        <h2
                            class="card-title text-slate-900 line-clamp-2 leading-snug mb-3"
                        >
                            {{ post.title }}
                        </h2>
                        <p class="text-slate-600 text-sm line-clamp-3 mb-4">
                            {{ post.content_excerpt }}
                        </p>
                        <div
                            class="card-actions justify-between items-center mt-auto pt-4 border-t border-slate-50"
                        >
                            <span class="text-xs text-slate-400 font-medium">{{
                                post.created_at
                            }}</span>
                            <Link
                                :href="route('posts.show', post.id)"
                                class="btn btn-primary btn-sm btn-outline"
                                >Read More</Link
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="py-20 text-center">
                <p class="text-slate-400">No news articles found.</p>
            </div>
        </div>
    </GovLayout>
</template>
