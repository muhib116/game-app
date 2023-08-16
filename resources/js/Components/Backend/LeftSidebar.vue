<template>
    <aside class='h-[100vh] py-4 border-r text-white text-opacity-60 bg-[#222244] sticky top-14 left_aside !text-md font-semibold'>
        <Link :href="route('dashboard')" class="flex gap-2 items-center py-1 px-4 hover:text-white" :class="component == 'Backend/Dashboard' && 'text-white bg-[#222266]'">
            <i class="w-5 fa fa-pie-chart" aria-hidden="true"></i>
            {{ translate('Dashboard') }}
        </Link>
        <button @click="handleSave(defaultGamePayload)" class="flex gap-2 items-center py-1 px-4 hover:text-white">
            <Preloader v-if="loading.save" />
            <i v-else class="w-5 fa fa-gamepad" aria-hidden="true"></i>
            {{ translate('Create new game') }}
        </button>
        <Link :href="route('game')" class="flex gap-2 items-center py-1 px-4 hover:text-white" :class="component == 'Backend/Game/index' && 'text-white bg-[#222266]'">
            <i class="w-5 fa fa-gamepad" aria-hidden="true"></i>
            {{ translate('Existing game') }}
        </Link>
        <template v-if="get($page.props, 'auth.user.type') == 'admin'">
            <Link 
                :href="route('gamehosts')"
                class="flex gap-2 items-center py-1 px-4 hover:text-white"
                :class="component == 'Backend/Gamehost/Index' && 'text-white bg-[#222266]'"
            >
                <i class="w-5 fa fa-users" aria-hidden="true"></i>
                {{ translate('Gamehost') }}
            </Link>
        </template>
        <template v-if="get($page.props, 'auth.user.type') == 'admin'">
            <Link 
                :href="route('contacts')"
                class="flex gap-2 items-center py-1 px-4 hover:text-white"
                :class="component == 'Backend/Contact/Index' && 'text-white bg-[#222266]'"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"></path>
                </svg>
                {{ translate('Contacts') }}
            </Link>
        </template>
        <Link :href="route('files')" class='flex gap-2 items-center py-1 px-4 hover:text-white' :class="component == 'Backend/Files/Index' && 'text-white bg-[#222266]'">
        <i class="w-5 fa fa-folder-open" aria-hidden="true"></i>
        {{ translate('Files') }}
        </Link>
        <!-- <a href="#" class='flex gap-2 items-center py-1 px-4 hover:text-white'>
            <i class="w-5 fa fa-lock" aria-hidden="true"></i>
            Admin
        </a> -->
        <Link :href="route('profile.edit')" class='flex gap-2 items-center py-1 px-4 hover:text-white' :class="component == 'Profile/Edit' && 'text-white bg-[#222266]'">
        <i class="w-5 fa fa-user" aria-hidden="true"></i>
        {{ translate('Profile') }}
        </Link>
        <button type="submit" form="logoutFormAside" class='flex gap-2 items-center py-1 px-4 hover:text-white'>
            <i class="fas fa-sign-out-alt"></i>
            {{ translate('Logout') }}
        </button>
    </aside>
    <form :action="route('logout')" method="post" class="hidden" id="logoutFormAside"></form>
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
import { translate } from '@/useLanguage';
const { url, component } = usePage()
const { asideActive, asideToggle } = useGlobalSetting();
const toast = useToast();
const { gamePayload, defaultGamePayload } = useConnfiguration();
const { saveGame, gameList, loading } = gameDrain();

const handleSave = async (payload) => {
    if (confirm(translate('Are you sure to create new game?'))) {
        const data = await saveGame({
            ...payload,
            newGame: 'new',
        });
        if (data.id) {
            toast.success(translate('Game create successfully'));
            gamePayload.value = defaultGamePayload
            Inertia.replace(route('game.setup', data.id));
        }
    }
}

</script>