<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { onMounted, computed } from 'vue'
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { translate } from '@/useLanguage';
import { themeColors } from '@/helper';

const form = useForm({
    theme: '#C6DDF2',
})

const saveTheme = () => {
    form.post(route('theme.update'));
}

onMounted(() => {
    const theme = usePage().props.value.theme
    form.theme = theme?.theme
})
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">{{ translate('Site theme') }}</h2>
        </header>

        <form @submit.prevent="saveTheme" class="mt-6 space-y-6">
            <div>
                <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Select your favorite color.</h3>
                <div class="flex flex-wrap gap-4">
                    <label v-for="(color, index) in themeColors" :style="`--itemBg:${color};`" class="w-[80px] rounded cursor-pointer border h-[80px] bg-[var(--itemBg)] shadow flex items-center justify-center">
                        <input v-model="form.theme" type="radio" :value="color" class="hidden peer" />
                        <span
                            class="peer-checked:flex hidden items-center justify-center w-8 h-8 rounded-full bg-white text-green-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                    </label>
                    <label :style="`--itemBg:${form.theme};`" class="w-[80px] rounded cursor-pointer relative border h-[80px] bg-[var(--itemBg)] shadow flex items-center justify-center">
                        <input v-model="form.theme" type="color" class="peer opacity-0 pointer-events-none" />
                        
                        <span
                            class="flex items-center z-10 justify-center text-4xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-white text-green-500">
                            +
                        </span>
                    </label>
                </div>
                <InputError :message="translate(form.errors.theme)" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">{{ translate('Save') }}</PrimaryButton>

            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">{{ translate('Saved') }}</p>
            </Transition>
        </div>
    </form>
</section></template>