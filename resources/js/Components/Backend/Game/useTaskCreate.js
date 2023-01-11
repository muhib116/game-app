import { cloneDeep } from "lodash"
import { ref } from 'vue'
import UploadImage from '@/Components/Frontend/Tasks/UploadImage.vue'
import WriteText from '@/Components/Frontend/Tasks/WriteText.vue'
import Quiz from '@/Components/Frontend/Tasks/Quiz.vue'



export default function useTaskCreate() {
    const components = [
        {
            id: 1,
            name: 'Image',
            component: UploadImage,
            isSelected: true,
        },
        {
            id: 2,
            name: 'Text',
            component: WriteText,
            isSelected: false
        },
        {
            id: 3,
            name: 'Quiz',
            component: Quiz,
            isSelected: false
        }
    ];


    const makeSelected = (item, config) => {
        config.forEach(element => {
            element.isSelected = item.id == element.id;
        });
    }

    const makeDeselected = (config) => {
        config.forEach(element => {
            element.isSelected = false;
        });
    }

    const addTemplate = (item, config) => {
        makeDeselected(config);
        let cloned_item = cloneDeep(item);
        cloned_item.id = config.length+1 + Math.random()*2000;
        cloned_item.isSelected = true;
        config.push(cloned_item);
    }
    const removeItem = (index, config) => {
        makeDeselected(config);
        config.splice(index, 1);
        if (index == config.length) {
            config[config.length-1].isSelected = true;
        } else {
            config[index].isSelected = true;
        }
    }

    return {
        components,
        makeSelected,
        addTemplate,
        removeItem
    }
}