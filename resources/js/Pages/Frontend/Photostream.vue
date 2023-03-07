<template>
    <Master  :showNavigation="true" :gameData="gameData">
        <div class="py-5 px-5 bg-[var(--fave)] h-[calc(100vh-48px)] overflow-y-auto">
            <div class="font-bold text-xl">
                Photo Stream 
            </div>

            <div class="py-5" v-if="get(gameData, 'login.photoStream')">
                <template v-for="(team, index) in result" :key="index">
                    <div class="myDiv grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                        <img v-if="team.image" :src="team.image" alt="">
                    </div>
                </template>
            </div>
        </div>
    </Master>
</template>
<script setup>
import Master from './Master.vue'
import { isArray, forEach, sortBy, findIndex, get } from 'lodash';
import { onMounted, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import { Link, usePage } from '@inertiajs/inertia-vue3'
const props = defineProps({
    gameData: Object
})

const result = ref([]);


onMounted(()=>{
    generateResult()
})

const generateResult = () => {
    result.value = [];
    let tasks = usePage().props.value.gameData.tasks;
    forEach(tasks, item => {
        if (item.component == "UploadImage") {
            forEach(item.userAnswer, ans => {
                console.log(ans);
                result.value.push(ans);
            })
        }
    })
}


</script>

<style scoped>
.myDiv:empty::before{
    content: 'No photo found!';
    color: #0005;
    font-size: 15px;
}
</style>