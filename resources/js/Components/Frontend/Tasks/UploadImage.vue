<template>
    <div class="relative">
        <div class='p-0 text-black text-opacity-80 text-center leading-8 text-lg'>
            
            <div v-if="controlBy=='admin'" class="max-w-[500px] mx-auto">
                <label class="my-4 mt-5 flex-col flex justify-center">
                    {{ translate('Deadline') }}
                    <input type="datetime-local" v-model="getSelected(gamePayload.tasks).data.deadline" class="border-slate-400 rounded">
                </label>
                <!-- <el-date-picker
                    v-model="getSelected(gamePayload.tasks).data.deadline"
                    type="datetime"
                    placeholder="Pick a day"
                    size="large"
                    class="w-full"
                    :shortcuts="[{
                        text: 'Today',
                        value: new Date(),
                    }]"
                /> -->
                
                <div class="grid gap-2 grid-cols-1 md:grid-cols-2">
                    <label class="my-4 mt-5 flex flex-col justify-center">
                        {{ translate('Point') }}
                        <input v-model="getSelected(gamePayload.tasks).data.point" type="number" class="py-2 px-4 border-slate-400 rounded" :placeholder="translate('Task point')">
                    </label>
                    <label class="my-4 mt-5 flex flex-col justify-center">
                        {{ translate('Extra Point') }}
                        <input v-model="getSelected(gamePayload.tasks).data.extraPoint" type="number" class="py-2 px-4 border-slate-400 rounded" :placeholder="translate('Extra point')">
                    </label>
                </div>
            </div>

            <div v-if="get(isStarted, 'end_at') && !isEmpty(isStarted)" class="flex justify-center mt-6">
                <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ translate('Task Completed') }}
                </span>
            </div>
            
            <h3 v-if="controlBy!='admin'" class='font-semi-bold text-2xl py-4 font-bold'>
                {{ get(task, 'data.title') }}
            </h3>
            
            <img 
                v-if="controlBy=='admin'"
                :src='getSelected(gamePayload.tasks).adminImage' 
                alt=""
                class='w-full block mb-6 max-w-[300px] mx-auto'
            />
            <template v-else>
                <img v-if="imgLink" :src="imgLink" class="w-full" alt="">
                <img
                    v-else
                    :src="get(task, 'adminImage')" 
                    alt=""
                    class='w-full block mb-6'
                />
            </template>
            
            <div class="px-5">
                <label v-if="controlBy=='admin'" class='px-4 py-1 bg-slate-300 cursor-pointer max-w-[300px] mx-auto shadow rounded w-full relative mt-14 mb-4 flex gap-2 items-center justify-center'>
                    <Preloader v-if="adminImageLoading" />
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path>
                    </svg>
                    {{ translate('UPLOAD IMAGE') }}
                    <input @change="(e) => handleAdminImage(e.target.files[0], gamePayload.tasks, e)" type='file' :disabled="adminImageLoading" hidden accept="image/*" />
                </label>
                <div class='text-black text-opacity-80'>
                    <div v-if="controlBy=='admin'">
                        <input
                            type="text"
                            class='font-semi-bold text-2xl mb-2 border-0 w-full text-center'
                            placeholder="Game title"
                            v-model="getSelected(gamePayload.tasks).data.title"
                        />
                    </div>
                    
                    <textarea v-if="controlBy=='admin'" class="w-full border-0" rows="5" v-model="getSelected(gamePayload.tasks).data.description" placeholder="Description"></textarea>
                    <p v-else>{{ get(task, 'data.description') }}</p>
                </div>
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
                
                
            </div>
        </div>
    </div>
    <button
        @click="handleSubmit(data.game.id, data.task.id)"
        v-if="!isStarted && controlBy != 'admin'"
        class="absolute bottom-4 p-1 right-4 z-40 w-[100px] h-[100px] !text-2xl rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
    >
        {{ translate('Start task') }}
    </button>

    <div 
        class="absolute left-4 bottom-4 z-40 flex gap-5"
        :class="isLastTask ? 'right-4 justify-between' : ''"
    >
        <div v-if="!isEmpty(isStarted) && !get(isStarted, 'end_at')">
                    
            <label v-if="controlBy!='admin'" 
                class="p-2 cursor-pointer left-4 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
            >
                <Preloader v-if="adminImageLoading" />
                <template v-if="imgLink">
                    {{ translate('Use another') }}
                </template>
                <template v-else>
                    {{ translate('Upload Image') }}
                </template>
                <input @change="(e) => handleUpload(e.target.files[0])" type='file' hidden accept="image/*" />
            </label>
        </div>
    
        <template v-if="controlBy!='admin'">
            <div>
                <button 
                    v-if="isStarted && !get(isStarted, 'end_at')"
                    @click="handleSave(game.id, task.id)" 
                    class="p-1 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
                >
                    {{ translate('Submit') }}
                </button>
            </div>
        </template>
    </div>
