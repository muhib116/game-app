<template>
    <nav class="py-2 px-4 border-b">
        <div class="container mx-auto flex items-center justify-between">
            <Link :href="route('home')">
                <img class="h-[65px]" src="../img/logo.png" alt="">
            </Link>
            <div class="flex items-center gap-5">
                <Link :href="route('login')" class="relative px-3 hover:text-fave-500 py-2 font-semibold">
                    {{ translate('LOG IN', 'en') }}
                </Link>
                <Link :href="route('register')" class="font-semibold bg-fave-400 text-white px-4 py-2.5 rounded hover:bg-fave-300 duration-200">
                    {{ translate('Register', 'en') }}
                </Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import {translate} from '@/useLanguage';



</script>