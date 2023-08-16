<template>
    <div class='p-6 flex flex-col justify-between h-[100%] overflow-auto'>
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
            </label>  -->
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
            <label v-if="controlBy=='admin'" class='px-4 py-1 bg-slate-300 cursor-pointer max-w-[300px] mx-auto shadow rounded w-full relative mt-14 mb-4 flex gap-2 items-center justify-center'>
                <Preloader v-if="adminImageLoading" />
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path>
                </svg>
                {{ translate('UPLOAD IMAGE') }}
                <input @change="(e) => handleAdminImage(e.target.files[0], gamePayload.tasks, e)" type='file' :disabled="adminImageLoading" hidden accept="image/*" />
            </label>
        </div>

        <!-- <img 
            v-if="get(task, 'adminImage')"
            :src="get(task, 'adminImage')"
            alt=""
            class='w-full block mb-6 mx-auto'
        /> -->
        <img 
            v-if="get(getSelected(gamePayload.tasks), 'adminImage')"
            :src="get(getSelected(gamePayload.tasks), 'adminImage')"
            alt=""
            class='w-full block mb-6 mx-auto'
        />
        <div class="">
            <div v-if="get(isStarted(data.game, data.task), 'end_at')" class="flex justify-center">
                <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ translate('Task Completed') }}
                </span>
            </div>
            <div class="qrCode w-[100px] h-[100px] grid items center object-fill object-center mx-auto mt-10">
                <svg class='w-full h-full' width="512" height="512" viewBox="0 0 426.667 426.667"><g fill="#fdba74"><path d="M277.333 0v149.333h149.333V0H277.333zM384 106.667h-64v-64h64v64zM0 192h85.333v42.667H0zm128 0h64v42.667h-64zm64-42.667h42.667V192H192zm-42.667-64V0H0v149.333h192v-64h-42.667zm-42.666 21.334h-64v-64h64v64zM192 0h42.667v85.333H192zm106.667 234.667h42.666v64H384V192H234.667v42.667H256v42.666h42.667zm-85.334 42.666H256v64h-42.667zM384 298.667h42.667v42.667H384z" data-original="#000000"/><path data-original="#000000" d="M298.667 341.333H256V384h-42.667v42.667h85.334V384h42.666v42.667h64V384H384v-42.667h-42.667zm-149.334 0v-64H0v149.333h149.333V384h64v-42.667h-64zM106.667 384h-64v-64h64v64z"/></g><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/></svg>
            </div>
            <input class="font-bolder text-center mt-5 text-2xl border-0 w-full" type="text" v-if="controlBy=='admin'" v-model="getSelected(gamePayload.tasks).data.title">
            <h1 class="font-bolder text-center mt-5 text-2xl" v-else>
                {{ get(task, 'data.title') }}
            </h1>
        </div>
        <QrScanner @skip="$emit('skip', true)" v-model="modelValue" :game="game" :task="task" />
        
        <div class="" v-if="controlBy=='admin'">
            <textarea class="w-full border-0" rows="5" v-model="getSelected(gamePayload.tasks).data.description" placeholder="Description"></textarea>
        </div>
        <div v-else>
            <p class='text-center mb-5 max-h-[260px] overflow-y-auto'>
                {{ get(task, 'data.description') }}
            </p>
            
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

    <div class="">

        <button
            @click="handleSubmit(data.game.id, data.task.id)"
            v-if="!start"
            class="absolute bottom-4 left-4 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
        >
            {{ translate('Start task') }}
        </button>
        <button 
            v-if="!isEmpty(isStarted(data.game, data.task)) && !get(isStarted(data.game, data.task), 'end_at')" @click="modelValue=true"
            class="absolute bottom-4 p-1 left-4 z-40 w-[100px] h-[100px] !text-lg rounded-full bg-[var(--fave)] flex items-center justify-center leading-tight"
        >
            {{ translate('Scan QR') }}
        </button>
    </div>
</template>

<script setup>
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'
    import QrcodeVue from 'qrcode.vue' 
    import { onMounted, ref } from 'vue';
    import gameDrain from '@/Components/Backend/Game/gameDrain';
    import { get, find, isEmpty } from 'lodash'
    import QrScanner from '@/Components/Frontend/Popup/QrScanner.vue'
    import moment from 'moment'
    import { Inertia } from '@inertiajs/inertia';
    import { translate } from '@/useLanguage';
    import useFileUpload from '@/useFileUpload';
    
    const props = defineProps({
        controlBy: {
            type: String,
            default: null
        },
        game: {
            type: Object,
            default: {}
        },
        task: {
            type: Object,
            default: {}
        },
    });
    const { handleImageUpload, deleteImage } = useFileUpload();
    const size = ref(200);
    const value = ref('');
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
    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();
    const { saveUserData } = gameDrain();
    
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
            console.log(getSelected(tasks).adminImage);
        }
        adminImageLoading.value = false;
    }

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
            QRCodeFinder: true,
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