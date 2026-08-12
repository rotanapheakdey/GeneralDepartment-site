<template>
    <div v-if="links && links.length > 3" class="flex justify-center gap-2 flex-wrap">
        <template v-for="(link, index) in links" :key="index">
            <Link
                v-if="link.url"
                :href="link.url"
                class="btn btn-sm text-white"
                :class="link.active ? 'btn-primary' : 'btn-outline border-base-300' "
                v-html="link.label"
            ></Link>
            <span
                v-else
                class="btn btn-sm btn-disabled"
                v-html="link.label"
            ></span>
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: Array,
});
</script>
