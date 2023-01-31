<template>
    <div v-if="modelValue" class="fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center bg-white/50 bg-opacity-50 backdrop-blur-lg z-50">
        <i 
            @click="() => {
                $emit('update:modelValue', false);
            }"
            ref="closeBtn"
            class="fa-solid exit fa-xmark absolute top-4 right-4 text-4xl cursor-pointer hover:text-red-600"
        ></i>
        <div class="w-full max-w-xl">
            <textarea class="w-full" v-model="answer" rows="3" placeholder="Write your answer"></textarea>
            <button @click="() => handleSubmit(game.id, task.id)" class="mt-3 py-1 px-4 bg-[#FDBA74] text-black shadow-md rounded">Submit</button>
        </div>
    </div>
</template>

<script setup>
    import gameDrain from '@/Components/Backend/Game/gameDrain';
    import axios from 'axios'
    import { ref, onMounted } from 'vue'
    const { saveUserData } = gameDrain();
    
    const props = defineProps({
        modelValue: {
            type: Boolean,
            default: false
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
    const answer = ref('');
    const closeBtn = ref(null);

    const handleSubmit = async (gameId, taskId) => {
        if (answer.value) {
            const data = await saveUserData({
                writeText: true,
                id: gameId,
                taskId: taskId,
                answer: answer.value,
            });
            if (data.status == "success") {
                window.location.reload();
            }
        } else {
            alert('Cannot submit empty value');
        }
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