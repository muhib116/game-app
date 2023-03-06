<template>
    <div class="relative">
        <div class='p-6 text-black text-opacity-80 leading-8 text-lg'>
            <div class="max-w-[500px] mx-auto">
                <label v-if="controlBy=='admin'" class="my-4 mt-5 flex-col flex justify-center">
                    Deadline
                    <el-date-picker
                        v-model="getSelected(gamePayload.tasks).data.deadline"
                        type="datetime"
                        placeholder="Pick a day"
                        size="large"
                        class="w-full"
                        :shortcuts="[{
                            text: 'Today',
                            value: new Date(),
                        }]"
                    />
                </label>
                <div class="grid gap-2 grid-cols-1 md:grid-cols-2">
                    <label v-if="controlBy=='admin'" class="my-4 mt-5 flex flex-col justify-center">
                        Point
                        <input v-model="getSelected(gamePayload.tasks).data.point" type="number" class="py-2 px-4" placeholder="Task point">
                    </label>
                    <label v-if="controlBy=='admin'" class="my-4 mt-5 flex flex-col justify-center">
                        Extra Point
                        <input v-model="getSelected(gamePayload.tasks).data.extraPoint" type="number" class="py-2 px-4" placeholder="Extra point">
                    </label>
                </div>
            </div>
            <div class='text-black text-opacity-80'>
                <input 
                    v-if="controlBy=='admin'" 
                    v-model="getSelected(gamePayload.tasks).data.title"
                    type="text" placeholder="Title"
                    class="w-full border-0 text-center"
                />
                <h3 v-else class='font-semi-bold text-2xl mb-2 text-center'>{{ task.data.title }}</h3>
                <textarea v-if="controlBy=='admin'" class="w-full border-0" rows="5" v-model="getSelected(gamePayload.tasks).data.description" placeholder="Description"></textarea>
                <p v-else class="text-center border-0 w-full">{{ task.data.description }}</p>
            </div> 
            <div class='grid gap-5 mt-16' v-if="controlBy=='admin'">
                <template v-for="(item, index) in getSelected(gamePayload.tasks).data.options" :key="index">
                    <label class='flex gap-4 text-sm items-center'>
                        <input 
                            type="checkbox" 
                            v-model="item.isChecked"
                            :checked="item.isChecked"
                        />
                        <div class="w-full md:w-1/2 flex justify-between">
                            <input class="border border-slate-300 py-0 px-2 w-full" type="text" v-model="item.name" placeholder="Add Text">
                            <button @click="removeOption(getSelected(gamePayload.tasks).data.options, index)" class="bg-red-500 text-white w-8 h-8">x</button>
                        </div>
                    </label>
                </template>

                <button
                    @click="addOption(getSelected(gamePayload.tasks).data.options)" 
                    class="p-1 bg-yellow-500 text-white text-sm inline-block max-w-[100px]"
                >
                    Add option
                </button>
            </div>
            <div class='grid gap-5 mt-16' v-else>
                <template v-for="(item, index) in task.data.options" :key="index"> 
                    <label class='flex gap-4 text-sm items-center' v-if="!get(isStarted(data.game, data.task), 'end_at') && start">
                        <input 
                            type="checkbox" 
                            v-model="item.teamAnswer"
                        />
                        {{ item.name }}
                    </label>
                </template>
            </div> 
            
            <div class="text-left w-full py-4">
                    <div class="font-bold" v-if="controlBy!='admin' && get(task, 'data.deadline')">
                        Deadline: 
                        {{ moment(get(task, 'data.deadline')).format('D MMM YYYY H:mm:ss') }}
                    </div>
                    <div class="font-bold" v-if="controlBy!='admin' && get(task, 'data.point')">
                        Points: 
                        {{ get(task, 'data.point') }}
                    </div>
                    <div class="font-bold" v-if="controlBy!='admin' && get(task, 'data.extraPoint')">
                        Extra point: 
                        {{ get(task, 'data.extraPoint') }}
                    </div>
                </div>
            <template v-if="!get(isStarted(data.game, data.task), 'end_at')">
                <button
                    @click="handleSubmit(data.game.id, data.task.id)"
                    v-if="!start && controlBy != 'admin'"
                    class="py-1 px-4 mb-4 mt-2 bg-[var(--fave)] rounded"
                >
                    Start task
                </button>
                <Button 
                    v-if="controlBy!='admin' && !isEmpty(isStarted(data.game, data.task)) && !get(isStarted(data.game, data.task), 'end_at')" 
                    label="Submit Task" 
                    class='mt-14' 
                    @click="handleSave(game.id, task.id)"
                />
            </template> 
            <div v-if="get(isStarted(data.game, data.task), 'end_at')" class="flex justify-center">
                <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Task Completed
                </span>
            </div>
        </div>
    </div>
    <!-- <FlashScreen @close="showFlash=false" v-model="showFlash" /> -->
</template>

<script setup>
    import gameDrain from '@/Components/Backend/Game/gameDrain';
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'
    import { computed, onMounted, ref } from 'vue';
    import { get, find, isEmpty } from 'lodash'
    import FlashScreen from '../Popup/FlashScreen.vue';
    import FlashSuccess from '../Popup/FlashSuccess.vue';
import { Inertia } from '@inertiajs/inertia';

import moment from 'moment'
    const { gamePayload } = useConnfiguration();
    const { getSelected, addOption } = useTaskCreate();
    const { saveUserData } = gameDrain();
    
    const props = defineProps({
        controlBy: {
            type: String,
            default: null
        }, 
        task: {
            type: Object,
            default: {}
        },
        game: {
            type: Object,
            default: {}
        },
    })
    const showFlash = ref(true)
    // const data = ref({
    //     task: {},
    //     game: false
    // })
    const data = computed(()=>{ 
        return {
            game: props.game,
            task: props.task
        }
    })
    const start = ref(false)
    const emit = defineEmits(['skip'])

    const removeOption = (options, index) => {
        options.splice(index, 1)
    }
    // onMounted(()=>{
    //     data.value.game = props.game;
    //     data.value.task = props.task;
    // })

    
    const handleSave = async (gameId, taskId) => {
        if (confirm('Are you sure?')) {
            const responseData = await saveUserData({
                Quiz: true,
                id: gameId,
                taskId: taskId,
                answer: get(props, 'task.data.options'),
            });
            if (responseData.status == "success") {
                // window.location.reload();
            }
            if (get(responseData, 'status') == 'success') {
                let task = find(responseData.game.tasks, item => item.id == props.task.id)
                start.value = true;
                data.value.game = responseData.game
                data.value.task = task
                emit('skip', true)
            }
        }
    }

    
    const isStarted = (game, task) => {
        if (!game.session) return; 
        let answer = find(task.userAnswer, item => {
            return item.team == game.session.team && game.ip == item.ip && item.task_id == task.id;
        })
        if (answer) {
            start.value=true
        } else {
            start.value=false
        }
        return answer;
    }
    const handleSubmit = async (gameId, taskId) => {
        const responseData = await saveUserData({
            Quiz: true,
            id: gameId,
            taskId: taskId,
            startTime: true,
        });

        if (get(responseData, 'status') == 'success') {
            let task = find(responseData.game.tasks, item => item.id == props.task.id)
            start.value = true;
            data.value.game = responseData.game
            data.value.task = task
            Inertia.reload();
        }
    }

</script>

<style lang="scss" scoped>

</style>