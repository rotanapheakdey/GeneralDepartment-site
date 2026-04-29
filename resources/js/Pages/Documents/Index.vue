<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, watch, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import Pagination from "@/Components/Pagination.vue";

const { locale, t } = useI18n({ useScope: "global" });

const props = defineProps({
    documents: Object,
    filters: Object,
    types: Array,
});

const search = ref(props.filters?.search || "");
const selectedType = ref(props.filters?.type || "");
let searchTimeout;

// Preview State Variables
const selectedDoc = ref(null);
const blobPreviewUrl = ref(null);
const isPreviewLoading = ref(false);

watch([search, selectedType], ([newSearch, newType]) => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        router.get(
            "/documents",
            { search: newSearch, type: newType },
            { preserveState: true, replace: true },
        );
    }, 300);
});

onMounted(() => {
    const savedLocale = localStorage.getItem("locale");
    if (savedLocale) locale.value = savedLocale;
});

// --- THE MAGIC IDM BYPASS FUNCTION ---
const openPreview = async (doc) => {
    selectedDoc.value = doc;
    blobPreviewUrl.value = null;
    isPreviewLoading.value = true;

    try {
        // Fetch the file in the background (Download managers ignore this!)
        const response = await fetch(doc.file_url);
        const blob = await response.blob();

        // Convert it to a safe, temporary browser-memory URL
        blobPreviewUrl.value = URL.createObjectURL(blob);
    } catch (error) {
        console.error("Error loading PDF preview:", error);
    } finally {
        isPreviewLoading.value = false;
    }
};

const closePreview = () => {
    selectedDoc.value = null;
    // Clean up the memory when the modal closes
    if (blobPreviewUrl.value) {
        URL.revokeObjectURL(blobPreviewUrl.value);
        blobPreviewUrl.value = null;
    }
};
</script>

<template>
    <GovLayout>
        <Head :title="t('nav.documents')" />

        <div class="bg-slate-50 min-h-screen pb-20">
            <!-- Header -->
            <div class="bg-white border-b mb-8">
                <div class="max-w-7xl mx-auto px-4 py-12">
                    <h1 class="text-3xl font-bold text-slate-900 mb-4">
                        {{ t("nav.documents") }}
                    </h1>
                    <div class="flex flex-col sm:flex-row gap-4 max-w-2xl">
                        <div class="relative flex-1">
                            <input
                                v-model="search"
                                type="text"
                                :placeholder="t('welcome.view_all') + '...'"
                                class="w-full pl-9 pr-3 py-2 text-sm bg-base-100 border border-base-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200"
                            />
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                                </svg>
                            </span>
                        </div>
                        <div class="relative w-full sm:w-48">
                            <select
                                v-model="selectedType"
                                class="w-full px-3 py-2 text-sm bg-base-100 border border-base-300 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200"
                            >
                                <option value="">
                                    {{ t("welcome.view_all") }}
                                </option>
                                <option
                                    v-for="type in types"
                                    :key="type"
                                    :value="type"
                                >
                                    {{ t("documents.types." + type) }}
                                </option>
                            </select>
                            <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-base-content/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="max-w-7xl mx-auto px-4">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
                    <table class="table w-full">
                        <thead class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="py-4 pl-6">
                                    {{ t("documents.title_column") }}
                                </th>
                                <th>{{ t("documents.type_column") }}</th>
                                <th>{{ t("documents.date_column") }}</th>
                                <th class="text-right pr-6">Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="documents.data.length > 0" class="divide-y divide-slate-100">
                            <tr
                                v-for="doc in documents.data"
                                :key="doc.id"
                                class="hover:bg-blue-50/50 transition-colors group"
                            >
                                <!-- Title with PDF Badge -->
                                <td class="py-5 pl-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center font-bold text-xs">
                                            PDF
                                        </div>
                                        <span class="font-semibold text-slate-800">{{ doc.title }}</span>
                                    </div>
                                </td>
                                <!-- Document Type -->
                                <td>
                                    <span class="badge badge-outline text-slate-500">
                                        {{ t("documents.types." + doc.document_type) }}
                                    </span>
                                </td>
                                <!-- Date -->
                                <td class="text-sm text-slate-500">
                                    {{ doc.published_date }}
                                </td>
                                <!-- Styled Action Buttons -->
                                <td class="pr-6 align-middle">
                                    <div class="flex items-center justify-end gap-2">
                                        <button
                                            v-if="doc.file_url"
                                            @click="openPreview(doc)"
                                            class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium bg-base-200 hover:bg-base-300 text-primary rounded-lg transition-all duration-200"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5M12 15V3" />
                                            </svg>
                                            {{ t("documents.download") }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Empty State -->
                    <div v-if="documents.data.length === 0" class="p-20 text-center border-t border-slate-100">
                        <p class="text-slate-400">
                            No documents found matching your search.
                        </p>
                    </div>
                </div>
                <Pagination :links="documents.links" />
            </div>
        </div>
    </GovLayout>

    <!-- Document Preview Modal -->
    <div
        v-if="selectedDoc"
        class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/80 backdrop-blur-sm p-4"
    >
        <div class="bg-white w-full max-w-6xl h-[90vh] rounded-2xl shadow-2xl flex flex-col overflow-hidden">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b bg-slate-50">
                <h3 class="font-bold text-lg text-slate-800 truncate pr-4">
                    {{ selectedDoc.title }}
                </h3>
                <!-- Call closePreview to clear the memory -->
                <button
                    @click="closePreview"
                    class="btn btn-sm btn-circle btn-ghost text-xl"
                >
                    ✕
                </button>
            </div>

            <!-- PDF Viewer Body -->
            <div class="flex-1 bg-slate-200 relative w-full h-full flex flex-col items-center justify-center">
                <!-- Show a loader while Javascript fetches the file -->
                <div
                    v-if="isPreviewLoading"
                    class="text-slate-500 flex flex-col items-center"
                >
                    <span class="loading loading-spinner loading-lg mb-4"></span>
                    <p class="font-medium">Loading secure preview...</p>
                </div>

                <!-- The safe memory URL completely bypasses IDM -->
                <iframe
                    v-else-if="blobPreviewUrl"
                    :src="blobPreviewUrl"
                    class="w-full h-full border-none"
                    title="Document Preview"
                ></iframe>
            </div>
        </div>
    </div>
</template>
