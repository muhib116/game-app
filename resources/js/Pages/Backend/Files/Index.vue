<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <h4 className="text-2xl font-bold text-black">Media</h4>
            <label
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
            </label>
        </div>
        <div className="p-5">
            <div class="grid gap-4 grid-cols-1 xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2">
                <div
                    class="bg-white p-2 shadow-md rounded-md aspect-square"
                    v-for="(file, index) in files"
                    :key="index"
                >
                    <img class="w-full h-full object-cover" :src="file.path" alt="">
                    <button @click="handleDelete(file)" class="p-2 text-red-600"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            <!-- <FilePopup v-model:modelValue="modelValue" /> -->
        </div>
    </Master>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import Master from '../Master.vue'
import FilePopup from '@/Components/Backend/Files/FilePopup.vue';
import useMedia from '@/useMedia';

const { mediaUpload, deleteMedia } = useMedia();
const props = defineProps({
    files: {
        type: Array,
        default: []
    }
});

onMounted(()=>{
    mediaFiles.value = props.files;
});

const modelValue = ref(false);

const handleMedia = async (file) => {
    const data = await mediaUpload(file);
    if (data.status == 'error') {
        console.log('error');
    }
    if (data.status == 'success') {
        props.files.push(data.data);
    }
}

const handleDelete = async (file) => {
    const data = await deleteMedia(file.id);
    if (data.status == 'error') {
        console.log('error');
    }
    if (data.status == 'success') {
        props.files.filter(f => {
            return f.id != file.id;
        });
    }
}


</script>