import { cloneDeep } from "lodash"
import { ref } from 'vue'
import UploadImage from '@/Components/Frontend/Tasks/UploadImage.vue'
import WriteText from '@/Components/Frontend/Tasks/WriteText.vue'
import Quiz from '@/Components/Frontend/Tasks/Quiz.vue'
import InstructionSetup from '@/Components/Backend/Game/InstructionSetup.vue'
import TaskCreate from '@/Components/Backend/Game/TaskCreate.vue'
import useConnfiguration from '@/Components/Backend/Game/useConnfiguration'

const componentList = ref({
    UploadImage,
    WriteText,
    Quiz
});

export default function useTaskCreate() {
    const components = [
        {
            id: 1,
            name: 'UploadImage',
            component: 'UploadImage',
            isSelected: true,
        },
        {
            id: 2,
            name: 'Text',
            component: 'WriteText',
            isSelected: false
        },
        {
            id: 3,
            name: 'Quiz',
            component: 'Quiz',
            isSelected: false
        }
    ];


    const makeSelected = (item, tasks) => {
        tasks.forEach(element => {
            element.isSelected = item.id == element.id;
        });
    }

    const makeDeselected = (tasks) => {
        tasks.forEach(element => {
            element.isSelected = false;
        });
    }

    const addTemplate = (item, tasks) => {
        makeDeselected(tasks);
        let cloned_item = cloneDeep(item);
        cloned_item.id = tasks.length+1 + Math.random()*2000;
        cloned_item.isSelected = true;
        tasks.push(cloned_item);
    }
    const removeItem = (index, tasks) => {
        makeDeselected(tasks);
        tasks.splice(index, 1);
        if (index == tasks.length) {
            tasks[tasks.length-1].isSelected = true;
        } else {
            tasks[index].isSelected = true;
        }
    }

    return {
        components,
        componentList,
        makeSelected,
        addTemplate,
        removeItem
    }
}