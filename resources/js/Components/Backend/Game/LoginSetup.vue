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
                            class="bg-gray-100 select-none focus:scale-95 rounded-md mt-4 py-2 px-4 active:scale-95 hover:bg-gray-200 transition-colors duration-300 cursor-pointer"
                        >
                            <i class="fa fa-upload"></i>
                            Cover Photo Upload
                            <input 
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
        </div>
    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, watch, watchEffect } from 'vue';
import Warning from '../Warning.vue'
import useFileUpload from '@/useFileUpload';
import useConnfiguration from './useConnfiguration';

defineProps({
    next: Function
});

const { gamePayload } = useConnfiguration();
const { handleImageUpload, deleteImage } = useFileUpload();

const handleUpload = async (file, e) => {
    const data = await handleImageUpload(file, 'loginSetup');
    if (data.status == 'error') {
        console.log('error');
    }
    if (data.status == 'success') {
        let old = gamePayload.value.login.image;
        if (old) {
            deleteImage(old);
        }
        gamePayload.value.login.image = data.path;
        e.target.value = null;
    }
}

</script>