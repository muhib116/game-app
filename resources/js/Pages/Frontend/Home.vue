<template>
    <GlobalLayout>
        <div class="bg-slate-100 min-h-full">
            <nav class="w-full bg-white py-2 px-4">
                <div class="container mx-auto flex justify-between items-center">
                    <div>
                        <img src="/logo.jpg" alt="" class="h-[50px] w-auto object-contain block" />
                    </div>
                    <div class="flex gap-5">
                        <a href="#" class="py-1 px-5">Login</a>
                        <button class="bg-[var(--fave)] text-white py-2 px-10 rounded-md">Login</button>
                    </div>
                </div>
            </nav>
        </div>
    </GlobalLayout>
</template>

<script setup>
import GlobalLayout from '@/Components/GlobalLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

</script>

<style scoped>
/* frontend styles */
</style>