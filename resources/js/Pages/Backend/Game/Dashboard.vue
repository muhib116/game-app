<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Game Dashboard</p>
        </div>
        <div class="px-5 py-5">
            <!-- game.tasks -->
            <div v-if="game.start_time">
                <div class="text-xl font-black py-3">
                    Game start at: {{ moment(game.start_time).format('D MMM YYYY H:mm:ss') }}
                </div>
                <div class="text-xl font-black py-3" v-if="game.end_time">
                    Game end at: {{ moment(game.end_time).format('D MMM YYYY H:mm:ss') }}
                </div>
            </div>
            <template v-for="(team, index) in game.login.team" :key="index">
                <h2 class="text-3xl font-extrabold my-5">Team: {{ team.teamName }} ({{ getTotalPoint(team.teamCode, game.tasks) }})</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <template v-for="(task, index) in game.tasks" :key="index">
                        <div class="py-2 px-4 bg-white shadow-md rounded-md">
                            <div class="font-bold text-center border-b mb-3 py-2">
                                {{ get(task, 'data.title') }}
                            </div>
                            <div v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')">
                                <span class="px-3 bg-green-200">Done</span>
                            </div>
                            <div v-else>
                                <span class="px-3 bg-red-200">Pending</span>
                            </div>
                            <div v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')" class="flex gap-1 my-5">
                                <div>
                                    <template v-if="!get(getTeamAns(task.userAnswer, team.teamCode), 'value')">
                                        <input :max="get(task, 'data.point') + get(task, 'data.extraPoint')" type="number" class="border flex-1 py-1 px-2 border-gray-600" :placeholder="`Max point ${get(task, 'data.point') + get(task, 'data.extraPoint')}`" />
                                        <button @click="(e) => {
                                            handleSubmit(e, game.id, task.id, team.teamCode, task.data.point)
                                        }" class="py-1 px-2 bg-[var(--fave)] border border-green-400">Save</button>
                                    </template>
                                    <span v-else>{{ get(getTeamAns(task.userAnswer, team.teamCode), 'value') }} Points</span>
                                </div>
                            </div>
                            <div class="flex gap-1 flex-wrap">
                                <span v-if="get(task, 'data.point')" class="">
                                    <span>Point: </span>
                                    {{ get(task, 'data.point') }}
                                </span>
                            </div>
                            <div class="flex gap-1 flex-wrap">
                                <span v-if="get(task, 'data.point')" class="">
                                    <span>Extra Point: </span>
                                    {{ get(task, 'data.extraPoint') }}
                                </span>
                            </div>
                            <div class="flex gap-1 flex-wrap mb-5">
                                <span v-if="get(task, 'data.deadline')" class="font-bold">
                                    <span>Deadline: </span>
                                    {{ moment(get(task, 'data.deadline')).format('D MMM YYYY H:mm:ss') }}
                                </span>
                            </div>
                            <div class="flex gap-1 flex-wrap">
                                <span v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')">
                                    <span>Start at: </span>
                                    {{ moment(get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')).format('D MMM YYYY H:mm:ss') }}
                                </span>
                            </div>
                            <div class="flex gap-1 flex-wrap">
                                <span v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'end_at')">
                                    <span>End at: </span>
                                    {{ moment(get(getTeamAns(task.userAnswer, team.teamCode), 'end_at')).format('D MMM YYYY H:mm:ss') }}
                                </span>
                            </div>

                            <div v-if="task.component == 'UploadImage'">
                                <img class="w-full mt-2" :src="get(getTeamAns(task.userAnswer, team.teamCode), 'image')" alt="">
                            </div>
                            <div v-if="task.component == 'WriteText'">
                                <div class="font-semibold mt-2">
                                    Submited answer:
                                </div>
                                <div class="pt-2">
                                    {{ get(getTeamAns(task.userAnswer, team.teamCode), 'answer') }}
                                </div>
                            </div>
                            <div v-if="task.component == 'Quiz'">
                                <div v-if="isArray(get(getTeamAns(task.userAnswer, team.teamCode), 'userOptions'))" class="pt-4">
                                    <span class="text-black">User answer</span>
                                    <template v-for="(item, index) in get(getTeamAns(task.userAnswer, team.teamCode), 'userOptions')" :key="index">
                                        <label class='flex gap-4 text-sm items-center'>
                                            <input type="checkbox" v-model="item.teamAnswer" disabled />
                                            {{ item.name }}
                                        </label>
                                    </template>
                                </div>
                            </div>
                            <div v-if="task.component == 'QRCodeFinder'">
                                <strong class="font-semibold block my-2">Qr code scan result:</strong>
                                <div>
                                    {{ get(getTeamAns(task.userAnswer, team.teamCode), 'result') }}
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </Master>
</template>

<script setup>
import Master from '../Master.vue'
import { get, isArray, findIndex, isElement, forEach } from 'lodash'
import moment from 'moment'
import gameDrain from '@/Components/Backend/Game/gameDrain';
const { saveUserData } = gameDrain();

defineProps({
    game: Object,
});

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
                if (ans.team == teamCode) {
                    if (ans.value) {
                        totalPoint += Number(ans.value);
                    }
                }
            })
        }
    });
    return totalPoint;
}

const handleSubmit = async (e, gameId, taskId, teamCode, point) => {
    let elem = get(e, 'target.parentElement');
    if (isElement(elem)) {
        let value = elem.querySelector('input').value;
        if (Number(value) > Number(point)) {
            alert('Invalid point');
            return;
        }

        if (value) {
            const data = await saveUserData({
                writeText: true,
                id: gameId,
                taskId: taskId,
                teamCode: teamCode,
                value: value
            });
            if (data.status == "success") {
                window.location.reload();
            }
        } else {
            alert('Cannot submit empty value');
        }
    }
}

</script>