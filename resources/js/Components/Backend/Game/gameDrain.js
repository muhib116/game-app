import axios from 'axios'
import {ref} from 'vue'
import { toast } from '@/helper';

export const hasError = ref(false)
export const hasTeamCodeError = ref(false)

export default function gameDrain() {
    
    const loading = ref({
        save: false,
        list: false,
    });
    let timeOut = null;
    const saveGame = async (payload, fromUser=false) => {
        loading.value.save = true;
        const data = await axios.post('/game/save', payload)
                        .then(res => res.data);
        clearTimeout(timeOut);
        if (data?.status == 'failed' && fromUser==false) {
            hasError.value = true
            timeOut = setTimeout(() => {
                toast.clear();
                toast.error(data?.message, {
                    position: 'top-right',
                    maxToasts: 2,
                });
            })
        } else {
            if (fromUser==false) {
                timeOut = setTimeout(() => {
                    toast.clear();
                    toast.success('Game saved successfully', {
                        position: 'top-right',
                        // timeout: 200,
                        maxToasts: 2,
                    });
                    hasError.value = false
                }, 300);
            }
        }
        loading.value.save = false;
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