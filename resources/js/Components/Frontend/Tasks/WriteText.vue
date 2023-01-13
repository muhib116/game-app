<template>
    <div className="relative">
        <div className='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
            <img 
                src='https://plus.unsplash.com/premium_photo-1664100478021-c3b6599f0d7b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxOXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60' 
                alt=""
                className='w-full block mb-6'
            />
            <div v-for="(item, index) in taskData" className='text-black text-opacity-80' :key="index">
                <h3 className='font-semi-bold text-2xl mb-2'>{{ item.title }}</h3>
                <p>{{ item.description }}</p>
            </div>

            <Button label="WRITE IN TEXT" className='mt-14' />
            <button className='text-sm mt-4'>Skip</button>
        </div>
    </div>
</template>

<script setup>
    import Button from '@/Components/Global/Button.vue'
    import useDataSource from "@/Pages/Frontend/useDataSource"
    const { taskData } = useDataSource()
</script>