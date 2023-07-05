<template>
<div v-if="modelValue" @click="$emit('closePresent', false)" class="absolute top-0 left-0 bottom-0 right-0 bg-white flex justify-center items-center z-10">
    <div class="flex flex-col justify-center">
        <!-- <div class="text-xl text-center font-black pb-4">
            {{ translate('Presented By') }}
        </div> -->
        <img class="w-[300px]" :src="`${$page.props.asset}${get(game, 'user.logo')}`" alt="">
    </div>
</div>
</template>

<script setup>
import gameLogoPng from '@/Assets/logo-rebuslop.png'
import { onMounted, ref } from 'vue'
import { get } from 'lodash'
import { translate } from '@/useLanguage';

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: true
    },
    game: {
        type: Object,
        default: {}
    }
})


const emit = defineEmits(['closePresent'])
onMounted(()=>{
    setTimeout(()=>{
        emit('closePresent', false)
    },3000)
});

</script>