<template>
    <Master :showNavigation="false">
        <div class="relative">
            <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
                <component :is="componentList[selectTask(gameData.tasks).component]" :game="gameData" :data="selectTask(gameData.tasks).data" />
                <!-- <Link :href="route('task')">
                    <Button label="START" class='mt-10' />
                </Link> -->
                <button class='text-sm mt-4' @click="skipTask(gameData.tasks)">Skip</button>
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

    const skipTask = (tasks) => {
        if (index.value < tasks.length-1) {
            index.value++;
        } else {
            index.value = 0;
        }
    }

</script>

<style lang="scss" scoped>

</style>