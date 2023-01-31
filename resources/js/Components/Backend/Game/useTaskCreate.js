import { cloneDeep } from "lodash"
import { ref } from 'vue'
import UploadImage from '@/Components/Frontend/Tasks/UploadImage.vue'
import WriteText from '@/Components/Frontend/Tasks/WriteText.vue'
import Quiz from '@/Components/Frontend/Tasks/Quiz.vue'
import QRCodeFinder from '@/Components/Frontend/Tasks/QRCodeFinder.vue'
import InstructionSetup from '@/Components/Backend/Game/InstructionSetup.vue'
import TaskCreate from '@/Components/Backend/Game/TaskCreate.vue'
import useConnfiguration from '@/Components/Backend/Game/useConnfiguration'

const componentList = ref({
    UploadImage,
    WriteText,
    Quiz,
    QRCodeFinder,
});

export default function useTaskCreate() {
    const components = [
        {
            id: 1,
            name: 'UploadImage',
            component: 'UploadImage',
            isSelected: true,
            data: {
                title: 'Task#1: Find the tower',
                description: 'You and your team should find the eiffel tower and take a creative photo of the group infront of the effiel tower. Once you have uploaded the image, next task will be served.',
                image: null,
            },
            isStarted: null,
        },
        {
            id: 2,
            name: 'Text',
            component: 'WriteText',
            isSelected: false,
            data: {
                title: 'Task#1: Write text',
                description: 'You and your team should find the eiffel tower and take a creative photo of the group infront of the effiel tower. Once you have uploaded the image, next task will be served.'
            },
            answer: null,
            isStarted: null,
        },
        {
            id: 3,
            name: 'Quiz',
            component: 'Quiz',
            isSelected: false,
            data: {
                title: 'Task#1: Quize',
                description: 'You and your team should find the eiffel tower and take a creative photo of the group infront of the effiel tower. Once you have uploaded the image, next task will be served.',
                options: [],
            },
            isStarted: null,
        },
        {
            id: 4,
            name: 'QRCodeFinder',
            component: 'QRCodeFinder',
            isSelected: false,
            data: {
                title: 'Task#1: Qr code find',
                description: 'You and your team should find the eiffel tower and take a creative photo of the group infront of the effiel tower. Once you have uploaded the image, next task will be served.',
                qrValue: 'value',
            },
            isStarted: null,
        }
    ];


    const makeSelected = (item, tasks) => {
        tasks.forEach(element => {
            element.isSelected = item.id == element.id;
        });
    }
    const getSelected = (tasks) => {
        return tasks.find(element => element.isSelected);
    }

    const addOption = (options) => {
        options.push({
            isChecked: false, // This is admin answer
            teamAnswer: false,
            name: ''
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
        getSelected,
        addTemplate,
        addOption,
        removeItem
    }
}