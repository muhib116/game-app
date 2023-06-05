<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Language</p>
            <button @click="showModal=true" class="py-1 px-4 bg-slate-800 text-white rounded">+ Create</button>
        </div>
        <div class="px-5 py-5">
            <div class="mt-5 bg-white py-5 px-5 rounded max-w-screen-xl mx-auto shadow-md"> 
                <div class="bg-white overflow-x-auto">
                    <table class="w-full">
                        <tr>
                            <th class="border">EN</th>
                            <th class="border">No</th>
                        </tr>
                        <tr v-for="(item, index) in languages" :key="index">
                            <td class="border text-center">{{ item.en }}</td>
                            <td class="border text-center">{{ item.no }}</td>
                        </tr>
                    </table> 
                </div>
            </div>
        </div>

        <div  v-if="showModal" class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 border-green-600 bg-white shadow-xl w-full max-w-[400px] z-[900]">
            <button @click="showModal=false" class="absolute -top-[40px] -right-[40px] w-[40px] h-[40px] rounded-full bg-red-200 text-red-800">X</button>
            <div class="py-2 px-5 border-b">Add language</div>
            <form class="py-2 px-5 border-b" @submit.prevent="handleSave">
                <div class="flex items-center gap-1 mb-2">
                    <div>En</div>
                    <input v-model="form.en" type="text" placeholder="En" class="w-full" />
                </div>
                <div class="flex items-center gap-1">
                    <div>No</div>
                    <input v-model="form.no" type="text" placeholder="No" class="w-full" />
                </div>
                <div class="flex items-center gap-1">
                    <button type="submit" class="flex items-center py-2 px-5 bg-green-600 text-white ml-auto mt-5">
                        <Preloader v-if="form.processing" />
                        Save
                    </button>
                </div>
            </form>
        </div>
    </Master>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import Master from '../Master.vue'
import { ref } from 'vue'
import Preloader from '@/Components/Global/Preloader.vue';

defineProps({
    languages: {
        type: Array,
        default: []
    },
});

const form = useForm({
    en: null,
    no: null,
})

const showModal = ref(false)

const handleSave = () => {
    form.post(route('language.store'), {
        onSuccess(){
            showModal.value = false;
            form.reset()
        }
    })
}

</script>
