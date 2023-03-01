<template>
    <Master  :showNavigation="true" :gameData="gameData">
        <div class="py-5 px-5 bg-[var(--themeColor)] h-[calc(100vh-48px)] overflow-y-auto">
            <div class="font-bold text-xl">
                Scoreboard 
            </div>
            <div class="py-5">
                <template v-for="(team, index) in result" :key="index">
                    <div class="flex justify-between py-2 px-2" :class="index==0 ? 'bg-white' : ''">
                        <div class="flex gap-3">
                            <span>{{ index+1 }}</span>
                            <span>{{ team.name }}</span>
                        </div>
                        <span>{{ team.point }}</span>
                    </div> 
                </template>
                <!-- <div class="flex justify-between py-2 px-2 border-b border-slate-500/50">
                    <div class="flex gap-3">
                        <span>2</span>
                        <span>Susan</span>
                    </div>
                    <span>15,225</span>
                </div> -->
            </div>
        </div>
    </Master>
</template>
<script setup>
import Master from './Master.vue'
import { isArray, forEach, sortBy } from 'lodash';
import { onMounted, ref } from 'vue'

const props = defineProps({
    gameData: Object
})

const result = ref([]);

onMounted(()=>{
    let teams = props.gameData.login.team;
    forEach(teams, item => {
        let data = {
            name: item.teamName,
            point: getTotalPoint(item.teamCode, props.gameData.tasks),
            // point: Math.random() * 200,
        }
        result.value.push(data);
    })

    result.value.sort((a, b) => b.point  - a.point)
})

const getTeamAns = (userAnswer, team) => {
    // console.log(userAnswer, team);
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