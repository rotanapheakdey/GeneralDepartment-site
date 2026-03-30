<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

import MainHero from "@/Components/MainHero.vue";
import DirectorHero from "@/Components/DirectorHero.vue";
import LatestNews from "@/Components/LatestNews.vue";
import RecentDocuments from "@/Components/RecentDocuments.vue";

defineProps({
    canLogin: Boolean,
    latestPosts: Array,
    latestDocuments: Array,
});

const settings = computed(() => usePage().props.settings || {});
</script>

<template>
    <GovLayout>
        <Head :title="$t('nav.home') + ' - GDIB'" />

        <MainHero :settings="settings" />
        <DirectorHero :settings="settings" />

        <LatestNews :posts="latestPosts" />

        <div id="documents">
            <RecentDocuments :documents="latestDocuments" />
        </div>
    </GovLayout>
</template>
