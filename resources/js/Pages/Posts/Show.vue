<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    post: Object,
});
</script>

<template>
    <GovLayout>
        <Head :title="post.title" />

        <article class="bg-white min-h-screen">
            <div class="bg-slate-900 text-white py-16">
                <div class="max-w-4xl mx-auto px-4">
                    <Link href="/posts" class="text-blue-400 text-sm hover:underline mb-6 inline-block">← Back to News</Link>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="badge badge-primary">{{ post.category }}</span>
                        <span class="text-slate-400 text-sm">{{ post.created_at }}</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold leading-tight">{{ post.title }}</h1>
                </div>
            </div>

            <div class="max-w-4xl mx-auto px-4 -mt-8">
                <div v-if="post.featured_image_url" class="rounded-2xl shadow-2xl overflow-hidden mb-12 border-4 border-white">
                    <img :src="post.featured_image_url" :alt="post.title" class="w-full h-auto object-cover max-h-[500px]" />
                </div>

                <div
                    class="prose prose-lg max-w-none prose-slate prose-headings:text-[#002B5B] pb-20"
                    v-html="post.content"
                ></div>
            </div>
        </article>
    </GovLayout>
</template>
