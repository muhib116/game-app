<template>
    <div>
        <div class="max-w-[500px] mx-auto">
                <label v-if="controlBy=='admin'" class="my-4 mt-5 flex-col flex justify-center">
                    {{ translate('Deadline') }}
                    <input type="datetime-local" v-model="getSelected(gamePayload.tasks).data.deadline" class="border-slate-400 rounded">
                </label>
                <!-- <label v-if="controlBy=='admin'" class="my-4 mt-5 flex-col flex justify-center">
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
                </label> -->
                <div class="grid gap-2 grid-cols-1 md:grid-cols-2">
                    <label v-if="controlBy=='admin'" class="my-4 mt-5 flex flex-col justify-center">
                        {{ translate('Point') }}
                        <input v-model="getSelected(gamePayload.tasks).data.point" type="number" class="py-2 px-4" :placeholder="translate('Task point')">
                    </label>
                    <label v-if="controlBy=='admin'" class="my-4 mt-5 flex flex-col justify-center">
                        {{ translate('Extra Point') }}
                        <input v-model="getSelected(gamePayload.tasks).data.extraPoint" type="number" class="py-2 px-4" :placeholder="translate('Extra point')">
                    </label>
                </div>
            </div>
        <div className='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>

            <input
                v-model="getSelected(gamePayload.tasks).data.title"
                v-if="controlBy=='admin'"
                class="font-semi-bold text-2xl mb-2 border-0 w-full text-center"
                type="text"
            />
            <h3 v-else className='font-semi-bold text-2xl mb-2'>{{ task.data.title }}</h3>

            <textarea v-if="controlBy=='admin'" class="w-full border-0" rows="5" v-model="getSelected(gamePayload.tasks).data.description" :placeholder="translate('Description')"></textarea>

            <p v-else>{{ task.data.description }}</p>
            <div class="text-left w-full py-4">
                <div class="font-bold" v-if="controlBy!='admin' && get(task, 'data.deadline')">
                    {{ translate('Deadline') }}: 
                    {{ moment(get(task, 'data.deadline')).format('D MMM YYYY H:mm:ss') }}
                </div>
                <div class="font-bold" v-if="controlBy!='admin' && get(task, 'data.point')">
                    {{ translate('Points') }}: 
                    {{ get(task, 'data.point') }}
                </div>
                <div class="font-bold" v-if="controlBy!='admin' && get(task, 'data.extraPoint')">
                    {{ translate('Extra point') }}: 
                    {{ get(task, 'data.extraPoint') }}
                </div>
            </div>
            <template v-if="controlBy!='admin'">
                <div v-if="get(isStarted, 'end_at') && !isEmpty(isStarted)" class="flex justify-center">
                    <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ translate('Task Completed') }}
                    </span>
                </div>
                <TextWritePopup @skip="$emit('skip', true)" v-model="modelValue" :task="data.task" :game="data.game" />
            </template>
        </div>
    </div>

    <button
        @click="handleSubmit(data.game.id, data.task.id)"
        v-if="isEmpty(isStarted)"
        class="absolute bottom-4 left-4 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
    >
        {{ translate('Start task') }}
    </button>

    <button 
        @click="modelValue=true" 
        v-if="!isEmpty(isStarted) && !get(isStarted, 'end_at')" 
        class="absolute bottom-4 left-4 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
    >
        {{ translate('Write in text') }}
    </button>
</template>

<script setup>
    import { computed, onMounted, onUpdated, ref } from 'vue';
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'
    import useDataSource from "@/Pages/Frontend/useDataSource"
    import TextWritePopup from '../Popup/TextWritePopup.vue';
    import gameDrain from '@/Components/Backend/Game/gameDrain';
    import { get, find, isEmpty } from 'lodash'
import { Inertia } from '@inertiajs/inertia';
    import moment from 'moment'
import { translate } from '@/useLanguage';

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
            default: false,
        }
    });
    const { saveUserData } = gameDrain();
    
    const modelValue = ref(false); 

    const data = ref({
        task: {},
        game: false
    })

    onMounted(()=>{
        data.value.game = props.game;
        data.value.task = props.task;
    })
    onUpdated(()=>{
        data.value.game = props.game;
        data.value.task = props.task;
        // console.log('updated');
    })

    const { saveGame } = gameDrain();
    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();
    const { taskData } = useDataSource()

    const isStarted = computed(() => {
        let game = props.game;
        let task = props.task
        let answer = find(task.userAnswer, item => {
            return item.team == game.session.team && game.ip == item.ip;
        })
        return answer;
    })

    const handleSubmit = async (gameId, taskId) => {
        const responseData = await saveUserData({
            writeText: true,
            id: gameId,
            taskId: taskId,
            startTime: true,
        });

        if (get(responseData, 'status') == 'success') {
            let task = find(responseData.game.tasks, item => item.id == props.task.id)
            data.value.game = responseData.game
            data.value.task = task
            Inertia.reload();
            // window.location.reload();
            // console.log('inConsole', task);
        }
    }

</script>