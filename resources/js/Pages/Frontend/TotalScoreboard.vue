<template>
    <Master  :showNavigation="true" :gameData="gameData">
        <div class="py-5 px-5 bg-[var(--fave)] h-[calc(100vh-48px)] overflow-y-auto">
            <div class="font-bold text-xl text-center">
                Total Score 
            </div>
            <div class="py-5">
                <template v-for="(team, index) in result" :key="index">
                    <div v-if="team.point > 0" class="flex justify-between py-2 px-2 font-bold text-lg" :class="index==0 ? 'text-white' : ''">
                        <div class="flex gap-3">
                            <span>{{ index+1 }}</span>
                            <span>{{ team.name }}</span>
                        </div>
                        <span>{{ team.point }}</span>
                    </div>
                </template>
                <div v-if="resultTotal == 0" class="text-black text-opacity-40 text-center">
                    No score found
                </div>
            </div>
        </div>
    </Master>
</template>
<script setup>
import Master from './Master.vue'
import { isArray, forEach } from 'lodash';
import { onMounted, ref } from 'vue'

const props = defineProps({
    gameData: Object
})

const result = ref([]);
const resultTotal = ref(0);

onMounted(()=>{
    let teams = props.gameData.login.team;
    forEach(teams, item => {
        let data = {
            name: item.teamName,
            point: getTotalPoint(item.teamCode, props.gameData.tasks),
            teamCode: item.teamCode,
        }
        resultTotal.value += data.point;
        result.value.push(data);
    })

    result.value.sort((a, b) => b.point  - a.point)
})

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