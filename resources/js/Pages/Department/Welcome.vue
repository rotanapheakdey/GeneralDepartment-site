<script setup>
import GovLayout from "@/Layouts/GovLayout.vue"; // Using the Layout we fixed
import { Head, Link } from "@inertiajs/vue3";

// These match the data we just set up in web.php
defineProps({
    canLogin: Boolean,
    latestPosts: Array,
    latestDocuments: Array,
});
</script>

<template>
    <GovLayout>
        <Head title="Welcome to GDIB" />

        <section class="py-16 bg-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row"
                >
                    <div
                        class="md:w-1/3 bg-[#002B5B] flex items-center justify-center p-12"
                    >
                        <div
                            class="aspect-[3/4] w-full bg-slate-200 rounded-lg shadow-inner flex items-center justify-center text-slate-400 italic"
                        >
                            [ Director Photo ]
                        </div>
                    </div>

                    <div class="md:w-2/3 p-12 flex flex-col justify-center">
                        <h2
                            class="text-3xl font-bold text-slate-900 mb-6 border-b-2 border-[#D4AF37] pb-4"
                        >
                            Director's Welcome
                        </h2>
                        <p
                            class="text-lg text-slate-700 leading-relaxed mb-6 italic"
                        >
                            "Our mission at the Department of Digital Content is
                            to ensure that every citizen has access to accurate,
                            timely, and secure information."
                        </p>
                        <div>
                            <p class="font-bold text-xl text-[#002B5B]">
                                Rotana Pheakdey
                            </p>
                            <p
                                class="text-[10px] text-slate-500 uppercase tracking-widest leading-tight mt-1"
                            >
                                Director of Digital Content <br />
                                <span class="text-[#D4AF37]"
                                    >General Department of Information and
                                    Broadcasting</span
                                >
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold">
                    {{ $t("welcome.latest_news") }}
                </h3>
                <Link href="/posts" class="btn btn-ghost btn-sm"
                    >View All →</Link
                >
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    v-for="post in latestPosts"
                    :key="post.id"
                    class="card bg-white shadow-sm border border-slate-200"
                >
                    <figure v-if="post.featured_image">
                        <img
                            :src="post.featured_image"
                            class="h-48 w-full object-cover"
                        />
                    </figure>
                    <div class="card-body p-4">
                        <span
                            class="text-xs font-bold text-blue-600 uppercase"
                            >{{ post.category }}</span
                        >
                        <h2 class="card-title text-md">{{ post.title }}</h2>
                        <Link
                            :href="route('news.show', post.id)"
                            class="text-primary text-sm font-bold mt-2"
                        >
                            Read More
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <h3 class="text-2xl font-bold mb-6">Recent Documents</h3>
                <div class="overflow-x-auto border rounded-xl">
                    <table class="table w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th>Document Title</th>
                                <th>Type</th>
                                <th class="text-right">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="doc in latestDocuments" :key="doc.id">
                                <td class="font-medium">{{ doc.title }}</td>
                                <td>
                                    <span class="badge badge-outline">{{
                                        doc.document_type
                                    }}</span>
                                </td>
                                <td class="text-right">
                                    <a
                                        :href="'/storage/' + doc.file_path"
                                        target="_blank"
                                        class="btn btn-xs btn-primary"
                                        >PDF</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </GovLayout>
</template>
