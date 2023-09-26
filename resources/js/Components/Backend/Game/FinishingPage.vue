<template>
    <div class='relative flex flex-col h-[85%] overflow-y-auto'>
        <div class='text-sm mb-4 mt-4 text-center leading-8 text-black text-opacity-75' v-if="controlBy=='admin' || (gameData.finishing.longtide && gameData.finishing.lattitude)">
            <iframe :src="`https://maps.google.com/maps?q=${gameData.finishing.longtide},${gameData.finishing.lattitude}&z=19&output=embed`" height="400" class='w-full' allowFullScreen="" loading="lazy" referrerPolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg h-full'>
            <input v-if="controlBy=='admin'" class="block w-full text-3xl mb-4 text-center" :placeholder="translate('Title')" v-model="gameData.finishing.title" />
            <div v-else class="pt-8 pb-4 font-black text-xl">
                <p class="block w-full text-3xl mb-4 text-center">{{ translate(gameData.finishing.title) }}</p>
            </div>
            <input v-if="controlBy=='admin'" class="block w-full text-3xl mb-4 text-center" v-model="gameData.finishing.longtide" :placeholder="translate('Longitude')" />
            <input v-if="controlBy=='admin'" class="block w-full text-3xl mb-4 text-center" v-model="gameData.finishing.lattitude" :placeholder="translate('Latitude')" />            
            <textarea 
                class='w-full block text-center bg-transparent border-none resize-none mb-2' 
                :placeholder="translate('Description')" 
                v-model="gameData.finishing.text" 
                rows="3" 
                v-if="controlBy=='admin'"
            />
            <p v-else class="w-full block text-center bg-transparent border-none mb-2 h-[168px] overflow-y-auto ">{{ gameData.finishing.text }}</p>
        </div>
        <!-- <button className='bg-[var(--fave)] py-2 px-4 w-full text-white font-bold self-end'>Save</button> -->
        <div class="pr-5 flex justify-end" v-if="controlBy=='admin'">
            <button @click="handleFinish" class="bg-[var(--faveDark)] text-white py-2 px-3 rounded ml-auto block">
                {{ translate('Finish Up') }}
            </button>
        </div>
    </div>
</template>

<script setup>
import { get } from 'lodash'
import useFileUpload from '@/useFileUpload';
import { translate } from '@/useLanguage';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import useConnfiguration from './useConnfiguration'
import { onMounted, ref } from 'vue'
import gameDrain from './gameDrain';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    controlBy: {
        type: String,
        default: 'admin'
    },
    gameData: {
        type: Object,
        default: {}
    },
})

const { saveGame, loading } = gameDrain()
const { handleImageUpload, deleteImage } = useFileUpload();

const { gamePayload } = useConnfiguration();

const handleFinish = async () => {
    await saveGame(gamePayload.value)
    Inertia.get(route('game'))
}

const handleUpload = async (file, e) => {
    let data = props.data;
    const response = await handleImageUpload(file);
    if (response.status == 'error') {
        console.log('error');
    }
    if (response.status == 'success') {
        let old = data.settings.image;
        if (old) {
            deleteImage(old);
        }
        data.settings.image = response.path;
        e.target.value = null;
    }
}

const isAdmin = ref(false)

onMounted(()=>{
    isAdmin.value =  get(usePage().props.value, 'auth.user')
})

</script>

<style lang="scss" scoped>

</style>