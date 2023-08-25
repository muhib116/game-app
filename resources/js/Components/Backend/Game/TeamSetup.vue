<template>
    <tr class="hover:bg-gray-100 focus-within:bg-gray-100 border-b">
        <td class="py-3 px-2 text-center">
            {{ index }}
        </td>
        <td class="py-3 px-2 text-center">
            <input class="border-gray-300 flex-1 py-1" type="text" v-model="props.item.teamName" />
        </td>
        <td class="py-3 px-2 text-center">
            <input 
                class="border-gray-300 flex-1 py-1" 
                :class="(duplicateError.status && duplicateError.index == index) ? 'bg-red-100 focus:ring-red-500 focus:border-red-500' : ''" 
                :value="item.teamCode"
                @input="(e) => $emit('updateItem', e.target.value)"
                type="text"
            />
                <!-- v-model="teamLocal"  -->
            <span v-if="duplicateError.status && duplicateError.index == index" class="text-red-500 block text-xs">Team code already exist</span>
        </td>
        <td class="text-center">
            <button 
                v-if="index>0"
                @click="$emit('remove')"
                class="bg-red-200 text-red-600 w-[30px] h-[30px] flex items-center justify-center rounded-full"
            >
                <i class="fa fa-times"></i>
            </button>
        </td>
    </tr>
</template>

<script setup>
import { onMounted, onUpdated, ref, watch } from "vue"
import { filter, find } from "lodash";

const props = defineProps({
    item: Object,
    index: Number,
    duplicateError: {
        type: Object,
        default: {},
    },
    payload: {
        type: Array,
        default: []
    }
})

const teamLocal = ref('')
const teamLocalName = ref('')

const error = ref(false)

// onMounted(()=>{
//     teamLocal.value = props.item.teamCode
//     teamLocalName.value = props.item.teamName
// })

// watch(teamLocal, ()=>{
//     let exist = find(props.payload, (item, index) => item.teamCode == teamLocal.value && index != props.index-1)
//     if(exist) {
//         console.log('exist', exist);
//         error.value = true; 
//     } else {
//         props.payload[props.index-1].teamCode = teamLocal.value
//         props.payload[props.index-1].teamName = teamLocalName.value
//         error.value = false;
//     }
// })



</script>