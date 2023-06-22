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
            adminImage: null,
            data: {
                title: 'Oppgave: Finn attraksjonen og ta et bilde',
                description: '(Eksempel tekst: Du og ditt lag skal finne attraksjon X og ta et kreativt gruppefoto foran attraksjonen. Kreativiteten i foto vil avgjøre om dere får full pott eller ikke)',
                image: null,
                point: null,
                extraPoint: null,
                deadline: null,
            },
            isStarted: null,
            userAnswer: [],
        },
        {
            id: 2,
            adminImage: null,
            name: 'Text',
            component: 'WriteText',
            isSelected: false,
            data: {
                title: 'Oppgave: Finn innskrift på vegg',
                description: '(eksempel tekst: Dere skal finne frem til den kjente bymuren og ved hovedinngangen på sørsiden er et en stor innskrift på latinsk. Hva står det? Klarer dere oppgaven før kl 12:00 = 50 ekstra poeng)',
                point: null,
                extraPoint: null,
                deadline: null,
            },
            answer: null,
            isStarted: null,
            userAnswer: [],
        },
        {
            id: 3,
            adminImage: null,
            name: 'Quiz',
            component: 'Quiz',
            isSelected: false,
            userOptions: [],
            data: {
                title: 'Oppgave: Hvilket alternativ er rett?',
                description: '(eksempel tekst: Jens har 100 liter vann og gir 50 liter til Lisa. Morten drikke 4 liter av Jens sine 100 liter og Lisa gir bort 14 liter til en hjemmløskatt. Hvor mange liter vann har Ole i koppen sin?) ',
                options: [],
                point: null,
                extraPoint: null,
                deadline: null,
            },
            isStarted: null,
            userAnswer: [],
        },
        {
            id: 4,
            adminImage: null,
            name: 'QRCodeFinder',
            component: 'QRCodeFinder',
            isSelected: false,
            data: {
                title: 'Oppgave: Finn QR koden på damedoen.',
                description: '(eksempel tekst: Vi har gjemt et QR kode på damedoen på Grand Kafe. Finn koden og skann den før kl 13:00. Dere får ekstra 100 poeng om hele laget får plass i ett av avlukkende og tar en bilde som dere sender inn)',
                qrValue: 'value',
                result: null,
                point: null,
                extraPoint: null,
                deadline: null,
            },
            isStarted: null,
            userAnswer: [],
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