<template>
    <div class="relative">
        <div class='p-6 text-black text-opacity-80 leading-8 text-lg'>
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
            <label v-if="controlBy=='admin'" class='px-4 py-1 bg-slate-300 cursor-pointer max-w-[300px] mx-auto shadow rounded w-full relative mt-14 mb-4 flex gap-2 items-center justify-center'>
                <Preloader v-if="adminImageLoading" />
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path>
                </svg>
                {{ translate('UPLOAD IMAGE') }}
                <input @change="(e) => handleAdminImage(e.target.files[0], gamePayload.tasks, e)" type='file' :disabled="adminImageLoading" hidden accept="image/*" />
            </label>

            <div v-if="get(isStarted(data.game, data.task), 'end_at')" class="flex justify-center mb-4">
                <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ translate('Task Completed') }}
                </span>
            </div>
            
            <img 
                v-if="get(getSelected(gamePayload.tasks), 'adminImage')"
                :src="get(getSelected(gamePayload.tasks), 'adminImage')" 
                alt=""
                class='w-full block mb-6 mx-auto'
            />

            <div class='text-black text-opacity-80'>
                <input 
                    v-if="controlBy=='admin'" 
                    v-model="getSelected(gamePayload.tasks).data.title"
                    type="text" :placeholder="translate('Title')"
                    class="w-full border-0 text-center"
                />
                <h3 v-else class='font-semi-bold text-2xl mb-2 text-center'>{{ task.data.title }}</h3>
                <textarea v-if="controlBy=='admin'" class="w-full border-0" rows="5" v-model="getSelected(gamePayload.tasks).data.description" :placeholder="translate('Description')"></textarea>
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
                    class="p-1 bg-yellow-500 text-white text-sm inline-block max-w-[200px]"
                >
                    {{ translate('Add option') }}
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
                        {{ translate('Deadline') }}: 
                        {{ moment(get(task, 'data.deadline')).format('D MMM YYYY H:mm') }}
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
            
        </div>
    </div>
    <!-- <FlashScreen @close="showFlash=false" v-model="showFlash" /> -->

    <template v-if="!get(isStarted(data.game, data.task), 'end_at')">
        <button
            @click="handleSubmit(data.game.id, data.task.id)"
            v-if="!start && controlBy != 'admin'"
            class="absolute bottom-4 left-4 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-sm"
        >
            {{ translate('Start task') }}
        </button>
        <button 
            v-if="controlBy!='admin' && !isEmpty(isStarted(data.game, data.task)) && !get(isStarted(data.game, data.task), 'end_at')" 
            class='absolute bottom-4 px-1 left-4 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight' 
            @click="handleSave(game.id, task.id)"
        >
            {{ translate('Submit Task') }}
        </button>
    </template>
</template>

<script setup>
    import gameDrain from '@/Components/Backend/Game/gameDrain';
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'
    import { computed, onMounted, ref } from 'vue';
    import { get, find, isEmpty } from 'lodash' 
    import { Inertia } from '@inertiajs/inertia';

    import moment from 'moment'
    import { translate } from '@/useLanguage';
    import useFileUpload from '@/useFileUpload';

    const { handleImageUpload, deleteImage } = useFileUpload();
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

    const adminImageLoading = ref(false)
    const handleAdminImage = async (file, tasks, event) => {
        adminImageLoading.value = true;
        const response = await handleImageUpload(file);
        adminImageLoading.value = false;
        file=null
        event.target.value = null;
        if (response.status == 'error') {
            console.log('error');
        }
        if (response.status == 'success') {
            let old = getSelected(tasks).adminImage;
            if (old) {
                deleteImage(old);
            }
            getSelected(tasks).adminImage = response.path;
        }
        adminImageLoading.value = false;
    }

    
    const handleSave = async (gameId, taskId) => {
        if (confirm(translate('Are you sure?'))) {
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