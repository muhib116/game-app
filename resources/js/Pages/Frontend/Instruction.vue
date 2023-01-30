<template>
    <Master :showNavigation="false">
        <div class='p-6'>
            <Button 
                label="INSTRUCTIONS" 
                class='mb-5 py-1 shadow-none rounded-none' 
                @click="nextSteap"
            />
            <div class="relative">
                <component :is="componentList[selectSteap(gameData).component]" :data="selectSteap(gameData)" />
                <div v-if="Number(gameData.instruction.length) != index+1">
                    <Button
                        label="Next"
                        class='mt-5' 
                        @click="nextSteap"
                    />
                </div>
                <Link :href="`${$page.props.ziggy.url}/start-game/username/test123`" v-else>
                    <Button
                        label="START GAME"
                        class='mt-5' 
                    />
                </Link>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import Master from './Master.vue'
    import image_one from '@/Assets/image-one.jpg'
    import Button from '@/Components/Global/Button.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import Home from '@/Components/Backend/Game/components/Home.vue'
    import Instruction from '@/Components/Backend/Game/components/Instruction.vue'
    import StartGame from '@/Components/Backend/Game/components/StartGame.vue'
    import { ref } from 'vue'

    defineProps({
        gameData: Object
    });
    const componentList = {
        Home,
        Instruction,
        StartGame
    }
    const index = ref(0);
    const selectSteap = (gameData) => {
        return gameData.instruction[index.value];
    }

    const nextSteap = () => {
        (index.value < 2) ? index.value++ : index.value = 0;
    }
    const shouldShow = (controlBy, data) => {
        if (controlBy=='admin') {
            return true;
        }
        if (data.show == true) {
            return true;
        }
        return false;
    }

</script>

<style lang="scss" scoped>

</style>