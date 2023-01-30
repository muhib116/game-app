<template>
    <div v-if="modelValue" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-white/50 bg-opacity-50 backdrop-blur-lg z-50">
        <i 
            @click="() => {
                $emit('update:modelValue', false);
            }" 
            class="fa-solid exit fa-xmark absolute top-4 right-4 text-4xl cursor-pointer hover:text-red-600"
        ></i>
        <div class="w-full max-w-xl">
            {{ data }}
            <textarea class="w-full" v-model="answer" rows="3" placeholder="Write your answer"></textarea>
            <button class="mt-3 py-1 px-4 bg-[#FDBA74] text-black shadow-md rounded">Submit</button>
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios'
    import { ref, onMounted } from 'vue'
    const props = defineProps({
        modelValue: {
            type: Boolean,
            default: false
        },
        data: {
            type: Object,
            default: {}
        }
    })
    const answer = ref('');
</script>

<style>
    .qrcode-stream-camera,
    .qrcode-stream-overlay{
        width: 250px !important;
        display: block;
        aspect-ratio: 1/1;
    }
</style>