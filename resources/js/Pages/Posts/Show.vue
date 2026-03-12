<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ post: Object });
</script>

<template>
    <AuthenticatedLayout>
        <Head :title="post.title" />

        <article class="max-w-4xl mx-auto bg-white shadow-2xl rounded-3xl overflow-hidden border border-slate-100">
            <img v-if="post.featured_image_url" :src="post.featured_image_url" class="w-full h-[400px] object-cover" />

            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 mb-6">
                    <span class="badge badge-primary badge-lg px-4 py-3 font-bold">{{ post.category }}</span>
                    <span class="text-slate-400 text-sm">{{ post.created_at }}</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-8 leading-tight">
                    {{ post.title }}
                </h1>

                <div class="prose prose-lg max-w-none text-slate-600 leading-relaxed">
                    {{ post.content }}
                </div>

                <div class="mt-12 pt-8 border-t border-slate-100">
                    <Link href="/posts" class="btn btn-outline btn-primary">
                        ← Back to News
                    </Link>
                </div>
            </div>
        </article>
    </AuthenticatedLayout>
</template>
