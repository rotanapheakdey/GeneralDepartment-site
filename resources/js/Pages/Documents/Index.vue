<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    documents: Array,
    filters: Object, // We will send this from the controller
});

const search = ref(props.filters?.search || "");

// This "watches" the search box and reloads the data when you type
watch(search, (value) => {
    router.get(
        "/documents",
        { search: value },
        {
            preserveState: true,
            replace: true,
        },
    );
});
</script>

<template>
    <Head title="GDIB | Document Repository" />

    <div class="min-h-screen bg-base-200" data-theme="corporate">
        <div class="navbar bg-base-100 shadow-lg px-8">
            <div class="flex-1">
                <a class="text-xl font-bold text-primary">GDIB PORTAL</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li><Link href="/">Home</Link></li>
                    <li>
                        <Link href="/documents" class="active">Documents</Link>
                    </li>
                </ul>
            </div>
        </div>

        <main class="max-w-7xl mx-auto py-10 px-4">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-extrabold italic text-secondary">
                    OFFICIAL DOCUMENTS
                </h1>

                <div class="form-control">
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Search by title..."
                        class="input input-bordered w-full max-w-xs shadow-sm focus:input-primary"
                    />
                </div>
            </div>

            <div class="overflow-x-auto bg-base-100 rounded-box shadow-xl">
                <table class="table table-zebra w-full">
                    <thead>
                        <tr class="bg-primary text-primary-content">
                            <th>Title</th>
                            <th>Category</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="doc in documents"
                            :key="doc.id"
                            class="hover"
                        >
                            <td class="font-bold">{{ doc.title }}</td>
                            <td>
                                <div
                                    class="badge badge-outline badge-primary uppercase"
                                >
                                    {{ doc.document_type }}
                                </div>
                            </td>
                            <td class="text-right">
                                <a
                                    :href="'/storage/' + doc.file_path"
                                    target="_blank"
                                    class="btn btn-sm btn-secondary btn-outline"
                                >
                                    View PDF
                                </a>
                            </td>
                        </tr>
                        <tr v-if="documents.length === 0">
                            <td
                                colspan="3"
                                class="text-center py-10 text-gray-400"
                            >
                                No documents found matching your search.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</template>
