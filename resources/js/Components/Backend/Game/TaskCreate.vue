<template>
    <div className='p-5'>
        <div className="bg-white shadow rounded mt-5">
            <div className="p-4 bg-[#fefefe] border-b font-bold text-black">
                Task Create
            </div>
            <div className="p-4 flex gap-5">
                <span className='font-bold'>Add Template: </span>
                <button v-for="item in components" :key="item.name" @click="setConfig(item)" >{{ item.name }}</button>
            </div>
        </div>

        <div className="flex bg-white shadow rounded mt-5">
            <div className="w-[350px] p-4 min-h-[90vh] max-h-[90vh] border-r flex flex-col gap-4 overflow-y-auto">
                <h1 v-for="(item, index) in config" :key="index" className='min-h-[150px] grid items-center justify-center border cursor-pointer hover:bg-gray-50 relative font-bold'>
                    <button className='absolute top-2 right-2'>
                        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" stroke="#000" stroke-width="2" d="m7 7 10 10M7 17 17 7"/></svg>
                    </button>
                    {{ item.name }}
                </h1>
            </div>
            <div className="w-full p-4">
                <QRCodeFinder />
            </div>
        </div>
    </div>
</template>

<script setup>
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate.js'
    import QRCodeFinder from '@/Components/Frontend/Tasks/QRCodeFinder.vue'
    
    const { components, config } = useTaskCreate()
</script>

<style lang="scss" scoped>

</style>