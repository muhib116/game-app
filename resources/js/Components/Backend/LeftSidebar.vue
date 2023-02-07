<template>
    <aside 
        class='h-[100vh] py-4 border-r text-gray-500 bg-white sticky top-14 left_aside'
    >
        <Link 
            :href="route('dashboard')"
            class="flex gap-2 items-center py-1 px-4 hover:text-black"
            :class="component == 'Backend/Dashboard' && 'text-black bg-slate-200'"
        >
            <i class="w-5 fa fa-pie-chart" aria-hidden="true"></i>
            Dashboard
        </Link>
        <Link 
            :href="route('game')"
            class="flex gap-2 items-center py-1 px-4 hover:text-black"
            :class="component == 'Backend/Game/index' && 'text-black bg-slate-200'"
        >
            <i class="w-5 fa fa-gamepad" aria-hidden="true"></i>
            Games
        </Link>
        <template v-if="get($page.props, 'auth.user.type') == 'admin'">
            <Link 
                :href="route('gamehosts')"
                class="flex gap-2 items-center py-1 px-4 hover:text-black"
                :class="component == 'Backend/Gamehost/Index' && 'text-black bg-slate-200'"
            >
                <i class="w-5 fa fa-users" aria-hidden="true"></i>
                Gamehost
            </Link>
        </template>
        <Link 
            :href="route('files')" 
            class='flex gap-2 items-center py-1 px-4 hover:text-black'
            :class="component == 'Backend/Files/Index' && 'text-black bg-slate-200'"
        >
            <i class="w-5 fa fa-folder-open" aria-hidden="true"></i>
            Files
        </Link>
        <!-- <a href="#" class='flex gap-2 items-center py-1 px-4 hover:text-black'>
            <i class="w-5 fa fa-lock" aria-hidden="true"></i>
            Admin
        </a> -->
        <Link 
            :href="route('profile.edit')" 
            class='flex gap-2 items-center py-1 px-4 hover:text-black'
            :class="component == 'Profile/Edit' && 'text-black bg-slate-200'"
        >
            <i class="w-5 fa fa-user" aria-hidden="true"></i>
            Profile
        </Link>
        <Link 
            :href="route('logout')" 
            method="POST" 
            class='flex gap-2 items-center py-1 px-4 hover:text-black' 
        >
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </Link>
    </aside>
</template>

<script setup>
    import { useGlobalSetting } from '@/helper';
    import { Link, usePage } from '@inertiajs/inertia-vue3'
    import { get } from 'lodash'
    const { url, component } = usePage()
    const { asideActive, asideToggle } = useGlobalSetting();
</script>