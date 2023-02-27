<template>
    <div class="relative">
        <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
            <img 
                v-if="controlBy=='admin'"
                :src='getSelected(gamePayload.tasks).adminImage' 
                alt=""
                class='w-full block mb-6'
            />
            <img 
                v-else
                :src="get(task, 'adminImage')" 
                alt=""
                class='w-full block mb-6'
            />
            
            <button class="py-2 px-4 mb-4 bg-slate-200 rounded">Start task</button>

            <label v-if="controlBy=='admin'" class='px-4 py-1 bg-blue-300 shadow rounded w-full relative mt-14 flex items-center justify-center'>
                <Preloader v-if="adminImageLoading" />
                UPLOAD IMAGE
                <input @change="(e) => handleAdminImage(e.target.files[0], gamePayload.tasks)" type='file' :disabled="adminImageLoading" hidden />
            </label>
            <label v-if="controlBy=='admin'" class="my-4 mt-5 flex justify-center">
                <input v-model="getSelected(gamePayload.tasks).data.point" type="number" class="py-2 px-4" placeholder="Task point">
            </label>
            <div class='text-black text-opacity-80'>
                <div v-if="controlBy=='admin'">
                    <input
                        type="text"
                        class='font-semi-bold text-2xl mb-2 border-0'
                        placeholder="Game title"
                        v-model="getSelected(gamePayload.tasks).data.title"
                    />
                </div>
                <h3 v-else class='font-semi-bold text-2xl mb-2'>
                    {{ get(task, 'data.title') }}
                </h3>
                <input
                    v-if="controlBy=='admin'"
                    v-model="getSelected(gamePayload.tasks).data.description"
                    class="text-black text-opacity-80 border-0 p-0 text-center" type="text" 
                    placeholder="Title" 
                />
                <p v-else>{{ get(task, 'data.description') }}</p>
            </div>
            <div v-if="!task.isStarted">
                <label v-if="controlBy!='admin'" class='px-4 py-1 bg-orange-300 shadow rounded flex justify-center w-full relative mt-14'>
                    <Preloader v-if="adminImageLoading" />
                    UPLOAD IMAGE
                    <input @change="(e) => handleUpload(e.target.files[0])" type='file' hidden />
                </label>
            </div>
            <div v-if="task.isStarted" class="flex justify-center">
                <span class="py-0 px-3 bg-green-200 text-green-800 inline-flex gap-1 items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Task Completed
                </span>
            </div>
            <div v-if="controlBy!='admin'">
                <img class="w-[200px]" :src="imgLink" v-if="imgLink" alt="">
            </div>
            <template v-if="controlBy!='admin'">
                <div v-if="imgLink">
                    <button @click="handleSave(game.id, task.id)" class="mt-4 py-1.5 px-5 bg-green-600 text-white rounded">Save</button>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
    import useDataSource from "@/Pages/Frontend/useDataSource"
    import useTaskCreate from "@/Components/Backend/Game/useTaskCreate";
    import useConnfiguration from "@/Components/Backend/Game/useConnfiguration";
    import { get, isEmpty } from 'lodash'
    import { Link } from "@inertiajs/inertia-vue3";
    import gameDrain from "@/Components/Backend/Game/gameDrain";
    import useFileUpload from '@/useFileUpload';
    import Preloader from "@/Components/Global/Preloader.vue";
    import { ref } from 'vue'
    const { saveUserData } = gameDrain();
    const { handleImageUpload, deleteImage } = useFileUpload();
    const imgLink = ref(false); 

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
            default: {}
        },
    });

    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();

    const adminImageLoading = ref(false);

    const handleAdminImage = async (file, tasks) => {
        // adminImage
        adminImageLoading.value = true;
        const response = await handleImageUpload(file);
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
        // let data = props.data;
        const response = await handleImageUpload(file);
        if (response.status == 'error') {
            console.log('error');
        }
        if (response.status == 'success') {
            let old = imgLink.value;
            if (old) {
                deleteImage(old);
            }
            imgLink.value = response.path;
        }
    }

    const handleSave = async (gameId, taskId) => {
        if (!isEmpty(imgLink.value)) {
            const data = await saveUserData({
                UploadImage: true,
                id: gameId,
                taskId: taskId,
                image: imgLink.value,
            });
            if (data.status == "success") {
                window.location.reload();
            }
        } else {
            alert('Cannot submit empty value');
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