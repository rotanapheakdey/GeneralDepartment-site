<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ posts: Array });
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Latest News" />
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div v-for="post in posts" :key="post.id" class="card bg-white shadow-xl hover:shadow-2xl transition-all group">
                    <figure class="h-48">
                        <img :src="post.featured_image_url || 'https://placehold.co/600x400?text=No+Image'" class="object-cover w-full h-full group-hover:scale-105 transition-transform" />
                    </figure>
                    <div class="card-body">
                        <div class="badge badge-secondary badge-outline">{{ post.category?.name }}</div>
                        <h2 class="card-title text-slate-800">{{ post.title }}</h2>
                        <p class="text-slate-500 text-sm line-clamp-2">{{ post.content_excerpt }}</p>
                        <div class="card-actions justify-end mt-4">
                            <Link :href="`/posts/${post.id}`" class="btn btn-primary btn-sm text-white">Read More</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
