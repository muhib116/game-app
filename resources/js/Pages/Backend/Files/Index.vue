<template>
    <Master>
        <div className="flex justify-between p-5 bg-white shadow">
            <h4 className="text-xl font-bold text-black">{{ translate('Media') }}</h4>
            <!-- <label
                class="bg-gray-100 rounded-md py-2 px-4 active:scale-95 hover:bg-gray-200 transition-colors duration-300 cursor-pointer"
                @click="modelValue=true"
            >
                <i class="fa fa-upload"></i>
                Upload
                <input 
                    type="file" 
                    class="hidden"
                    @change="(e)=>{
                        handleMedia(e.target.files[0])
                    }"
                />
            </label> -->
        </div>
        <div className="p-5 flex flex-col">
            <template
                v-for="(game, index) in games"
                :key="index"
            >
                <div v-if="!isEmpty(findImages(game.tasks))">
                    <div class="py-4 mb-2 my-3">
                        <div class="font-bold text-xl bg-sky-100 text-sky-900 px-3 py-1 rounded flex justify-between">
                            {{ game.login.gameTitle }}
                            <span>
                                {{ size(findImages(game.tasks)) }}
                            </span>
                        </div>
                    </div>
                    <div v-if="!isEmpty(findImages(game.tasks))" class="grid gap-4 grid-cols-1 xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
                        <div
                            class="bg-white p-2 shadow-md rounded-md aspect-square"
                            v-for="(image, index) in findImages(game.tasks)"
                        >
                            <img :src="image" alt="Image">
                        </div>
                    </div> 
                </div>
            </template>
        </div>
    </Master>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import Master from '../Master.vue'
import FilePopup from '@/Components/Backend/Files/FilePopup.vue';
import useMedia from '@/useMedia';
import { toast } from '@/helper';
import { Inertia } from '@inertiajs/inertia';
import { findIndex, size, each, isEmpty } from 'lodash';
import { translate } from '@/useLanguage';

const { mediaUpload, deleteMedia } = useMedia();
const props = defineProps({
    games: {
        type: Array,
        default: []
    }
});

const findImages = (tasks) => {
    let images = []
    each(tasks, item => {
        if (item.name == "UploadImage") {
            each(item.userAnswer, answer => {
                images.push(answer.image)
            });
        }
    })
    return images
}

</script>