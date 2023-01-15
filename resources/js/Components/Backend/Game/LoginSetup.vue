<template>
    <div className='p-5'>
        <Warning 
            title='Make sure you are not using incognito mode' 
            description='As changes are saved locally on your browser, using an incognito browser will erase your progress if you close it. Do not use the incognito mode when building games.'
        />
        <div className="bg-white shadow rounded mt-5">
            <div className="p-4 bg-[#fefefe] border-b font-bold text-black">
                Game Details & Welcome Screen
            </div>
            <div className="p-4 flex gap-5">
                <div>
                    <h2 className='font-bold'>Login Cover photo*</h2>
                    <h3 className='mb-2'>Shown to players before starting the game.</h3>
                    <img :src="gamePayload.login.image" alt="" v-if="gamePayload.login.image">
                </div>
                <div className='w-full'>
                    <label className='relative block mt-10 mb-5'>
                        <label className='block'>Cover Photo Upload</label>
                        <input type="file" @change="(e) => {
                            handleUpload(e.target.files[0], e);
                        }" />
                    </label>
                    <div class="relative z-0 mb-6 w-full group">
                        <input 
                            type="text" 
                            name="floating_game_title"
                            id="floating_game_title"
                            v-model="gamePayload.login.gameTitle"
                            className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                            placeholder="" 
                            required
                        />
                        <label for="floating_game_title" className="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Title*</label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input 
                            type="text"
                            id="game_code"
                            v-model="gamePayload.login.gameCode"
                            className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                            placeholder="" 
                            required />
                        <label for="game_code" className="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Code*</label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input 
                            type="password"
                            id="game_password" 
                            v-model="gamePayload.login.gamePassword"
                            className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder="" 
                            required 
                        />
                        <label for="game_password" className="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Password*</label>
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

const { gamePayload } = useConnfiguration();
const { handleImageUpload, deleteImage } = useFileUpload();

const handleUpload = async (file, e) => {
    const data = await handleImageUpload(file);
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