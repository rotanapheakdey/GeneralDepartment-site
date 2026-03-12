<template>
    <GovLayout>
        <Head title="Department Activities" />

        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="mb-12 border-b-2 border-slate-200 pb-6">
                <h1
                    class="text-4xl font-extrabold text-slate-900 uppercase tracking-tight"
                >
                    Recent Activities
                </h1>
                <p class="text-slate-500 mt-2">
                    Latest news and announcements from the General Department of
                    Information and Broadcasting.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="post in posts"
                    :key="post.id"
                    class="group flex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-700"
                >
                    <div
                        class="aspect-w-16 aspect-h-9 overflow-hidden rounded-t-xl"
                    >
                        <img
                            v-if="post?.image"
                            :src="post.image"
                            class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105"
                            alt="Activity Image"
                        />
                        <div
                            v-else
                            class="w-full h-48 bg-gray-100 flex items-center justify-center text-slate-400"
                        >
                            <span
                                class="text-xs font-bold uppercase tracking-widest"
                                >No Media</span
                            >
                        </div>
                    </div>

                    <div class="p-4 md:p-6 flex-1 flex flex-col">
                        <span
                            class="block mb-1 text-xs font-semibold uppercase text-blue-600 dark:text-blue-500"
                        >
                            {{ post.category?.name || "General News" }}
                        </span>

                        <h3
                            class="text-xl font-bold text-gray-800 dark:text-gray-300 group-hover:text-blue-600 transition"
                        >
                            {{ post.title }}
                        </h3>

                        <p class="mt-3 text-gray-500 line-clamp-3 text-sm">
                            {{ post.excerpt }}
                        </p>

                        <div class="mt-auto pt-6">
                            <Link
                                :href="route('news.show', { post: post.id })"
                                class="w-full py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700"
                            >
                                View Details
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GovLayout>
</template>

<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    posts: Array,
});
</script>
