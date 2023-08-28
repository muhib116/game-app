<template>
    <div class='p-5'>
        <div class="bg-white shadow rounded mt-5">
            <div class="p-4 bg-[#fefefe] border-b font-bold text-black flex justify-between">
                {{ translate('Task Create') }}
                <button @click="tabValidator(next)" class="py-1 px-3 bg-slate-700 text-white rounded">{{ translate('Next') }}</button>
            </div>
            <div class="p-4 flex gap-2 flex-wrap items-center">
                <!-- <span class='font-bold'>{{ translate('Add Template') }}: </span>  -->
                <button 
                    v-for="item in components" 
                    :key="item.name" 
                    @click="addTemplate(item, gamePayload.tasks)" 
                    class="py-2 px-3 bg-slate-200 rounded flex gap-1 items-center"
                >
                    <svg v-if="item.name == 'UploadImage'" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"></path>
                    </svg>
                    <svg v-if="item.name == 'Text'" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
                    </svg>
                    <svg v-if="item.name == 'Quiz'" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path>
                    </svg>
                    <svg v-if="item.name == 'QRCodeFinder'" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"></path>
                    </svg>
                    {{ translate(item.name) }}
                </button>
            </div>
        </div>

        <div class="flex bg-white shadow rounded mt-5">
            <div class="w-[350px] p-4 min-h-[90vh] max-h-[90vh] border-r flex flex-col gap-4 overflow-y-auto">
                <h1 
                    v-for="(item, index) in gamePayload.tasks" 
                    :key="index" 
                    class='min-h-[150px] grid items-center justify-center border cursor-pointer hover:bg-gray-50 relative font-bold'
                    :class="item.isSelected && 'bg-gray-50 border border-gray-600'"
                    @click="makeSelected(item, gamePayload.tasks)"
                >
                    <button class='absolute top-2 right-2' @click="removeItem(index, gamePayload.tasks)">
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="#000" stroke-width="2" d="m7 7 10 10M7 17 17 7"/></svg>
                    </button>
                    {{ translate(item.name) }}
                </h1> 
            </div>
            <div class="w-full p-4">
                <component :is="getSelectedComponent(gamePayload.tasks)" controlBy="admin" />
                <!-- <div class="flex">
                    <Link :href="route('game')" v-if="gamePayload.tasks[gamePayload.tasks.length-1]?.isSelected && !hasError" class="bg-[var(--faveDark)] text-white py-2 px-3 rounded ml-auto block">
                        {{ translate('Finish Up') }}
                    </Link>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script setup>
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate.js'
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration.js'
    import QRCodeFinder from '@/Components/Frontend/Tasks/QRCodeFinder.vue'
    import { onMounted } from '@vue/runtime-core'
    import { tabValidator } from '@/Pages/Backend/validator.js'
    import { Link } from '@inertiajs/inertia-vue3';
    import { translate } from '@/useLanguage';
    import gameDrain, { hasError } from './gameDrain';

    defineProps({
        next: Function
    })
    
    const { components, componentList, makeSelected, addTemplate, removeItem } = useTaskCreate() 
    const { config, gamePayload } = useConnfiguration();

    const getSelectedComponent = (tasks) => {
        let selectedItem = tasks.find(item => item.isSelected);
        if (selectedItem) {
            return componentList.value[selectedItem.component];
        }
        return;
    }

    const handleFinish = () => {}

</script>

<style lang="scss" scoped>

</style>