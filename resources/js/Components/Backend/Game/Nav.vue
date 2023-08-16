<template>
    <nav className='p-5 bg-white border-t shadow flex justify-between text-gray-500 gap-4'>
        <div class="flex flex-wrap gap-4">
            <template v-for="option in options" :key="option.id">
                <template v-if="option.title == 'Login Page Setup'">
                    <button 
                        @click="$emit('handleNav', option)" 
                        class="bg-slate-200 py-2 px-3 rounded text-black"
                        :class="option.isActive ? '!text-white !bg-[var(--faveDark)]' : ''">
                        <!-- {{ translate(option.title) }} -->
                        {{ option.title }}
                    </button>
                </template>
                <template v-else>
                    <button
                        v-if="!hasError"
                        @click="$emit('handleNav', option)" 
                        class="bg-slate-200 py-2 px-3 rounded text-black"
                        :class="option.isActive ? '!text-white !bg-[var(--faveDark)]' : ''">
                        <!-- {{ translate(option.title) }} -->
                        {{ option.title }}
                    </button>
                </template>
            </template>
        </div>
        <!-- <button @click="saveGame(gamePayload)" class="bg-slate-200 py-2 px-3 rounded text-white !bg-[var(--faveDark)]">
            Save
        </button> -->
    </nav>
</template>

<script setup>
import { translate } from '@/useLanguage';
import gameDrain, { hasError } from './gameDrain';
import useConnfiguration from './useConnfiguration';
import Preloader from '@/Components/Global/Preloader.vue';

const props = defineProps({
    options: Array,
})

const { saveGame } = gameDrain()
const { gamePayload } = useConnfiguration()

</script>