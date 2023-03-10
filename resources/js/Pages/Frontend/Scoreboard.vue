<template>
    <Master  :showNavigation="true" :gameData="gameData">
        <div class="py-5 px-5 bg-[var(--fave)] h-full overflow-y-auto">
            <div class="font-bold text-xl">
                Scoreboard 
            </div>
            <div class="py-5">
                <template v-for="(team, index) in result" :key="index">
                    <div class="flex flex-wrap mt-4 myDiv">
                        <template v-for="(task, index) in gameData.tasks" :key="index">
                            <div 
                                v-if="
                                    (team.teamCode == get(getTeamAns(task.userAnswer, team.teamCode), 'team'))
                                    && get(getTeamAns(task.userAnswer, team.teamCode), 'value')
                                " 
                                class="w-full border-b"
                            >
                                <div class="flex gap-5 justify-between py-2 px-2 font-bold text-lg text-white">
                                    <div>
                                        {{ task.data.title }}
                                    </div>
                                    <span>
                                        {{ get(getTeamAns(task.userAnswer, team.teamCode), 'value') }}
                                    </span>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </Master>
</template>
<script setup>
import Master from './Master.vue'
import { isArray, forEach, sortBy, findIndex, get } from 'lodash';
import { onMounted, onUnmounted, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import { Link, usePage } from '@inertiajs/inertia-vue3'
const props = defineProps({
    gameData: Object
})

const result = ref([]);

let interValId = null
onMounted(()=>{
    generateResult()

    interValId = setInterval(() => {
        Inertia.reload({
            onSuccess() {
                generateResult()
            }
        })
    }, 5000)
})

onUnmounted(() => {
    clearInterval(interValId)
})

const generateResult = () => {
    result.value = [];
    let teams = usePage().props.value.gameData.login.team;
    forEach(teams, item => {
        let data = {
            name: item.teamName,
            point: getTotalPoint(item.teamCode, usePage().props.value.gameData.tasks),
            teamCode: item.teamCode,
            // point: Math.random() * 200,
        } 
        result.value.push(data);
    })
    console.log(result.value);
    result.value.sort((a, b) => b.point  - a.point)
}

const getTeamAns = (userAnswer, team) => { 
    let arr = isArray(userAnswer) ? userAnswer : [];
    let index = findIndex(arr, i => i.team == team);
    return arr[index];
}

const getTotalPoint = (teamCode, tasks) => {
    let tsk = isArray(tasks) ? tasks : [];
    let totalPoint = 0;
    forEach(tasks, (item) => {
        if (item.userAnswer) {
            forEach(item.userAnswer, (ans) => {
                if (ans.team == teamCode && ans.value) {
                    totalPoint += Number(ans.value);
                }
            })
        }
    });
    return totalPoint;
}

</script>

<style scoped>
.myDiv:empty::before{
    content: 'No score found!';
    color: #0005;
    font-size: 15px;
}
</style>