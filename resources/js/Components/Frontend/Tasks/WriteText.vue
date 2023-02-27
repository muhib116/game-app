<template>
    <div className="relative">
        <label v-if="controlBy=='admin'" class="my-4 mt-5 flex justify-center">
            <input v-model="getSelected(gamePayload.tasks).data.point" type="number" class="py-2 px-4" placeholder="Task point">
        </label>
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
            <input 
                v-model="getSelected(gamePayload.tasks).data.description"
                v-if="controlBy=='admin'"
                type="text"
                class="border-0 text-center"
            />
            
            <p v-else>{{ task.data.description }}</p>
            <template v-if="controlBy!='admin'">
                <div v-if="task.isStarted" class="flex justify-center">
                    <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Task Completed
                    </span>
                </div>
                <button class="py-1 px-4 mb-4 mt-2 bg-[var(--fave)] rounded">Start task</button>
                <Button @click="modelValue=true" v-if="!task.isStarted" label="WRITE IN TEXT" class="mt-14 border" />
                <TextWritePopup v-model="modelValue" :task="task" :game="game" />
            </template>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'
    import useDataSource from "@/Pages/Frontend/useDataSource"
    import TextWritePopup from '../Popup/TextWritePopup.vue';

    defineProps({
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

    const modelValue = ref(false);

    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();
    const { taskData } = useDataSource()

</script>