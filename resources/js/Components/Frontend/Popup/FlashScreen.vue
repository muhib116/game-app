<template>
<div v-if="modelValue" @click="$emit('close', false)" class="absolute top-0 left-0 bottom-0 right-0 bg-white flex justify-center items-center z-10">
    <div class="flex flex-col justify-center">
        <img class="w-44" :src="gameLogoPng" alt="">
    </div>
</div>
</template>

<script setup>
import gameLogoPng from '@/Assets/logo-rebuslop.png'
import { onMounted, ref } from 'vue'

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: true
    },
})


const emit = defineEmits(['close'])
onMounted(()=>{
    setTimeout(()=>{
        emit('close', false)
    },2000)
});

</script>