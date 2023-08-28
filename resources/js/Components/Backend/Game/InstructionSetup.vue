<template>
    <div className='p-5'>
        <div className="bg-white shadow rounded mt-5">
            <div className="p-4 bg-[#fefefe] border-b font-bold text-black flex justify-between items-center">
                <span>Instruksjon</span>
                <button @click="tabValidator(next)" class="py-1 px-3 bg-slate-700 text-white rounded">{{ translate('Next') }}</button>
            </div>
            <div className="p-4 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
                <div v-for="item in gamePayload.instruction" :key="item.component">
                    <component :is="componentList[item.component]" :data="item" :controlBy="'admin'" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Home from '@/Components/Backend/Game/components/Home.vue'
    import Instruction from '@/Components/Backend/Game/components/Instruction.vue'
    import StartGame from '@/Components/Backend/Game/components/StartGame.vue'
    import image_one from '@/Assets/image-one.jpg'
    import { tabValidator } from '@/Pages/Backend/validator.js'
    import useConnfiguration from './useConnfiguration'
    import { ref } from 'vue'
    import { translate } from '@/useLanguage'

    defineProps({
        next: Function
    });
    const { gamePayload } = useConnfiguration();
    const componentList = ref({
        Home,
        Instruction,
        StartGame,
    });
</script>
