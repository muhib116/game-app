<template>
    <aside class='h-[100vh] py-4 border-r text-white text-opacity-60 bg-[#222244] sticky top-14 left_aside !text-md font-semibold'>
        <Link :href="route('dashboard')" class="flex gap-2 items-center py-1 px-4 hover:text-white" :class="component == 'Backend/Dashboard' && 'text-white bg-[#222266]'">
            <i class="w-5 fa fa-pie-chart" aria-hidden="true"></i>
            Dashboard
        </Link>
        <button @click="handleSave(defaultGamePayload)" class="flex gap-2 items-center py-1 px-4 hover:text-white">
            <Preloader v-if="loading.save" />
            <i v-else class="w-5 fa fa-gamepad" aria-hidden="true"></i>
            Create new game
        </button>
        <Link :href="route('game')" class="flex gap-2 items-center py-1 px-4 hover:text-white" :class="component == 'Backend/Game/index' && 'text-white bg-[#222266]'">
        <i class="w-5 fa fa-gamepad" aria-hidden="true"></i>
        Existing game
        </Link>
        <!-- <template v-if="get($page.props, 'auth.user.type') == 'admin'">
            <Link 
                :href="route('gamehosts')"
                class="flex gap-2 items-center py-1 px-4 hover:text-white"
                :class="component == 'Backend/Gamehost/Index' && 'text-white bg-[#222266]'"
            >
                <i class="w-5 fa fa-users" aria-hidden="true"></i>
                Gamehost
            </Link>
        </template> -->
        <Link :href="route('files')" class='flex gap-2 items-center py-1 px-4 hover:text-white' :class="component == 'Backend/Files/Index' && 'text-white bg-[#222266]'">
        <i class="w-5 fa fa-folder-open" aria-hidden="true"></i>
        Files
        </Link>
        <!-- <a href="#" class='flex gap-2 items-center py-1 px-4 hover:text-white'>
            <i class="w-5 fa fa-lock" aria-hidden="true"></i>
            Admin
        </a> -->
        <Link :href="route('profile.edit')" class='flex gap-2 items-center py-1 px-4 hover:text-white' :class="component == 'Profile/Edit' && 'text-white bg-[#222266]'">
        <i class="w-5 fa fa-user" aria-hidden="true"></i>
        Profile
        </Link>
        <Link :href="route('logout')" method="POST" class='flex gap-2 items-center py-1 px-4 hover:text-white'>
        <i class="fas fa-sign-out-alt"></i>
        Logout
        </Link>
    </aside>
</template>

<script setup>
import { useGlobalSetting } from '@/helper';
import { Link, usePage } from '@inertiajs/inertia-vue3'
import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
import Preloader from '@/Components/Global/Preloader.vue';
import { Inertia } from '@inertiajs/inertia';
import { get } from 'lodash'
import { useToast } from 'vue-toastification';
import gameDrain from './Game/gameDrain';
const { url, component } = usePage()
const { asideActive, asideToggle } = useGlobalSetting();
const toast = useToast();
const { gamePayload, defaultGamePayload } = useConnfiguration();
const { saveGame, gameList, loading } = gameDrain();

const handleSave = async (payload) => {
    if (confirm('Are you sure to create new game?')) {
        const data = await saveGame({
            ...payload,
            newGame: 'new',
        });
        if (data.id) {
            toast.success('Game create successfully');
            gamePayload.value = defaultGamePayload
            Inertia.replace(route('game.setup', data.id));
        }
    }
}

</script>