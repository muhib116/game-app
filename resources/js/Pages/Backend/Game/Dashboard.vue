<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Game Dashboard</p>
        </div>
        <div class="px-5 py-5">
            <!-- game.tasks -->
            <div v-if="game.start_time">
                <div class="text-xl font-black py-3">
                    Game start at: {{ moment(game.start_time).format('D MMM YYYY H:mm:ss') }}
                </div>
                <div class="text-xl font-black py-3" v-if="game.end_time">
                    Game end at: {{ moment(game.end_time).format('D MMM YYYY H:mm:ss') }}
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <template v-for="(task, index) in game.tasks" :key="index">
                    <div class="py-2 px-4 bg-white shadow-md rounded-md">
                        <div class="font-bold text-center border-b mb-3 py-2">
                            {{ get(task, 'data.title') }}
                        </div>
                        <div v-if="task.isStarted">
                            <span class="px-3 bg-green-200">Done</span>
                        </div>
                        <div v-if="task.isStarted" class="flex gap-1">
                            <input type="number" class="border flex-1 py-1 px-2 border-gray-600" placeholder="Give number" />
                            <button class="py-1 px-2 bg-green-400 border border-green-400">Save</button>
                        </div>
                        <div v-if="task.component == 'UploadImage'">
                            <img class="w-full mt-2" :src="get(task, 'data.image')" alt="">
                        </div>
                        <div v-if="task.component == 'WriteText'">
                            <div class="font-semibold mt-2">
                                Submited answer:
                            </div>
                            <div class="pt-2">
                                {{ get(task, 'answer') }}
                            </div>
                        </div>
                        <div v-if="task.component == 'Quiz'">
                            <div v-if="isArray(task.userOptions)" class="pt-4">
                                <span class="text-black">User answer</span>
                                <template v-for="(item, index) in task.userOptions" :key="index"> 
                                    <label class='flex gap-4 text-sm items-center'>
                                        <input 
                                            type="checkbox" 
                                            v-model="item.teamAnswer"
                                            disabled
                                        />
                                        {{ item.name }}
                                    </label>
                                </template>
                                <!-- <div class="mt-4">
                                    <span class="text-black">Gamehost answer</span>
                                    <template v-for="(item, index) in task.data.options" :key="index"> 
                                        <label class='flex gap-4 text-sm items-center'>
                                            <input 
                                                type="checkbox" 
                                                v-model="item.teamAnswer"
                                                disabled
                                            />
                                            {{ item.name }}
                                        </label>
                                    </template>
                                </div> -->
                            </div>
                        </div>
                        <div v-if="task.component == 'QRCodeFinder'">
                            <strong class="font-semibold block my-2">Qr code scan result:</strong>
                            <div>
                                {{ get(task, 'data.result') }}
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </Master>
</template>

<script setup>
import Master from '../Master.vue'
import { get, isArray } from 'lodash'
import moment from 'moment'


defineProps({
    game: Object,
});

</script>