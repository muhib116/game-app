import { ref } from 'vue'

const imageFromApi = ref([])

export default function useFileUpload() {
    const preloader = ref(false)
    const imagePreview = (file, item, key) => {
        let FR = new FileReader();
        FR.readAsDataURL(file)
        FR.onload = () => {
            item[key] = FR.result
        }
    }

    const mediaUpload = async (file) => 
    {
        preloader.value = true
        const formData = new FormData()
        formData.append('image', file)
        const data = await axios.post(route('media.upload'), formData)
                                .then(res => res.data);
        preloader.value = false
        return data;
    }


    const deleteMedia = async (id) => {
        return await axios.post(route('media.delete'), {
            id
        })
    }

    return {
        mediaUpload,
        deleteMedia,
        preloader
    }
}