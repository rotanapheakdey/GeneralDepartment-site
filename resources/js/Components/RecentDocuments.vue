<script setup>
import { ref } from "vue";

defineProps({
    documents: {
        type: Array,
        required: true,
    }
});

// State for the PDF preview modal
const selectedDoc = ref(null);
</script>

<template>
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4">

            <div class="flex items-center gap-4 mb-10">
                <div class="p-3 bg-white rounded-2xl shadow-sm text-[#002B5B]">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                        />
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">
                    {{ $t("welcome.recent_docs") }}
                </h3>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="py-4 px-6">{{ $t("documents.title_column") || 'Document Title' }}</th>
                                <th class="px-6">{{ $t("documents.type_column") || 'Type' }}</th>
                                <th class="px-6">Date</th>
                                <th class="text-right px-6">Action</th>
                            </tr>
                        </thead>

                        <tbody v-if="documents && documents.length > 0" class="divide-y divide-slate-100">
                            <tr
                                v-for="doc in documents"
                                :key="doc.id"
                                class="hover:bg-blue-50/50 transition-colors group"
                            >
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center font-bold text-xs shrink-0">
                                            PDF
                                        </div>
                                        <span class="font-semibold text-slate-800 line-clamp-2">{{ doc.title }}</span>
                                    </div>
                                </td>
                                <td class="px-6">
                                    <span class="badge badge-outline text-slate-500 whitespace-nowrap">
                                        {{ doc.document_type || doc.type }}
                                    </span>
                                </td>
                                <td class="text-sm text-slate-500 px-6 whitespace-nowrap">
                                    {{ doc.published_date || doc.created_at }}
                                </td>
                                <td class="text-right px-6">
                                    <div class="flex justify-end gap-2">

                                        <button
                                            v-if="doc.file_url || doc.file_path"
                                            @click="selectedDoc = doc"
                                            class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium bg-base-200 hover:bg-base-300 text-primary rounded-lg transition-all duration-200 shrink-0"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span class="hidden sm:inline">Preview</span>
                                        </button>

                                        <a
                                            v-if="doc.file_url || doc.file_path"
                                            :href="doc.file_url || '/storage/' + doc.file_path"
                                            target="_blank"
                                            download
                                            class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium bg-primary hover:bg-primary/90 text-white rounded-lg shadow-sm transition-all duration-200 shrink-0"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5M12 15V3" />
                                            </svg>
                                            <span class="hidden sm:inline">Download</span>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="4" class="py-10 text-center text-slate-500">
                                    No recent documents available.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-center mt-6">
                <a :href="route('documents.index')" class="btn btn-outline border-slate-300 text-slate-600 hover:bg-slate-100 hover:border-slate-400 rounded-xl px-8">
                    View All Documents
                </a>
            </div>

        </div>
    </section>

    <Teleport to="body">
        <div
            v-if="selectedDoc"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/80 p-4 sm:p-6 backdrop-blur-sm"
        >
            <div class="bg-white w-full max-w-6xl h-[90vh] rounded-2xl shadow-2xl flex flex-col overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b border-slate-200 bg-slate-50">
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
                        :src="selectedDoc.file_url || '/storage/' + selectedDoc.file_path"
                        class="w-full h-full border-none"
                        title="Document Preview"
                    ></iframe>
                </div>
            </div>
        </div>
    </Teleport>
</template>
