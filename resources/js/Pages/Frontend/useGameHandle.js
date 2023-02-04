import { ref } from 'vue'
import Home from '@/Components/Backend/Game/components/Home.vue'
import Instruction from '@/Components/Backend/Game/components/Instruction.vue'
import StartGame from '@/Components/Backend/Game/components/StartGame.vue'
import { useGlobalSetting } from '@/helper'

const componentList = {
    Home,
    Instruction,
    StartGame
}

const index = ref(0);

const { asideActive, closeAside } = useGlobalSetting();

export default function useGameHandle() {
    const selectSteap = (gameData) => {
        return gameData.instruction[index.value];
    }
    const nextSteap = (gameData) => {
        (index.value < gameData.instruction.length - 1) ? index.value++ : index.value = 0;
        asideActive.value = false;
    }
    const showIndex = (gameData, targetIndex) => {
        index.value = targetIndex;
        closeAside();
        asideActive.value = false;
        // asideActive.value = false; 
    }
    const shouldShow = (controlBy, data) => {
        if (controlBy=='admin') {
            return true;
        }
        if (data.show == true) {
            return true;
        }
        return false;
    }
    return {
        componentList,
        index,
        selectSteap,
        nextSteap,
        shouldShow,
        showIndex
    }
}