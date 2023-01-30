import axios from 'axios'
import {ref} from 'vue'


export default function gameDrain() {
    const loading = ref({
        save: false,
        list: false,
    });
    const saveGame = async (payload) => {
        loading.value = true;
        const data = await axios.post('/game/save', payload)
                        .then(res => res.data)

        loading.value = false;
        return data;
    }
    const saveUserData = async (payload) => {
        const data = await axios.post('/game/save_user_data', payload)
                        .then(res => res.data)
        return data;
    }

    const gameList = async (payload={}) => {
        loading.value.list = true;
        const data = await axios.post(route('game.list'), payload)
        .then(res => res.data)
        loading.value.list = false;
        return data;
    }

    return {
        saveGame,
        gameList,
        saveUserData,
        loading,
    }
}