import { cloneDeep } from "lodash"
import { ref } from 'vue'
import UploadImage from '@/Components/Frontend/Tasks/UploadImage.vue'
import WriteText from '@/Components/Frontend/Tasks/WriteText.vue'
import Quiz from '@/Components/Frontend/Tasks/Quiz.vue'

export default function useTaskCreate() 
{
    const config = ref([])
    const components = [
        {
            name: 'Image',
            component: UploadImage,
            isSelected: true
        },
        {
            name: 'Text',
            component: WriteText,
            isSelected: false
        },
        {
            name: 'Quiz',
            component: Quiz,
            isSelected: false
        }
    ]

    return {
        components
    }
}