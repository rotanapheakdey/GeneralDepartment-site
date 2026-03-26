<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    documents: Object,
    filters: Object,
    types: Array,
});

const search = ref(props.filters?.search || "");
const selectedType = ref(props.filters?.type || ""); // Tracks the dropdown
let searchTimeout;
const selectedDoc = ref(null);

// FIXED: Now we watch BOTH the search string and the dropdown selection
watch([search, selectedType], ([newSearch, newType]) => {
    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {
        router.get(
            "/documents",
            {
                search: newSearch,
                type: newType,
            },
            {
                preserveState: true,
                replace: true,
            },
        );
    }, 300);
});
</script>

<template>
    <GovLayout>
        <Head title="Document Library" />

        <div class="bg-slate-50 min-h-screen pb-20">
            <div class="bg-white border-b mb-8">
                <div class="max-w-7xl mx-auto px-4 py-12">
                    <h1 class="text-3xl font-bold text-slate-900 mb-4">
                        {{ $t("nav.documents") }}
                    </h1>
                    <div class="flex flex-col sm:flex-row gap-4 max-w-2xl">
                        <div class="relative flex-1">
                            <input
                                v-model="search"
                                type="text"
                                :placeholder="$t('welcome.view_all') + '...'"
                                class="w-full pl-9 pr-3 py-2 text-sm bg-base-100 border border-base-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200"
                            />
                            <span
                                class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"
                                    />
                                </svg>
                            </span>
                        </div>

                        <div class="relative w-full sm:w-48">
                            <select
                                v-model="selectedType"
                                class="w-full px-3 py-2 text-sm bg-base-100 border border-base-300 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200"
                            >
                                <option value="">All Document Types</option>
                                <option
                                    v-for="type in types"
                                    :key="type"
                                    :value="type"
                                >
                                    {{ type }}
                                </option>
                            </select>

                            <!-- Custom Arrow -->
                            <span
                                class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-base-content/50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"
                                    />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8"
                >
                    <table class="table w-full">
                        <thead
                            class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider"
                        >
                            <tr>
                                <th class="py-4">Document Title</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody
                            v-if="documents.data.length > 0"
                            class="divide-y divide-slate-100"
                        >
                            <tr
                                v-for="doc in documents.data"
                                :key="doc.id"
                                class="hover:bg-blue-50/50 transition-colors group"
                            >
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center font-bold text-xs"
                                        >
                                            PDF
                                        </div>
                                        <span
                                            class="font-semibold text-slate-800"
                                            >{{ doc.title }}</span
                                        >
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge badge-outline text-slate-500"
                                        >{{ doc.document_type }}</span
                                    >
                                </td>
                                <td class="text-sm text-slate-500">
                                    {{ doc.published_date }}
                                </td>
                                <td class="text-right flex justify-end gap-2">
                                    <div class="flex items-center gap-2">
                                        <button
                                            v-if="doc.file_url"
                                            @click="selectedDoc = doc"
                                            class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium bg-base-200 hover:bg-base-300 text-primary rounded-lg transition-all duration-200"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                />
                                            </svg>
                                            Preview
                                        </button>

                                        <a
                                            v-if="doc.file_url"
                                            :href="doc.file_url"
                                            target="_blank"
                                            download
                                            class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium bg-primary hover:bg-primary/90 text-white rounded-lg shadow-sm transition-all duration-200"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 10l5 5 5-5M12 15V3"
                                                />
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div
                        v-if="documents.data.length === 0"
                        class="p-20 text-center border-t border-slate-100"
                    >
                        <p class="text-slate-400">
                            No documents found matching your search.
                        </p>
                    </div>
                </div>

                <Pagination :links="documents.links" />
            </div>
        </div>
    </GovLayout>

    <div
        v-if="selectedDoc"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/80 p-4 sm:p-6 backdrop-blur-sm"
    >
        <div
            class="bg-white w-full max-w-6xl h-[90vh] rounded-2xl shadow-2xl flex flex-col overflow-hidden"
        >
            <div
                class="flex justify-between items-center p-4 border-b border-slate-200 bg-slate-50"
            >
                <h3 class="font-bold text-lg text-slate-800 truncate pr-4">
                    {{ selectedDoc.title }}
                </h3>
                <button
                    @click="selectedDoc = null"
                    class="btn btn-sm btn-circle btn-ghost"
                >
                    ✕
                </button>
            </div>

            <div class="flex-1 w-full h-full bg-slate-200">
                <iframe
                    :src="selectedDoc.file_url"
                    class="w-full h-full border-none"
                    title="Document Preview"
                ></iframe>
            </div>
        </div>
    </div>
</template>
