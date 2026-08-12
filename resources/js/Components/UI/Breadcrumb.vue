<template>
    <nav class="text-xs flex items-center gap-2 text-slate-400 uppercase tracking-widest font-bold w-full overflow-hidden">
        <template v-for="(item, index) in items" :key="index">
            <Link
                v-if="item.url"
                :href="item.url"
                class="hover:text-primary transition shrink-0"
            >
                {{ item.label }}
            </Link>

            <span
                v-else
                class="text-slate-900 truncate"
            >
                {{ item.label }}
            </span>

            <span v-if="index < items.length - 1" class="opacity-50 shrink-0">/</span>
        </template>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    items: {
        type: Array,
        required: true,
        // Example format: [{ label: 'Home', url: '/' }, { label: 'News' }]
    }
});
</script>
