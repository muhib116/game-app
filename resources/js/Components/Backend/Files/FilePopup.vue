<template>
    <Transition>
        <div
            v-if="modelValue" 
            class="fixed w-full h-full top-0 left-0 bg-black/5 z-[999] backdrop-blur-sm flex items-center justify-center"
            @click.self="$emit('update:modelValue', false)"
        >
            <div class="bg-white w-full max-w-6xl rounded">
                <div class="flex justify-between w-full border-b py-2 px-3">
                    <div>{{ translate('Upload file') }}</div>
                    <button class="text-xl" @click="$emit('update:modelValue', false)"><i class="fa fa-times"></i></button>
                </div>
                <div class="p-3">
                    <div class="flex items-center justify-center flex-col w-full">
                        <label class="flex flex-col items-center justify-center w-full max-w-sm h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">{{ translate('Click to upload') }}</span> {{ translate('or drag and drop') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ translate('SVG, PNG, JPG or GIF (MAX. 800x400px)') }}
                                </p>
                            </div>
                            <input type="file" class="hidden" />
                        </label>
                        <button class="py-2 px-4 mt-4 bg-[var(--themeColor)] text-white">{{ translate('Upload') }}</button>
                    </div> 
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { translate } from '@/useLanguage';


defineProps({
    modelValue: Boolean
});

</script>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.2s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>