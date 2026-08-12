<script setup>
import Navbar from "@/Components/Sections/Navbar.vue";
import Footer from "@/Components/Sections/Footer.vue";

</script>

<template>
    <div class="min-h-screen bg-white text-slate-900">
        <Navbar />

        <main class="min-h-screen bg-base-100 text-base-content">
            <slot />
        </main>

        <Footer />
    </div>
</template>
