<template>
    <GovLayout>
        <Head :title="post.title" />

        <article
            class="max-w-4xl mx-auto px-4 py-8 md:py-12 bg-base-100 text-base-content"
        >
            <div class="mb-8">
                <Breadcrumb
                    :items="[
                        { label: 'Home', url: '/' },
                        { label: 'Activities', url: route('news.index') },
                        { label: post.title },
                    ]"
                />
            </div>

            <div v-if="post.image" class="w-full mb-8">
                <img
                    :src="post.image"
                    :alt="post.title"
                    class="w-full h-[300px] md:h-[450px] object-cover rounded-2xl shadow-md border border-base-200"
                />
            </div>

            <div class="space-y-4 mb-10">
                <div class="flex items-center gap-3">
                    <span
                        class="badge badge-primary font-bold px-3 py-3 uppercase text-[10px] tracking-widest"
                    >
                        {{ post.category }}
                    </span>
                    <span class="text-sm opacity-60">
                        {{ post.created_at }}
                    </span>
                </div>

                <h1
                    class="text-3xl md:text-5xl font-extrabold leading-tight text-slate-900"
                >
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
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"
                        />
                    </svg>
                    Back to all activities
                </Link>
            </div>
        </article>
    </GovLayout>
</template>

<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Breadcrumb.vue";

defineProps({
    post: Object,
});
</script>
