<template>
    <GlobalLayout>
        <Navigation />
        <Banner />
        <Section1 />
        <Section2 />
        <Section3 />
        <Section4 />
        <Section5 />
        <FormSection />
        <Footer />
    </GlobalLayout>
</template>

<script setup>
import GlobalLayout from '@/Components/GlobalLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import Navigation from './fragment/Navigation.vue';
import Banner from './fragment/Banner.vue';
import Section1 from './fragment/Section1.vue';
import Section2 from './fragment/Section2.vue';
import Section3 from './fragment/Section3.vue';
import Section4 from './fragment/Section4.vue';
import Section5 from './fragment/Section5.vue';
import FormSection from './fragment/FormSection.vue';
import Footer from './fragment/Footer.vue';

</script>

<style scoped>
/* frontend styles */
</style>