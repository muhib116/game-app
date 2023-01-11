<template>
    <div class="relative">
        <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
            <img 
                src='https://images.unsplash.com/photo-1671314888598-eff877d10f85?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80' 
                alt=""
                class='w-full block mb-6'
            />
            <div v-for="(item, index) in taskData" class='text-black text-opacity-80' :key="index">
                <h3 class='font-semi-bold text-2xl mb-2'>{{ item.title }}</h3>
                <p>{{ item.description }}</p>
            </div>

            <label class='px-4 py-1 bg-orange-300 shadow rounded block w-full relative mt-14'>
                UPLOAD IMAGE
                <input type='file' hidden />
            </label>
            <button class='text-sm mt-4'>Skip</button>
        </div>
    </div>
</template>

<script setup>
    import useDataSource from "@/Pages/Frontend/useDataSource"

    const settings = {
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    }
    const { taskData } = useDataSource()
</script>

<style lang="scss" scoped>

</style>