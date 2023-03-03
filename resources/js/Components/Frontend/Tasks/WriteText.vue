<template>
    <div className="relative">
        <div class="max-w-[500px] mx-auto">
                <label v-if="controlBy=='admin'" class="my-4 mt-5 flex-col flex justify-center">
                    Deadline
                    <el-date-picker
                        v-model="getSelected(gamePayload.tasks).data.deadline"
                        type="date"
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
        <div className='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
            <!-- <img 
                src='https://plus.unsplash.com/premium_photo-1664100478021-c3b6599f0d7b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxOXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60' 
                alt=""
                className='w-full block mb-6'
            /> -->
            <input
                v-model="getSelected(gamePayload.tasks).data.title"
                v-if="controlBy=='admin'"
                class="font-semi-bold text-2xl mb-2 border-0 w-full text-center"
                type="text"
            />
            <h3 v-else className='font-semi-bold text-2xl mb-2'>{{ task.data.title }}</h3>
            <!-- <input 
                v-model="getSelected(gamePayload.tasks).data.description"
                v-if="controlBy=='admin'"
                type="text"
                class="border-0 text-center"
            /> -->
            <textarea v-if="controlBy=='admin'" class="w-full border-0" rows="5" v-model="getSelected(gamePayload.tasks).data.description" placeholder="Description"></textarea>

            <p v-else>{{ task.data.description }}</p>
            <template v-if="controlBy!='admin'">
                <div v-if="get(isStarted(data.game, data.task), 'end_at') && !isEmpty(isStarted(data.game, data.task))" class="flex justify-center">
                    <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Task Completed
                    </span>
                </div>
                <button
                    @click="handleSubmit(data.game.id, data.task.id)"
                    v-if="!start"
                    class="py-1 px-4 mb-4 mt-2 bg-[var(--fave)] rounded"
                >
                    Start task
                </button>
                <Button @click="modelValue=true" v-if="!isEmpty(isStarted(data.game, data.task)) && !get(isStarted(data.game, data.task), 'end_at')" label="WRITE IN TEXT" class="mt-14 border" />
                <TextWritePopup v-model="modelValue" :task="data.task" :game="data.game" />
            </template>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, ref } from 'vue';
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'
    import useDataSource from "@/Pages/Frontend/useDataSource"
    import TextWritePopup from '../Popup/TextWritePopup.vue';
    import gameDrain from '@/Components/Backend/Game/gameDrain';
    import { get, find, isEmpty } from 'lodash'

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
    const start = ref(false)

    const data = ref({
        task: {},
        game: false
    })

    onMounted(()=>{
        data.value.game = props.game;
        data.value.task = props.task;
    })

    const { saveGame } = gameDrain();
    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();
    const { taskData } = useDataSource()

    const isStarted = (game, task) => {
        let answer = find(task.userAnswer, item => {
            return item.team == game.session.team && game.ip == item.ip;
        })
        if (answer) {
            start.value=true
        }
        return answer;
    }

    const handleSubmit = async (gameId, taskId) => {
        const responseData = await saveUserData({
            writeText: true,
            id: gameId,
            taskId: taskId,
            startTime: true,
        });

        if (get(responseData, 'status') == 'success') {
            let task = find(responseData.game.tasks, item => item.id == props.task.id)
            start.value = true;
            data.value.game = responseData.game
            data.value.task = task
        }
    }

</script>