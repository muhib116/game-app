import { toast } from '@/helper'
import axios from 'axios'
import { ref } from 'vue'
import useConnfiguration from '@/Components/Backend/Game/useConnfiguration'

export const duplicateError = ref({
    status: false,
    index: 0,
})
const { gamePayload } = useConnfiguration()
export const loginPayload = ref({})

const _quizValidation = (payload) => {
    let valid = true
    payload.tasks.forEach(item => {
        if (item.name == 'Quiz' && item.data.options?.length == 0) {
            valid = false
        }
        if (item.data.options?.length) {
            item.data.options.map(opt => {
                if (!opt.name) {
                    valid = false
                }
            })
        }
    })

    return valid
}

export const tabValidator = async (cb) => {
    if(duplicateError.value.status){
        toast.error("Team already exist")
        return
    }
    if(!_quizValidation(gamePayload.value)){
        toast.error("Quiz option cannot be empty")
        return
    }

    if(loginPayload.value.gameCode && loginPayload.value.gamePassword && loginPayload.value.gameTitle){
        const { data } = await axios.post(route('loginScreenValidation'), {
            id: gamePayload.value.id,
            ...loginPayload.value
        })
        if(!data){
            cb()
            return;
        }

        toast.error("Game title or game code already exist")
    }
    return false
}
