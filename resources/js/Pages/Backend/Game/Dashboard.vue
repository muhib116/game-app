<template>
    <Master>
        <div className="flex justify-between p-5 bg-white shadow">
            <p className="text-xl font-bold text-gray-800">{{ translate('Game Dashboard') }}</p>
        </div>
        <div class="px-5 py-5">
            <!-- game.tasks -->
            <div v-if="game.start_time" class="w-fit mx-auto bg-green-100 px-4 mt-10 rounded-lg border border-green-400 shadow-lg">
                <div class="text-xl font-black py-3">
                    {{ translate('Game start at') }}: {{ moment(game.start_time).format('D MMM YYYY H:mm:ss') }}
                </div>
                <div class="text-xl font-black py-3" v-if="game.end_time">
                    {{ translate('Game end at') }}: {{ moment(game.end_time).format('D MMM YYYY H:mm:ss') }}
                </div>
            </div>
            <template v-for="(team, index) in game.login.team" :key="index">
                <h2 class="text-xl font-extrabold my-5 mb-4 mt-10">{{ translate('Team') }}: {{ team.teamName }} ({{ getTotalPoint(team.teamCode, game.tasks) }})</h2>
                <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    <template v-for="(task, index) in game.tasks" :key="index">
                        <div class="bg-white shadow-lg rounded-md border overflow-hidden">
                            <div class="font-semibold text-center border-b py-2 bg-[#f9f9f9]">
                                {{ get(task, 'data.title') }}
                            </div>

                            <div class="p-4">
                                <div class="mb-5 flex gap-2 items-center">
                                    {{ translate('Task Status') }}: 
                                    <span v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')" class="px-3 block w-fit bg-green-100 text-green-500 font-black rounded">{{ translate('Done') }}</span>
                                    <span v-else class="px-3 block w-fit bg-red-100 text-red-500 font-black rounded">{{ translate('Pending') }}</span>
                                </div>
                                <div v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')" class="flex gap-1 mb-5">
                                    <div>
                                        <template v-if="!get(getTeamAns(task.userAnswer, team.teamCode), 'value')">
                                            <input :max="get(task, 'data.point') + get(task, 'data.extraPoint')" type="number" class="border flex-1 py-1 px-2 border-black border-opacity-10" :placeholder="`${translate('Max point')} ${get(task, 'data.point') + get(task, 'data.extraPoint')}`" />
                                            <button @click="(e) => {
                                                handleSubmit(e, game.id, task.id, team.teamCode, (task.data.point + task.data.extraPoint))
                                            }"
                                            class="py-1 px-3 bg-[var(--fave)] border border-green-400 text-white ml-1 rounded">{{ translate('Save') }}</button>
                                        </template>
                                        <span v-else>{{ get(getTeamAns(task.userAnswer, team.teamCode), 'value') }} {{ translate('Points') }}</span>
                                    </div>
                                </div>
                                
                                <div 
                                    v-if="get(task, 'data.point') || get(task, 'data.extraPoint') || get(task, 'data.deadline')" 
                                    class="mb-5"
                                >
                                    <div class="flex gap-1 flex-wrap">
                                        <span v-if="get(task, 'data.point')" class="">
                                            <span class="font-semibold">{{ translate('Point') }}: </span>
                                            {{ get(task, 'data.point') }}
                                        </span>
                                    </div>
                                    <div class="flex gap-1 flex-wrap">
                                        <span v-if="get(task, 'data.extraPoint')" class="">
                                            <span class="font-semibold">{{ translate('Extra Point') }}: </span>
                                            {{ get(task, 'data.extraPoint') }}
                                        </span>
                                    </div>
                                    <div class="flex gap-1 flex-wrap mb-5">
                                        <span v-if="get(task, 'data.deadline')">
                                            <span class="font-semibold">{{ translate('Deadline') }}: </span>
                                            {{ moment(get(task, 'data.deadline')).format('D MMM YYYY H:mm:ss') }}
                                        </span>
                                    </div>
                                </div>

                                <div 
                                    v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'start_at') || get(getTeamAns(task.userAnswer, team.teamCode), 'end_at')" 
                                    class="border-y mb-5 py-5"
                                >
                                    <div
                                        class="flex gap-1 flex-wrap"
                                    >
                                        <span v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')">
                                            <span class="font-semibold">{{ translate('Start at') }}: </span>
                                            {{ moment(get(getTeamAns(task.userAnswer, team.teamCode), 'start_at')).format('D MMM YYYY H:mm:ss') }}
                                        </span>
                                    </div>
                                    <div class="flex gap-1 flex-wrap">
                                        <span v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'end_at')">
                                            <span class="font-semibold">{{ translate('End at') }}: </span>
                                            {{ moment(get(getTeamAns(task.userAnswer, team.teamCode), 'end_at')).format('D MMM YYYY H:mm:ss') }}
                                        </span>
                                    </div>
                                </div>

                                <div v-if="task.component == 'UploadImage'">
                                    <img 
                                        v-if="get(getTeamAns(task.userAnswer, team.teamCode), 'image')"
                                        class="w-full mt-2 border rounded overflow-hidden"
                                        :src="get(getTeamAns(task.userAnswer, team.teamCode), 'image')" 
                                        alt=""
                                    >
                                </div>
                                <div v-if="task.component == 'WriteText'">
                                    <div class="font-semibold mt-2">
                                        {{ translate('Submitted answer') }}:
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
                                    <strong class="font-semibold block my-2">{{ translate('Qr code scan result') }}:</strong>
                                    <div>
                                        {{ get(getTeamAns(task.userAnswer, team.teamCode), 'result') }}
                                    </div>
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
import { translate } from '@/useLanguage';
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
            alert(translate('Invalid point'));
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
            alert(translate('Cannot submit empty value'));
        }
    }
}

</script>