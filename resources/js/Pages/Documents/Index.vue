<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { debounce } from "lodash";

const props = defineProps({
    documents: Array,
    filters: Object,
});

const search = ref(props.filters?.search || "");

// Request new data when searching
watch(search, debounce((value) => {
    router.get('/documents', { search: value }, { preserveState: true, replace: true });
}, 300));

// Helper to make the Type look nice
const formatType = (type) => {
    const types = {
        'prakas': 'ប្រកាស (Prakas)',
        'sub_decree': 'អនុក្រឹត្យ (Sub-decree)',
        'notification': 'សេចក្តីជូនដំណឹង (Notification)'
    };
    return types[type] || type;
};
</script>

<template>
    <Head title="ឯកសារសាធារណៈ" />

    <div class="min-h-screen bg-slate-50 py-12 px-4" data-theme="corporate">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h1 class="text-4xl font-black text-slate-900 mb-2">បណ្ណាល័យឯកសារ</h1>
                    <p class="text-slate-500">ស្វែងរក និងទាញយកឯកសារផ្លូវការ (Official Documents)</p>
                </div>

                <div class="form-control">
                    <input v-model="search" type="text" placeholder="ស្វែងរកចំណងជើង..." class="input input-bordered w-72 shadow-sm p-4" />
                </div>
            </div>

            <div class="card bg-white shadow-xl border border-slate-200">
                <table class="table w-full">
                    <thead class="bg-slate-50">
                        <tr class="text-slate-600">
                            <th>ចំណងជើង (Title)</th>
                            <th>ប្រភេទ (Type)</th>
                            <th>កាលបរិច្ឆេទ (Date)</th>
                            <th class="text-right">ទាញយក (Download)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="doc in documents" :key="doc.id" class="hover:bg-slate-50">
                            <td class="font-bold text-slate-800">{{ doc.title }}</td>
                            <td><span class="badge badge-outline">{{ formatType(doc.document_type) }}</span></td>
                            <td class="text-slate-500">{{ doc.published_date }}</td>
                            <td class="text-right">sa
                                <a :href="doc.file_url" target="_blank" class="btn btn-primary btn-sm">
                                    PDF
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
