<template>
    <slot></slot>

    <div @click.self="showLanguageModal=false" class="fixed top-0 left-0 z-[99991] bg-slate-500/20 backdrop-blur w-full h-full flex items-center justify-center" v-if="showLanguageModal">
        <div class="bg-white rounded-md p-5 max-w-[400px] w-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <button @click="showLanguageModal = false" class="w-[40px] h-[40px] bg-slate-100 text-red-600 font-bold text-5xl rounded-full flex items-center justify-center absolute -top-14 -right-14">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="text-black z-[99991] text-center">
                <svg style="width:56px;height:56px;" class="w-14 h-14 mx-auto" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"></path>
                </svg>
            </div>

            <div class="flex gap-5 !justify-center mt-5 select-none">
                <label class="flex gap-2 !text-black select-none items-center">
                    <input v-model="selectedLanguage" @change="e => languageChanger(e.target.value)" class="lan_inp l1" type="radio" value="en" name="lang" checked />
                    English
                </label>
                <label class="flex gap-2 !text-black select-none items-center">
                    <input  v-model="selectedLanguage" @change="e => languageChanger(e.target.value)" class="lan_inp l2" type="radio" value="no" name="lang" />
                    Norwegian
                </label>
            </div>
        </div>
    </div>

    <!-- <span @click="showLanguageModal = true" class="z-[99990] text-center shadow cursor-pointer fixed top-1/2 right-2 bg-slate-700 text-white p-3 rounded-full flex items-center justify-center">
        <svg style="width:20px;height:20px;" class="flex w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="796 796 200 200" xml:space="preserve">
            <path d="M973.166 818.5H818.833c-12.591 0-22.833 10.243-22.833 22.833v109.333c0 12.59 10.243 22.833 22.833 22.833h154.333c12.59 0 22.834-10.243 22.834-22.833V841.333c0-12.59-10.244-22.833-22.834-22.833zM896 961.5h-77.167c-5.973 0-10.833-4.859-10.833-10.833V841.333c0-5.974 4.86-10.833 10.833-10.833H896v131zm82.58-89.371c-.547 9.145-5.668 27.261-20.869 39.845 4.615 1.022 9.629 1.573 14.92 1.573v12c-10.551 0-20.238-1.919-28.469-5.325-7.689 3.301-16.969 5.325-28.125 5.325v-12c5.132 0 9.924-.501 14.366-1.498-8.412-7.016-13.382-16.311-13.382-26.78h11.999c0 8.857 5.66 16.517 14.884 21.623 4.641-2.66 8.702-6.112 12.164-10.351 5.628-6.886 8.502-14.521 9.754-20.042h-49.785v-12h22.297v-11.986h12V864.5h21.055c1.986 0 3.902.831 5.258 2.28a7.213 7.213 0 0 1 1.933 5.349z" />
            <path d="m839.035 914.262-4.45 11.258h-15.971l26.355-61.09h15.971l25.746 61.09h-16.583l-4.363-11.258h-26.705zm13.44-34.386-8.902 22.604h17.629l-8.727-22.604z" />
        </svg>
    </span> -->
</template>

<script setup>
import { ref, onMounted } from 'vue'
import useLanguage from '@/useLanguage'
const { selectedLanguage, languageList, showLanguageModal, languageChanger } = useLanguage()

onMounted(()=>{
    if (localStorage.getItem('language') != 'no') {
        localStorage.setItem('language', 'no')
        location.reload()
    }
    // languageChanger('no')
});

</script>