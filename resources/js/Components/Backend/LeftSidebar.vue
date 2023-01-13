<template>
    <aside class='h-[100vh] py-4 border-r text-gray-500 bg-white sticky top-14'>
        <Link 
            :href="route('dashboard')"
            class="flex gap-2 items-center py-1 px-4 hover:text-black"
            :class="component == 'Backend/Dashboard' && 'text-black'"
        >
            <i class="w-5 fa fa-pie-chart" aria-hidden="true"></i>
            Dashboard
        </Link>
        <Link 
            :href="route('game')"
            class="flex gap-2 items-center py-1 px-4 hover:text-black"
            :class="component == 'Backend/Game' && 'text-black'"
        >
            <i class="w-5 fa fa-gamepad" aria-hidden="true"></i>
            Games
        </Link>
        <a href="#" class='flex gap-2 items-center py-1 px-4 hover:text-black'>
            
        </a>
        <a href="#" class='flex gap-2 items-center py-1 px-4 hover:text-black'>
            <i class="w-5 fa fa-folder-open" aria-hidden="true"></i>
            Files
        </a>
        <a href="#" class='flex gap-2 items-center py-1 px-4 hover:text-black'>
            <i class="w-5 fa fa-lock" aria-hidden="true"></i>
            Admin
        </a>
        <a href="#" class='flex gap-2 items-center py-1 px-4 hover:text-black'>
            <i class="w-5 fa fa-user" aria-hidden="true"></i>
            Profile
        </a>
    </aside>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/inertia-vue3'
    const { url, component } = usePage()
</script>