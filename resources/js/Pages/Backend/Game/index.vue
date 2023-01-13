<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Games</p>
            <button 
                @click="handleSave(gamePayload)" 
                className='bg-black text-white px-4 py-1 rounded flex gap-1'
                :disabled="loading.save"
            >
                <Preloader v-if="loading.save" />
                <template v-else>+</template>
                Start Creating Game
            </button>

        </div>
        <div class="px-5 py-5">
            <div class="flex items-center justify-center min-h-[400px]" v-if="isEmpty(games)">
                <div class="flex flex-col items-center gap-4">
                    <Preloader />
                    Loading...
                </div>
            </div>
            <div v-else class="mt-5 bg-white py-5 px-5 rounded max-w-screen-xl mx-auto shadow-md">
                <div class="bg-white overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold bg-slate-100">
                                <th class="pb-4 pt-6 px-6">Game host</th>
                                <th class="pb-4 pt-6 px-6">Total task</th>
                                <th class="pb-4 pt-6 px-6">status</th>
                                <th class="pb-4 pt-6 px-6">Action</th>
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
                                <td class="py-3 px-2">
                                    <span v-if="game.status == 'draft'" class="py-px rounded px-3 bg-red-200 text-red-600">Draft</span>
                                </td>
                                <td class="w-px py-3 px-2">
                                    <div class="flex items-center gap-2">
                                        <Link :href="route('game.setup', game.id)" class="flex items-center" tabindex="-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                            </svg>
                                        </Link>
                                        <div>
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
import gameDrain from '@/Components/Backend/Game/gameDrain';
import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
import Preloader from '@/Components/Global/Preloader.vue';
import { Link } from '@inertiajs/inertia-vue3'
import { onMounted, ref } from 'vue';
import { isEmpty } from 'lodash'
import Master from '../Master.vue'
import { Inertia } from '@inertiajs/inertia';

const { gamePayload } = useConnfiguration();
const { saveGame, gameList, loading } = gameDrain();

const games = ref([]);

const handleSave = async (payload) => {
    const data = await saveGame(payload); 
    if (data.id) {
        Inertia.replace(route('game.setup', data.id));
    }
}

onMounted(async()=>{
    const data = await gameList();
    games.value = data;
});

</script>