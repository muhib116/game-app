<template>
    <nav className='p-5 bg-white border-t shadow flex justify-between text-gray-500 gap-4'>
        <div class="flex flex-wrap gap-4">
            <template v-for="option in options" :key="option.id">
                <button 
                    @click="tabValidator(() => $emit('handleNav', option))" 
                    class="bg-slate-200 py-2 px-3 rounded text-black"
                    :class="option.isActive ? '!text-white !bg-[var(--faveDark)]' : ''">
                    {{ option.title }}
                </button>
            </template>
        </div>

        <button @click="tabValidator(() => saveGame(gamePayload))" :disabled="loading.save" class="bg-slate-200 py-2 px-3 rounded text-white !bg-[var(--faveDark)] flex items-center">
            <Preloader class="w-4 h-4" v-if="loading.save" />
            Save
        </button>
    </nav>
</template>

<script setup>
import { translate } from '@/useLanguage';
import gameDrain, { hasError, hasTeamCodeError } from './gameDrain';
import useConnfiguration from './useConnfiguration';
import Preloader from '@/Components/Global/Preloader.vue';
import { loginPayload, tabValidator } from '@/Pages/Backend/validator.js'

const props = defineProps({
    options: Array,
})

const { saveGame, loading } = gameDrain()
const { gamePayload } = useConnfiguration()

</script>