<template>
    <Master>
        <div className="flex justify-between p-5 bg-white shadow">
            <p className="text-xl font-bold text-black">Games</p>
            <button 
                @click="handleSave(defaultGamePayload)" 
                class='bg-black text-white px-4 py-1 rounded flex gap-1' 
                v-if="!loading.save"
            >
                + Start Creating Game
            </button>
        <Preloader v-if="loading.save" />
        </div>
        <div class="px-5 py-5">
            <div class="flex items-center justify-center min-h-[400px]" v-if="loading.list">
                <div class="flex flex-col items-center gap-4">
                    <Preloader />
                    Loading...
                </div>
            </div>
            <div v-else class="mt-5 bg-white py-5 px-5 rounded shadow-md">
                <div class="flex justify-center py-4" v-if="publishLoading">
                    <Preloader />
                </div>
                <div class="bg-white overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold bg-slate-100">
                                <th class="py-2 px-2">Game host</th>
                                <th class="py-2 px-2">Total task</th>
                                <th class="py-2 px-2 text-center">Status</th>
                                <th class="py-2 px-2 w-36 text-center">Info</th>
                                <th class="py-2 px-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="game in games" :key="game.id" class="hover:bg-gray-100 focus-within:bg-gray-100 border-b">
                                <td class="py-3 px-2">
                                    {{ game.user.name }}
                                </td>
                                <td class="py-3 px-2">
                                    {{ game.tasks.length }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <button 
                                        @click="handlePublish(game)" 
                                        v-if="game.status == 'draft'" 
                                        class="rounded px-3
                                        bg-red-500
                                        font-semibold
                                        text-white items-center"
                                    >
                                        Click to Publish
                                    </button>
                                    <button 
                                        @click="handlePublish(game)"
                                        v-else
                                        :disabled="game.start_time"
                                        class="py-px rounded px-3 
                                        bg-transparent font-bold flex items-center mx-auto
                                        text-green-700"
                                    >
                                        Published <span v-if="game.start_time">(Game started)</span>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <div class="flex gap-1" v-if="!game.end_time">
                                        <button 
                                            :disabled="game.status == 'draft'" 
                                            @click="openCopyPopup(game)" 
                                            class="py-px px-3 bg-blue-500 text-white rounded flex items-center"
                                        >
                                            <svg v-if="copied" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                                            </svg>
                                            <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z"></path>
                                            </svg>
                                            Copy
                                        </button>
                                        <a v-if="game.status == 'published'" target="_blank" :href="`${get($page, 'props.ziggy.url')}/${game.user.username}/${game.login.gameTitle}`" class="py-px px-3 bg-[var(--fave)] text-white rounded">
                                            View
                                        </a>
                                        <button v-else class="py-px px-3 bg-[var(--fave)] text-white rounded">
                                            View
                                        </button>
                                    </div>
                                    <div v-else>
                                        <span
                                            v-if="game.start_time"
                                            class="py-px rounded px-3 
                                            flex items-center font-bold justify-center
                                            text-green-700"
                                        >
                                            Complete
                                        </span>
                                    </div>
                                </td>
                                <td class="w-px py-3 px-4 text-center">
                                    <div class="flex items-center gap-2">
                                        <Link v-if="!game.start_time" :href="route('game.setup', game.id)" class="flex items-center" tabindex="-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                            </svg>
                                        </Link>
                                        <Link :href="route('game.dashboard', game.id)" class="flex items-center" tabindex="-1">
                                            <i class="w-5 fa fa-pie-chart" aria-hidden="true"></i>
                                        </Link>
                                        
                                        <button v-if="!game.start_time" @click="handleDelete(game)">
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- game code copy popup -->
        <Transition>
            <div 
                v-if="copyOpen" 
                @click.self="closeCopyPopup"
                class="fixed z-[999] bg-white/70 w-full h-full left-0 top-0 flex items-center justify-center"
            >
                
                <div class="w-full relative max-w-[400px] min-h-[100px] mx-2 bg-white/50 border-[var(--faveDark)] border-2 rounded py-4 px-2 backdrop-blur-sm shadow-2xl">
                    <button
                        @click="closeCopyPopup"
                        class="w-[30px] h-[30px] flex items-center justify-center bg-red-200 text-red-700 rounded-full absolute -top-5 -right-5"
                    >
                        <i class="fa fa-times"></i>
                    </button>
                    <h2 class="text-xl font-bold text-center mb-2">Team list</h2>
                    <div class="divide-y">
                        <template v-for="(item, index) in teamList" :key="index">
                            <div class="py-4 flex justify-between items-center gap-1">
                                <div>
                                    <div>
                                        Name: <strong class="font-bold">{{ item.teamName }}</strong>
                                    </div>
                                    <div>
                                        Code: <strong class="font-bold">{{ item.teamCode }}</strong>
                                    </div>
                                    <div>
                                        URL: <strong class="font-bold">{{ `${$page.props.ziggy.url}/${copyGame.user.username}/${copyGame.login.gameTitle}` }}</strong>
                                    </div>
                                </div>
                                <button @click="copyLink(teamList[index], copyGame)" class="text-white bg-[var(--faveDark)] rounded py-px px-2">Copy</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </Transition>
    </Master>
</template>

<script setup>
import gameDrain from '@/Components/Backend/Game/gameDrain';
import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
import Preloader from '@/Components/Global/Preloader.vue';
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { onMounted, ref } from 'vue';
import { isEmpty, get, toLower } from 'lodash'
import Master from '../Master.vue'
import { Inertia } from '@inertiajs/inertia';
import { useToast } from "vue-toastification";
import axios from 'axios';

const toast = useToast();
const { gamePayload, defaultGamePayload } = useConnfiguration();
const { saveGame, gameList, loading } = gameDrain();

const page =  usePage();

const games = ref([]);
const copied = ref(false);
const publishLoading = ref(false);

const handleSave = async (payload) => {
    gamePayload.value.id = null;
    const data = await saveGame(payload);
    if (data.id) {
        toast.success('Game create successfully');
        Inertia.replace(route('game.setup', data.id));
    }
}

const teamList = ref([]);
const copyOpen = ref(false);
const copyGame = ref(null);
const openCopyPopup = (game) => {
    teamList.value = game.login.team;
    copyGame.value = game;
    copyOpen.value = true;
}
const closeCopyPopup = () => {
    teamList.value = [];
    copyOpen.value = false;
    copyGame.value = null;
}

// copyLink(`${get($page, 'props.ziggy.url')}/${game.user.username}/${game.login.gameTitle} \nGame code: ${game.login.gameCode} \nGame password: ${game.login.gamePassword}`)
const copyLink = (team, game) => {  
    let link = `Team Name: ${team.teamName}\n${page.props.value.ziggy.url}/${game.user.username}/${game.login.gameTitle}\nTeam code: ${team.teamCode}\nGame code: ${game.login.gameCode}\nGame password: ${game.login.gamePassword}`;
    navigator.clipboard.writeText(link);
    toast.success('Game data is copyied!');
    closeCopyPopup();
}
// http://127.0.0.1:8000/username/another 
// Team code: team-7 
// Game code: another 
// Game password: another
const handleDelete = (game) => {
    if (confirm('Are you sure?')) {
        loading.value.list = true;
        axios.post(route('game.delete', game.id))
            .then(res => res.data)
            .then(async (result) => {
                loading.value.list = false;
                const data = await gameList();
                games.value = data;
                toast.success('Game delete successfully!', {
                    position: 'top-center',
                });
            });
        // Inertia.post(route('game.delete', game.id), {
        //     onSuccess() {
        //         console.log('successfully delete')
        //     }
        // });
    }
}

const handlePublish = (game) => {
    if (confirm('Are you sure?')) {
        publishLoading.value = true;
        axios.post(route('game.publish', game.id))
            .then(res => res.data)
            .then(async (result) => {
                publishLoading.value = false;
                // loading.value.list = false;
                if (result?.status == 'failed') {
                    toast.error(result.message)
                } else {
                    toast.success(result.message);
                }
                const data = await gameList();
                games.value = data;
            })
            .catch(err => {
                publishLoading.value = false;
            });
    }
}

onMounted(async () => {
    const data = await gameList();
    games.value = data;
});

</script>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>