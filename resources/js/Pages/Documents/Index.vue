<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    documents: Array,
    filters: Object
});

const search = ref(props.filters.search);

// When search input changes, it hits the index method in DocumentController
watch(search, (value) => {
    router.get('/documents', { search: value }, {
        preserveState: true,
        replace: true
    });
});
</script>

<template>
    <GovLayout>
        <Head title="Document Library" />

        <div class="bg-slate-50 min-h-screen pb-20">
            <div class="bg-white border-b mb-8">
                <div class="max-w-7xl mx-auto px-4 py-12">
                    <h1 class="text-3xl font-bold text-slate-900 mb-4">{{ $t('nav.documents') }}</h1>
                    <div class="max-w-md relative">
                        <input
                            v-model="search"
                            type="text"
                            :placeholder="$t('welcome.view_all') + '...'"
                            class="input input-bordered w-full pl-10 focus:ring-primary"
                        />
                        <span class="absolute left-3 top-3 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <table class="table w-full">
                        <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="py-4">{{ $t('welcome.recent_docs') }}</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr v-for="doc in documents" :key="doc.id" class="hover:bg-blue-50/50 transition-colors group">
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center font-bold text-xs">PDF</div>
                                        <span class="font-semibold text-slate-800">{{ doc.title }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-outline text-slate-500">{{ doc.document_type }}</span>
                                </td>
                                <td class="text-sm text-slate-500">{{ doc.published_date }}</td>
                                <td class="text-right">
                                    <a
                                        v-if="doc.file_url"
                                        :href="doc.file_url"
                                        target="_blank"
                                        class="btn btn-primary btn-sm rounded-lg"
                                    >
                                        Download
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div v-if="documents.length === 0" class="p-20 text-center">
                        <p class="text-slate-400">No documents found matching your search.</p>
                    </div>
                </div>
            </div>
        </div>
    </GovLayout>
</template>
