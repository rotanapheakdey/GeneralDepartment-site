<script setup>
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    documents: Array,
});

// This helper cleans up the database names for the public
const formatType = (type) => {
    const labels = {
        prakas: "ប្រកាស (Prakas)",
        sub_decree: "អនុក្រឹត្យ (Sub-decree)",
        notification: "សេចក្តីជូនដំណឹង (Notification)",
    };
    return labels[type] || type;
};
</script>

<template>
    <Head title="GDIB Documents" />

    <nav class="bg-white border-b p-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="font-bold text-xl text-blue-900">GDIB PORTAL</div>
            <div class="space-x-4">
                <Link href="/" class="text-gray-600">Home</Link>
                <Link href="/documents" class="text-blue-600 font-bold"
                    >Documents</Link
                >
            </div>
        </div>
    </nav>

    <main class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6">Official Announcements</h1>

            <div class="bg-white shadow rounded-lg p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b text-gray-500 text-sm">
                            <th class="pb-3">TITLE</th>
                            <th class="pb-3">TYPE</th>
                            <th class="pb-3 text-right">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="doc in documents"
                            :key="doc.id"
                            class="border-b last:border-0"
                        >
                            <td class="py-4 font-medium">{{ doc.title }}</td>
                            <td class="py-4">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 uppercase"
                                >
                                    {{ doc.document_type }}
                                </span>
                            </td>
                            <td class="py-4 text-right">
                                <a
                                    :href="'/storage/' + doc.file_path"
                                    target="_blank"
                                    class="text-blue-600 hover:underline"
                                    >Download PDF</a
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</template>
