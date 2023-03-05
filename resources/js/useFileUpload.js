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

    const handleImageUpload = async (file, type) => 
    {
        if (file.size/1024 > 1024) {
            alert('Maximum file upload size should 1MB');
            return;
        }
        preloader.value = true
        const formData = new FormData()
        formData.append('image', file)
        formData.append('type', type)
        const data = await axios.post(route('image.upload'), formData)
                                .then(res => res.data);
        preloader.value = false
        return data;
    }


    const deleteImage = async (path) => {
        return await axios.post(route('image.delete'), {
            path
        })
    }

    return {
        handleImageUpload,
        deleteImage,
        preloader
    }
}