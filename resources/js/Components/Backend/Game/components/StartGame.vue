<template>
    <div class='relative border h-full flex flex-col'>
        <div class='text-sm mb-4 text-center leading-8 text-black text-opacity-75'>
            <iframe
                :src="`https://maps.google.com/maps?q=${data.settings.longtide},${data.settings.lattitude}&z=19&output=embed`"
                height="300" 
                class='w-full'
                allowFullScreen="" 
                loading="lazy" 
                referrerPolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
        <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg h-full'>
            <input v-if="controlBy == 'admin'" class="block w-full text-3xl mb-4 text-center" v-model="data.settings.longtide" placeholder="Longtide" />
            <input v-if="controlBy == 'admin'" class="block w-full text-3xl mb-4 text-center" v-model="data.settings.lattitude" placeholder="Lattitude" />
            <input v-if="controlBy == 'admin'" class="block w-full text-3xl mb-4 text-center" v-model="data.title" />
            <p v-else class="block w-full text-3xl mb-4 text-center">{{ data.title }}</p>
            <textarea 
                class='w-full block text-center bg-transparent border-none mb-2' 
                v-model="data.description"
                rows="3"
                v-if="controlBy == 'admin'"
            />
            <p v-else class="w-full block text-center bg-transparent border-none mb-2">{{ data.description }}</p>
        </div>
        <!-- <button className='bg-green-500 py-2 px-4 w-full text-white font-bold self-end'>Save</button> -->
    </div>
</template>

<script setup>
    import { get } from 'lodash'
    defineProps({
        data: Object,
        controlBy: {
            type: String,
            default: null,
        }
    })
</script>

<style lang="scss" scoped>

</style>