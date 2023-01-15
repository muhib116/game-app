<template>
    <div className='p-5'>
        <div className="bg-white shadow rounded mt-5">
            <div className="p-4 bg-[#fefefe] border-b font-bold text-black">
                Game Instruction
            </div>
            <div className="p-4 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
                <div v-for="item in gamePayload.instruction" :key="item.component">
                    <component :is="componentList[item.component]" :data="item" />
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
    import useConnfiguration from './useConnfiguration'
    import { ref } from 'vue'

    const { gamePayload } = useConnfiguration();
    const componentList = ref({
        Home,
        Instruction,
        StartGame,
    });
</script>
