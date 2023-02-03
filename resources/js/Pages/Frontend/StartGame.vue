<template>
    <Master :showNavigation="true" :gameData="gameData">
        <div class="flex items-center justify-center pt-4">
            <Link class="py-2 px-4 bg-red-500 text-white rounded" :href="route('game_exit')" method="POST" type="button">Exit Game</Link>
        </div>
        <div class="relative">
            <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
                <component :is="componentList[selectTask(gameData.tasks).component]" :game="gameData" :task="selectTask(gameData.tasks)" />
                <!-- <Link :href="route('task')">
                    <Button label="START" class='mt-10' />
                </Link> -->
                <div class="flex gap-1 justify-center">
                    <button v-if="index>0" class='text-sm mt-4 py-1 px-3 bg-orange-500 rounded text-white' @click="skipTask(gameData.tasks, true)">Prev</button>
                    <button v-if="index<gameData.tasks.length-1" class='text-sm mt-4 py-1 px-3 bg-blue-500 rounded text-white' @click="skipTask(gameData.tasks)">Next</button>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import Master from './Master.vue'
    import Button from '@/Components/Global/Button.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import { ref } from 'vue';

    const { componentList } = useTaskCreate();

    defineProps({
        gameData: Object
    });

    const index = ref(0)

    const selectTask = (tasks) => {
        return tasks[index.value];
    }

    const skipTask = (tasks, prev=false) => {
        if (prev) {
            index.value--;
            return;
        }
        if (index.value < tasks.length-1) {
            index.value++;
        } else {
            index.value = 0;
        }
    }

</script>

<style lang="scss" scoped>

</style>