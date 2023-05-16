<template>
    <nav className='p-5 bg-white border-t shadow flex justify-between text-gray-500 gap-4'>
        <div class="flex flex-wrap gap-4">
            <button 
                @click="$emit('handleNav', option)" 
                v-for="option in options" 
                :key="option.id" 
                class="bg-slate-200 py-2 px-3 rounded text-black"
                :class="option.isActive ? '!text-white !bg-[var(--faveDark)]' : ''">
                {{ option.title }}
            </button>
        </div>
        <!-- <button @click="saveGame(gamePayload)" class="bg-slate-200 py-2 px-3 rounded text-white !bg-[var(--faveDark)]">
            Save
        </button> -->
    </nav>
</template>

<script setup>
import gameDrain from './gameDrain';
import useConnfiguration from './useConnfiguration';

const props = defineProps({
    options: Array,
})

const { saveGame } = gameDrain()
const { gamePayload } = useConnfiguration()

</script>