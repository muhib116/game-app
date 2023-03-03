<template>
    <Master :showNavigation="true" :gameData="gameData">
        <div class="">
            <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
                <component @skip="(value) => handleEmittedSkip(gameData.tasks, value)" :is="componentList[selectTask(gameData.tasks).component]" :game="gameData" :task="selectTask(gameData.tasks)" />
                <!-- <Link :href="route('task')">
                    <Button label="START" class='mt-10' />
                </Link> -->
            </div>
            <div class="flex gap-1 justify-center w-full">
                <button v-if="index > 0" class='mt-4 w-[100px] h-[100px] rounded-full bg-[#00A89C] text-white font-semibold flex items-center justify-center' @click="skipTask(gameData.tasks, true)">
                    See prev <br> task
                </button>

                <button v-if="index < gameData.tasks.length - 1" class='mt-4 w-[100px] h-[100px] rounded-full bg-[#00A89C] text-white font-semibold flex items-center justify-center' @click="skipTask(gameData.tasks)">
                    See next <br> task
                </button>
            </div>
        </div>
        <FlashSuccess @close="clsoeHandle" v-model="showFlash" />
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
    showFlash.value = false;
    console.log('close', showFlash.value);
}
onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const pageSize = urlParams.get('q');
    index.value = Number(pageSize);
})
const handleEmittedSkip = (tasks, val) => {
    // console.log(tasks, val);
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