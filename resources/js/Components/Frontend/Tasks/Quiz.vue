<template>
    <div class="relative">
        <div class='p-6 text-black text-opacity-80 leading-8 text-lg'>
            <div class='text-black text-opacity-80'>
                <input 
                    v-if="controlBy=='admin'" 
                    v-model="getSelected(gamePayload.tasks).data.title"
                    type="text" placeholder="Title"
                    class="w-full border-0 text-center"
                />
                <h3 v-else class='font-semi-bold text-2xl mb-2 text-center'>{{ task.data.title }}</h3>
                <input 
                    v-if="controlBy=='admin'"
                    class="text-center border-0 w-full"
                    v-model="getSelected(gamePayload.tasks).data.description" type="text"
                >
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
                        <input class="border-0 py-0 px-0" type="text" v-model="item.name" placeholder="Add Text">
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
                <!-- {{ game.id }} -->
                <template v-for="(item, index) in task.data.options" :key="index"> 
                    <label class='flex gap-4 text-sm items-center'>
                        <input 
                            type="checkbox" 
                            v-model="item.teamAnswer"
                        />
                        {{ item.name }}
                    </label>
                </template>
            </div>
            <Button 
                v-if="controlBy!='admin' && task.isStarted == false" 
                label="Save" 
                class='mt-14' 
                @click="handleSubmit(game.id, task.id)"
            />
            <div v-if="task.isStarted" class="flex justify-center">
                <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Task complete
                </span>
            </div>
        </div>
    </div>
</template>

<script setup>
    import gameDrain from '@/Components/Backend/Game/gameDrain';
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'

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


    
    const handleSubmit = async (gameId, taskId) => {
        if (confirm('Are you sure?')) {
            console.log(props.task);
            const data = await saveUserData({
                Quiz: true,
                id: gameId,
                taskId: taskId,
                answer: props.task.data.options,
            });
            if (data.status == "success") {
                window.location.reload();
            }
        }
        // if (answer.value) {
        //     const data = await saveUserData({
        //         writeText: true,
        //         id: gameId,
        //         taskId: taskId,
        //         answer: answer.value,
        //     });
        //     if (data.status == "success") {
        //         window.location.reload();
        //     }
        // } else {
        //     alert('Cannot submit empty value');
        // }
    }
</script>

<style lang="scss" scoped>

</style>