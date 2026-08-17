<script setup>
import GovLayout from "@/Layouts/GovLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

import MainHero from "@/Components/Sections/MainHero.vue";
import HeroSlider from "@/Components/Sections/HeroSlider.vue";
import LatestNews from "@/Components/Sections/LatestNews.vue";
import RecentDocuments from "@/Components/Sections/RecentDocuments.vue";

defineProps({
    canLogin: Boolean,
    latestPosts: Array,
    latestDocuments: Array,
    banners: Array,
});

const settings = computed(() => usePage().props.settings || {});
</script>

<template>
    <GovLayout>
        <Head :title="$t('nav.home') + ' - MoI'" />

        <div v-reveal>
            <MainHero :settings="settings" />
        </div>

        <div v-reveal class="bg-slate-50 py-12">
            <HeroSlider :banners="banners" />
        </div>

        <div v-reveal>
            <LatestNews :posts="latestPosts" />
        </div>

        <div id="documents" v-reveal>
            <RecentDocuments :documents="latestDocuments" />
        </div>
    </GovLayout>
</template>
