<template>
    <div class='relative h-full flex flex-col'>
        <div className="py-0 px-2 h-[40px] bg-white z-10 flex justify-between items-center gap-3 border-b" v-if="controlBy == 'admin'">
            <div className='flex items-center gap-3'></div>
            <label className='cursor-pointer flex gap-2 text-xs items-center py-2.5'>
                Show
                <input type="checkbox" v-model="data.show" />
            </label>
        </div>
        <div class='text-sm mb-4 text-center leading-8 text-black text-opacity-75'>
            <input v-if="controlBy == 'admin'" class="block w-full text-3xl mb-4 text-center" v-model="data.title" />
            <div v-else class="pt-8 pb-4 font-black text-xl">
                <p class="block w-full text-3xl mb-4 text-center">{{ data.title }}</p>
            </div>
        <iframe :src="`https://maps.google.com/maps?q=${data.settings.longtide},${data.settings.lattitude}&z=7&output=embed`" height="400" class='w-full' allowFullScreen="" loading="lazy" referrerPolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg h-full'>
            <input v-if="controlBy == 'admin'" class="block w-full text-3xl mb-4 text-center" v-model="data.settings.longtide" placeholder="Longtide" />
            <input v-if="controlBy == 'admin'" class="block w-full text-3xl mb-4 text-center" v-model="data.settings.lattitude" placeholder="Lattitude" />            
            <textarea class='w-full block text-center bg-transparent border-none mb-2' v-model="data.description" rows="3" v-if="controlBy == 'admin'" />
            <p v-else class="w-full block text-center bg-transparent border-none mb-2 h-[168px] overflow-y-auto ">{{ data.description }}</p>
        </div>
        <!-- <button className='bg-[var(--fave)] py-2 px-4 w-full text-white font-bold self-end'>Save</button> -->
    </div>
</template>

<script setup>
import { get } from 'lodash'
import useFileUpload from '@/useFileUpload';
const { handleImageUpload, deleteImage } = useFileUpload();

const props = defineProps({
    data: Object,
    controlBy: {
        type: String,
        default: null,
    }
})


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
</script>

<style lang="scss" scoped>

</style>