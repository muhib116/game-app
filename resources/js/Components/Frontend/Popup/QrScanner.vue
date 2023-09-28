<template>
    <div v-if="modelValue" class="fixed top-0 left-0 right-0 bottom-0 grid items-center justify-center bg-white/50 bg-opacity-50 backdrop-blur-md z-50">
        <i 
            @click="() => {
                $emit('update:modelValue', false);
                camera = false
            }" 
            class="fa-solid exit fa-xmark absolute top-4 right-4 text-4xl cursor-pointer hover:text-red-600"
        ></i>
        <div>
            <p v-if="initError" class=" text-center mt-2 text-white py-2 px-4 w-full text-lg font-bold bg-red-500">
                {{ initError }}
            </p>
            
            <div class="grid justify-center">
                <button 
                    class="py-2 px-4 bg-black text-white rounded"
                    @click="switchCamera"
                >
                    {{ translate('Switch camera') }}
                </button>
                <qrcode-stream :camera="selectedCamera" @decode="onDecode" @init="onInit" class="border border-slate-400 mt-4">
                    <div v-show="showScanConfirmation"></div>
                </qrcode-stream>
            </div>
            <p v-if="result" class="decode-result text-center mt-4">{{ translate('Last result') }}: <b>{{ result }}</b></p>
            <div>
                <p class=" text-center mt-2 text-white py-2 px-4 w-full text-lg font-bold" :class="status[apiResponse.type]">
                    {{ apiResponse.message }}
                </p>
            </div>
            <div v-if="!isEmpty(content)" class="flex flex-col justify-center">
                <p><strong>{{ translate('Wr code result is') }}: </strong>{{ content }}</p>
                <button @click="handleSave(game.id, task.id)" class="mt-4 py-1.5 px-5 bg-green-600 text-white rounded">{{ translate('Submit') }}</button>
            </div>
            <!-- task.id -->
            <!-- <audio ref="errorAudioElement">
                <source :src="errorAudio" type="audio/ogg" />
            </audio>
            
            <audio ref="successAudioElement">
                <source :src="successAudio" type="audio/mp3" />
            </audio> -->
        </div>
    </div>
</template>

<script setup>
    import axios from 'axios'
    import { ref, onMounted } from 'vue'
    // import errorAudio from '@/assets/audio/error.ogg'
    // import successAudio from '@/assets/audio/success.mp3'
    import { isEmpty } from 'lodash'
    import gameDrain from '@/Components/Backend/Game/gameDrain';
import { translate } from '@/useLanguage';
    const { saveUserData } = gameDrain();

    const props = defineProps({
        isCameraOpen: Boolean,
        modelValue: {
            type: Boolean,
            default: false
        },
        game: {
            type: Object,
            default: {}
        },
        task: {
            type: Object,
            default: {}
        },
    })
    const result = ref('');
    const camera = ref(props.isCameraOpen);
    const selectedCamera = ref('rear');
    const showScanConfirmation = ref(false);
    const apiResponse = ref({type: '', message: ''})
    const successAudioElement = ref()
    const errorAudioElement   = ref()
    const status = {
        success: 'bg-[var(--fave)] text-[var(--color)]',
        error: 'bg-red-500'
    }
    const initError = ref('')
    const content = ref('sdf');
    
    const emit = defineEmits(['skip'])
    const switchCamera = () => {
        switch (selectedCamera.value) {
            case 'front':
            selectedCamera.value = 'rear'
            break
            case 'rear':
            selectedCamera.value = 'front'
            break
        }
    }
    async function onInit (promise) {
        try {
            await promise
        } catch (error) {
            if (error.name === 'NotAllowedError') {
                initError.value = "ERROR: you need to grant camera access permission"
            } else if (error.name === 'NotFoundError') {
                initError.value = "ERROR: no camera on this device"
            } else if (error.name === 'NotSupportedError') {
                initError.value = "ERROR: secure context required (HTTPS, localhost)"
            } else if (error.name === 'NotReadableError') {
                initError.value = "ERROR: is the camera already in use?"
            } else if (error.name === 'OverconstrainedError') {
                initError.value = "ERROR: installed cameras are not suitable"
            } else if (error.name === 'StreamApiNotSupportedError') {
                initError.value = "ERROR: Stream API is not supported in this browser"
            } else if (error.name === 'InsecureContextError') {
                initError.value = 'ERROR: Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.';
            } else {
                initError.value = `ERROR: Camera error (${error.name})`;
            }
        } finally {
            showScanConfirmation.value = camera.value === false
        }
    }
    const onDecode = async (scanResult) => 
    {
        content.value = scanResult;
    }
    const handleSave = async (gameId, taskId) => {
        if (!isEmpty(content.value)) {
            const data = await saveUserData({
                QRCodeFinder: true,
                id: gameId,
                taskId: taskId,
                answer: content.value,
            });
            if (data.status == "success") {
                // window.location.reload();
                emit('skip', true)
            }
        } else {
            alert(translate('Cannot submit empty value'));
        }
    }
    const unpause = () => {
        camera.value = true
    }
    const pause = () => {
        camera.value = false
    }
</script>

<style>
    .qrcode-stream-camera,
    .qrcode-stream-overlay{
        width: 250px !important;
        display: block;
        aspect-ratio: 1/1;
    }
</style>