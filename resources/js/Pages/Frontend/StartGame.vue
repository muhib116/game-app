<template>
    <Master :showNavigation="true" :gameData="gameData">
        <div class="h-full relative">
            <div class='text-black text-opacity-80 text-center leading-8 text-lg overflow-y-auto h-[calc(100%-148px)]'>
                <component 
                    @skip="(value) => handleEmittedSkip(gameData.tasks, value)" 
                    :is="componentList[selectTask(gameData.tasks).component]" 
                    :game="gameData" 
                    :task="selectTask(gameData.tasks)" 
                    :isLastTask="!(index < gameData.tasks.length - 1)"
                />
            </div>
            
            <div class="fixed bottom-4 px-4 left-1/2 -translate-x-1/2 w-full flex gap-1 justify-between mt-4 h-[100px] max-w-[768px] z-20">
                <!-- <button v-if="index > 0" class=' w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] font-black flex items-center justify-center' @click="skipTask(gameData.tasks, true)">
                    Prev
                </button>
                <span v-else></span> -->
                <div></div>
                <span></span>

                <button v-if="index < gameData.tasks.length - 1" class='w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center text-black' @click="skipTask(gameData.tasks)">
                    Next
                </button>
            </div>

        </div>
        <FlashSuccess @callback="clsoeHandle" v-model="showFlash" v-if="showFlash" />
    </Master>
</template>

<script setup>
import Master from './Master.vue'
import Button from '@/Components/Global/Button.vue'
import { Link } from '@inertiajs/inertia-vue3'
import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
import { ref, onMounted } from 'vue';
import FlashSuccess from '@/Components/Frontend/Popup/FlashSuccess.vue';

const { componentList } = useTaskCreate();

defineProps({
    gameData: Object
});

const index = ref(0)
const showFlash = ref(false)

const selectTask = (tasks) => {
    return tasks[index.value];
}

const clsoeHandle = () => {
    console.log('close', showFlash.value);
    showFlash.value = false;
    window.location.reload();
}

onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const pageSize = urlParams.get('q');
    index.value = Number(pageSize);
})

const handleEmittedSkip = (tasks, val) => {
    console.log(tasks, val);
    showFlash.value = true;
    skipTask(tasks)
}

const skipTask = (tasks, prev = false) => {
    const urlParams = new URLSearchParams(window.location.search);
    const pageSize = urlParams.get('q');
    let href = window.location.href;

    if (prev) {
        index.value--;
        if (pageSize == null) {
            history.pushState({}, null, `${href}?q=${index.value}`); 
            return;
        }
        history.pushState({}, null, href.replace(`?q=${pageSize}`, `?q=${index.value}`));
        return;
    }
    if (index.value < tasks.length - 1) {
        index.value++;
    } else {
        index.value = 0;
    }
    if (pageSize == null) {
        history.pushState({}, null, `${href}?q=${index.value}`); 
        return;
    } else {
        history.pushState({}, null, href.replace(`?q=${pageSize}`, `?q=${index.value}`)); 
    }
    // window.location.href = href.replace(`?q=${pageSize}`, `?q=${index.value}`);
}

</script>

<style lang="scss" scoped></style>