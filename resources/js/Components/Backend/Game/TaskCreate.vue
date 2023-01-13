<template>
    <div class='p-5'>
        <div class="bg-white shadow rounded mt-5">
            <div class="p-4 bg-[#fefefe] border-b font-bold text-black">
                Task Create
            </div>
            <div class="p-4 flex gap-5">
                <span class='font-bold'>Add Template: </span> 
                <button v-for="item in components" :key="item.name" @click="addTemplate(item, gamePayload.tasks)" >{{ item.name }}</button>
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
                    {{ item.name }}
                </h1>
            </div>
            <div class="w-full p-4">
                <component :is="getSelectedComponent(gamePayload.tasks)" />
            </div>
        </div>
    </div>
</template>

<script setup>
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate.js'
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration.js'
    import QRCodeFinder from '@/Components/Frontend/Tasks/QRCodeFinder.vue'
    import { onMounted } from '@vue/runtime-core'

    const { components, componentList, makeSelected, addTemplate, removeItem } = useTaskCreate() 
    const { config, gamePayload } = useConnfiguration();

    const getSelectedComponent = (tasks) => {
        let selectedItem = tasks.find(item => item.isSelected);
        if (selectedItem) {
            return componentList.value[selectedItem.component];
        }
        return;
    } 
</script>

<style lang="scss" scoped>

</style>