<template>
    <div class='p-5'>
        <Warning 
            title='Make sure you are not using incognito mode' 
            description='As changes are saved locally on your browser, using an incognito browser will erase your progress if you close it. Do not use the incognito mode when building games.'
        />
        <div class="bg-white shadow rounded mt-5">
            <div class="p-4 bg-[#fefefe] border-b font-bold text-black flex justify-between items-center">
                Game Details & Welcome Screen
                <button @click="next" class="py-1 px-3 bg-slate-700 text-white rounded">Next</button>
            </div>
            <div class="p-4 flex gap-5">
                <div>
                    <h2 class='font-bold'>Login Cover photo*</h2>
                    <h3 class='mb-2'>Shown to players before starting the game.</h3>
                    <img :src="gamePayload.login.image" alt="" v-if="gamePayload.login.image">
                </div>
                <div class='w-full'>
                    <div class="flex">
                        <label class='relative flex mt-0 mb-5'>
                        <!-- <label class='block mb-4'>Cover Photo Upload</label> -->
                        
                        <label
                            class="bg-gray-100 flex gap-1 items-center select-none focus:scale-95 rounded-md mt-4 py-2 px-4 active:scale-95 hover:bg-gray-200 transition-colors duration-300 cursor-pointer"
                            :class="uploadingImg && 'opacity-95 pointer-events-none'"
                        >
                            <div v-if="uploadingImg" class="inline-flex items-center">
                                <svg class="animate-spin h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                            <i v-else class="fa fa-upload"></i>
                            Cover Photo Upload
                            <input
                                v-if="!uploadingImg"
                                type="file" 
                                class="hidden"
                                @change="(e)=>{
                                    handleUpload(e.target.files[0], e);
                                }"
                            />
                        </label>
                    </label>
                    </div>
                    <div class="relative z-0 mb-6 mt-4 w-full group">
                        <input 
                            type="text" 
                            id="floating_game_title"
                            v-model="gamePayload.login.gameTitle"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                            placeholder="" 
                            autocomplete="off"
                            required
                        />
                        <label for="floating_game_title" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Title*</label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input 
                            type="text"
                            v-model="gamePayload.login.gameCode"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                            placeholder=""
                            autocomplete="off"
                            required />
                        <label for="game_code" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Code*</label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input 
                            type="password"
                            id="game_password" 
                            v-model="gamePayload.login.gamePassword"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=""
                            autocomplete="off"
                            required 
                        />
                        <label for="game_password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Password*</label>
                    </div>
                </div>
            </div>
            <div class="text-center border-t mt-2 border-gray-400">
                <h2 class="font-bold py-2 text-xl">Game team</h2>
            </div>
            <div class="px-4 pb-4">
                <!-- team -->
                <div class="flex justify-end mb-4">
                    <button 
                        class="w-[30px] h-[30px] bg-green-600 text-green-50 rounded-full flex items-center justify-center"
                        @click="addTeam(gamePayload.login.team)"
                    >
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="bg-white overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold bg-slate-100">
                                <th class="py-2 px-2 text-center">SL</th>
                                <th class="py-2 px-2 text-center">Team name</th>
                                <th class="py-2 px-2 text-center">Team code</th>
                                <th class="py-2 px-2 w-36 text-center">
                                    <div class="flex items-center gap-1">
                                        Action
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in get(gamePayload, 'login.team')" :key="index" class="hover:bg-gray-100 focus-within:bg-gray-100 border-b">
                                <td class="py-3 px-2 text-center">
                                    {{ index+1 }}
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <input class="border-gray-300 flex-1 py-1" type="text" v-model="gamePayload.login.team[index].teamName" />
                                </td>
                                <td class="py-3 px-2 text-center">
                                    <input class="border-gray-300 flex-1 py-1" type="text" v-model="gamePayload.login.team[index].teamCode" />
                                </td>
                                <td class="text-center">
                                    <button 
                                        v-if="index>0"
                                        @click="removeTeam(gamePayload.login.team, index)"
                                        class="bg-red-200 text-red-600 w-[30px] h-[30px] flex items-center justify-center rounded-full"
                                    >
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, watch, watchEffect } from 'vue';
import Warning from '../Warning.vue'
import useFileUpload from '@/useFileUpload';
import useConnfiguration from './useConnfiguration';
import { toast } from "@/helper";
import { get } from 'lodash'

defineProps({
    next: Function
});

const { gamePayload } = useConnfiguration();
const { handleImageUpload, deleteImage } = useFileUpload();
const uploadingImg = ref(false);

const addTeam = (teamAray) => {
    teamAray.push({
        teamName: `team ${teamAray.length}`,
        teamCode: `teamcode-${teamAray.length}`
    });
}
const removeTeam = (teamAray, index) => {
    teamAray.splice(index, 1);
}

const handleUpload = async (file, e) => {
    uploadingImg.value = true;
    const data = await handleImageUpload(file, 'loginSetup');
    uploadingImg.value = false;
    if (data.status == 'error') {
        console.log('error');
        toast.error('Opps! Something went wrong.');
    }
    if (data.status == 'success') {
        toast.success('Image Uploaded successfully');
        let old = gamePayload.value.login.image;
        if (old) {
            deleteImage(old);
        }
        gamePayload.value.login.image = data.path;
        e.target.value = null;
    }
}

</script>