import { ref, watch, watchEffect } from 'vue'
import gameDrain from '@/Components/Backend/Game/gameDrain';
import { cloneDeep } from 'lodash'
const { saveGame } = gameDrain();

const login = {
    image: null,
    gameTitle: null,
    gameCode: null,
    gamePassword: null,
    team: [{
        teamName: 'Default team',
        teamCode: 'code1' // Unique team code.
    }],
}

const instruction = [
    {
        component: 'Home',
        show: true,
        title: 'This is your game:',
        subtitle: 'Get to know paris in 3 hours',
        description: 'Grab items, take photos and taste the french cusine',
        settings: {
            image: null,
            opacity: 50,
            color: '#000'
        }
    },
    {
        component: 'Instruction',
        show: true,
        text: [
            'Just text about the game, time limit and how to solve it.',
            'this text should also be restrictied so is fits on maximum two screens scrollingdown.'
        ],
        settings: {
            image: null,
            opacity: 50,
            color: '#000'
        }
    },
    {
        component: 'StartGame',
        show: true,
        title: ' Your start point',
        description: 'lorem',
        settings: {
            longtide: null,
            lattitude: null,
            image: null,
            opacity: 50,
            color: '#000'
        }
    }
]

const defaultGamePayload = {
    id: null,
    login,
    instruction,
    tasks: [],
    status: 'draft',
    start_time: null,
    end_time: null,
};


const gamePayload = ref(cloneDeep(defaultGamePayload));

export default function useConnfiguration() {
    let timeOutId = null;
    watch(gamePayload, ()=>{
        clearTimeout(timeOutId);
        timeOutId = setTimeout(()=>{
            saveGame(gamePayload.value);
        },1000)
    }, {deep: true});

    return {
        gamePayload,
        defaultGamePayload,
    }
}