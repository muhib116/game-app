<template>
    <div class='p-5'>
        <Warning 
            title='Make sure you are not using incognito mode' 
            description='As changes are saved locally on your browser, using an incognito browser will erase your progress if you close it. Do not use the incognito mode when building games.'
        />
        <div class="bg-white shadow rounded mt-5">
            <div class="p-4 bg-[#fefefe] border-b font-bold text-black flex justify-between items-center">
                {{ translate('Game Details & Welcome Screen') }}
                <button v-if="!hasError" @click="next" class="py-1 px-3 bg-slate-700 text-white rounded">{{ translate('Next') }}</button>
                <span v-else class="text-red-500 text-base font-normal">
                    {{ translate('Please change the duplicate game title or game code to continue.') }}
                </span>
            </div>
            <div class="p-4 flex gap-5">
                <div>
                    <h2 class='font-bold'>{{ translate('Login Cover photo') }}*</h2>
                    <h3 class='mb-2'>{{ translate('Shown to players before starting the game.') }}</h3>
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
                            {{ translate('Cover Photo Upload') }}
                            <input
                                v-if="!uploadingImg"
                                type="file" 
                                class="hidden"
                                accept="image/*"
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
                        <label for="floating_game_title" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ translate('Game Title') }}*
                        </label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input 
                            type="text"
                            v-model="gamePayload.login.gameCode"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                            placeholder=""
                            name="asldkfjasdasdfkfjalksdfj"
                            autocomplete="asdfasdfasd"
                            required />
                        <label for="game_code" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ translate('Game Code') }}*
                        </label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input 
                            type="password"
                            id="game_password"
                            name="asldkfjasdkfjalksdfj"
                            v-model="gamePayload.login.gamePassword"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=""
                            autocomplete="ofasdfasdff"
                            required 
                        />
                        <label for="game_password" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            {{ translate('Game Password') }}*
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-center border-t mt-2 border-gray-400">
                <h2 class="font-bold py-2 text-xl">{{ translate('Game team') }}</h2>
            </div>
            <div class="px-4 pb-4">
                <div class="flex flex-wrap gap-2">
                    <label class="flex gap-1 items-center">
                        <input type="checkbox" v-model="gamePayload.login.photoStream">
                        {{ translate('Photo Stream') }}
                    </label>
                    <label class="flex gap-1 items-center">
                        <input type="checkbox" v-model="gamePayload.login.showScoreboard">
                        {{ translate('Show Scoreboard') }}
                    </label>
                    <label class="flex gap-1 items-center">
                        <input type="checkbox" v-model="gamePayload.login.showTeamScore">
                        {{ translate('Team Scoreboard') }}
                    </label>
                </div>
                <!-- team -->
                <div class="flex justify-end mb-4">
                    <button 
                        class="w-[30px] h-[30px] bg-green-600 text-green-50 rounded-full flex items-center justify-center"
                        @click="addTeam(get(gamePayload, 'login.team'))"
                    >
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="bg-white overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold bg-slate-100">
                                <th class="py-2 px-2 text-center">{{ translate('SL') }}</th>
                                <th class="py-2 px-2 text-center">{{ translate('Team name') }}</th>
                                <th class="py-2 px-2 text-center">{{ translate('Team code') }}</th>
                                <th class="py-2 px-2 w-36 text-center">
                                    <div class="flex items-center gap-1">
                                        {{ translate('Action') }}
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <TeamSetup 
                                v-for="(item, index) in get(gamePayload, 'login.team')" 
                                :key="index" 
                                :index="index+1" 
                                :item="item"
                                @remove="removeTeam(get(gamePayload, 'login.team'), index)"
                                :payload="get(gamePayload, 'login.team')"
                            />
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
import TeamSetup from './TeamSetup.vue';
import { toast, slug } from "@/helper";
import { get } from 'lodash'
import { translate } from '@/useLanguage';
import { hasError } from './gameDrain';

defineProps({
    next: Function
});

const { gamePayload } = useConnfiguration();
const { handleImageUpload, deleteImage } = useFileUpload();
const uploadingImg = ref(false);

watch(()=> gamePayload, ()=>{
    gamePayload.value.login.gameTitle = slug(gamePayload.value.login.gameTitle)
}, {
    deep: true
})


const addTeam = (teamAray) => {
    teamAray.push({
        teamName: `Lag#${teamAray.length+1}`,
        teamCode: `Kode#${teamAray.length+1}`
    });
}

const removeTeam = (teamAray, index) => {
    teamAray.splice(index, 1);
}

const handleUpload = async (file, e) => {
    uploadingImg.value = true;
    const data = await handleImageUpload(file, 'loginSetup');
    uploadingImg.value = false;
    if (data?.status == 'error') {
        console.log('error');
        toast.error(translate('Opps! Something went wrong.'));
    }
    if (data?.status == 'success') {
        toast.success(translate('Image Uploaded successfully'));
        let old = gamePayload.value.login.image;
        if (old) {
            deleteImage(old);
        }
        gamePayload.value.login.image = data.path;
        e.target.value = null;
    }
}

</script>