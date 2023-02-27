<template>
    <Master :showNavigation="true" :gameData="gameData">
        <div class="relative">
            <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
                <component :is="componentList[selectTask(gameData.tasks).component]" :game="gameData" :task="selectTask(gameData.tasks)" />
                <!-- <Link :href="route('task')">
                    <Button label="START" class='mt-10' />
                </Link> -->
                <div class="flex gap-1 justify-center">
                    <button 
                        v-if="index>0" 
                        class='text-sm mt-4 w-[100px] h-[100px] rounded-full bg-[#00A89C] font-semibold flex items-center justify-center' 
                        @click="skipTask(gameData.tasks, true)">
                        See prev task
                    </button>

                    <button 
                        v-if="index<gameData.tasks.length-1" 
                        class='text-sm mt-4 w-[100px] h-[100px] rounded-full bg-[#00A89C] font-semibold flex items-center justify-center'
                        @click="skipTask(gameData.tasks)">
                        See next task
                    </button>
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
    import { ref, onMounted } from 'vue';

    const { componentList } = useTaskCreate();

    defineProps({
        gameData: Object
    });

    const index = ref(0)

    const selectTask = (tasks) => {
        return tasks[index.value];
    }
    onMounted(() => {
        const urlParams = new URLSearchParams(window.location.search);
        const pageSize = urlParams.get('q');
        index.value = Number(pageSize);
    })
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