</template>

<script setup>
    import useTaskCreate from "@/Components/Backend/Game/useTaskCreate";
    import useConnfiguration from "@/Components/Backend/Game/useConnfiguration";
    import { get, find, isEmpty } from 'lodash' 
    import gameDrain from "@/Components/Backend/Game/gameDrain";
    import useFileUpload from '@/useFileUpload';
    import Preloader from "@/Components/Global/Preloader.vue";
    import { onMounted, ref, computed } from 'vue'
    import moment from "moment";
    import { Inertia } from "@inertiajs/inertia";
    import VueDatePicker from '@vuepic/vue-datepicker';
    import '@vuepic/vue-datepicker/dist/main.css'
import { translate } from "@/useLanguage";

    const { saveUserData } = gameDrain();
    const { handleImageUpload, deleteImage } = useFileUpload();
    const imgLink = ref(false); 

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
        isLastTask: {
            type: Boolean,
            default: false
        }
    });
    const start = ref(false)

    const data = ref({
        task: {},
        game: false
    })

    onMounted(()=>{
        data.value.game = props.game;
        data.value.task = props.task;
    })
    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();

    const adminImageLoading = ref(false);
    const inputFile = ref(null)
    const emit = defineEmits(['skip'])
    const handleAdminImage = async (file, tasks, event) => {
        adminImageLoading.value = true;
        const response = await handleImageUpload(file);
        adminImageLoading.value = false;
        file=null
        event.target.value = null;
        console.log(event.target.value);
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
    const handleUpload = async (file, e) => {
        inputFile.value = file;
        const dataUrl = URL.createObjectURL(file)
        imgLink.value = dataUrl;
    }

    const handleSave = async (gameId, taskId) => { 
        const response = await handleImageUpload(inputFile.value);
        if (response.path) {
            const responseData = await saveUserData({
                UploadImage: true,
                id: gameId,
                taskId: taskId,
                image: response.path,
            });
            if (get(responseData, 'status') == 'success') {
                
                let task = find(responseData.game.tasks, item => item.id == props.task.id)
                start.value = true;
                data.value.game = responseData.game
                data.value.task = task
                imgLink.value = null;
                emit('skip', true)
            }
        } else {
            alert(translate('Cannot submit empty value'));
        }
    }

    const isStarted = computed(() => {
        let game = props.game;
        let task = props.task
        
        let answer = find(task.userAnswer, item => {
            return item.team == game.session.team && game.ip == item.ip;
        })
        return answer;
    })    
    // const isStarted = (game, task) => {
    //     let answer = find(task.userAnswer, item => {
    //         return item.team == game.session.team && game.ip == item.ip;
    //     })

    //     if (answer) {
    //         start.value=true
    //     }
        
    //     return answer;
    // }

    const handleSubmit = async (gameId, taskId) => {
        const responseData = await saveUserData({
            UploadImage: true,
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
    

    const settings = {
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    }
</script>

<style lang="scss" scoped>

</style>