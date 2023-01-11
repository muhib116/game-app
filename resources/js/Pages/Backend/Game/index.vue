<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Games</p>
            <Link :href="route('game.create')" className='bg-black text-white px-4 py-1 rounded'>+ Start Creating Game</Link>
        </div>
    </Master>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3'
    import Master from '../Master.vue'
    
</script>