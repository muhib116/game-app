import { ref, watch, watchEffect } from 'vue'

const config = ref([])


const login = {
    image: null,
    gameTitle: null,
    gameCode: null,
    gamePassword: null,
}

const instruction = [
    {
        component: 'Home',
        show: false,
        title: 'This is your game:',
        subtitle: 'Get to know paris in 3 hours',
        description: 'Grab items, take photos and taste the french cusine',
        settings: {
            image: null,
            opacity: 100,
            color: 'black'
        }
    },
    {
        component: 'Instruction',
        show: false,
        text: [
            'Just text about the game, time limit and how to solve it.',
            'this text should also be restrictied so is fits on maximum two screens scrollingdown.'
        ],
        settings: {
            image: null,
            opacity: 100,
            color: 'black'
        }
    },
    {
        component: 'StartGame',
        show: false,
        title: ' Your start point',
        description: 'lorem',
        settings: {}
    }
]

const gamePayload = ref({
    login,
    instruction,
    tasks: config.value,
    status: 'draft',
});

export default function useConnfiguration() {
    let timeOutId = null;
    watch(gamePayload, ()=>{
        clearTimeout(timeOutId);
        timeOutId = setTimeout(()=>{
            console.log(gamePayload.value);
        },1500)
    }, {deep: true});

    return {
        gamePayload,
        config,
    }
}