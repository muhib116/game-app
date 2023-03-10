<template>
    <div class="relative">
        <div class='p-0 text-black text-opacity-80 text-center leading-8 text-lg'>
            
            <div v-if="controlBy=='admin'" class="max-w-[500px] mx-auto">
                <label class="my-4 mt-5 flex-col flex justify-center">
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
                    <label class="my-4 mt-5 flex flex-col justify-center">
                        Point
                        <input v-model="getSelected(gamePayload.tasks).data.point" type="number" class="py-2 px-4" placeholder="Task point">
                    </label>
                    <label class="my-4 mt-5 flex flex-col justify-center">
                        Extra Point
                        <input v-model="getSelected(gamePayload.tasks).data.extraPoint" type="number" class="py-2 px-4" placeholder="Extra point">
                    </label>
                </div>
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
                <label v-if="controlBy=='admin'" class='px-4 py-1 bg-blue-300 shadow rounded w-full relative mt-14 flex items-center justify-center'>
                    <Preloader v-if="adminImageLoading" />
                    UPLOAD IMAGE
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
                
                <div v-if="get(isStarted, 'end_at') && !isEmpty(isStarted)" class="flex justify-center">
                    <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Task Completed
                    </span>
                </div>
            </div>
        </div>
    </div>
    <button
        @click="handleSubmit(data.game.id, data.task.id)"
        v-if="!isStarted && controlBy != 'admin'"
        class="absolute bottom-4 p-1 right-4 z-40 w-[100px] h-[100px] !text-2xl rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
    >
        Start task
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
                    Use another
                </template>
                <template v-else>
                    Upload Image
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
                    Submit
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
            alert('Cannot submit empty value');
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