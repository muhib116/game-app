<template>
    <div class="relative">
        <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
            <img 
                src='https://images.unsplash.com/photo-1671314888598-eff877d10f85?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80' 
                alt=""
                class='w-full block mb-6'
            />
            <div class='text-black text-opacity-80'>
                <div v-if="controlBy=='admin'">
                    <input
                        type="text"
                        class='font-semi-bold text-2xl mb-2 border-0'
                        placeholder="Game title"
                        v-model="getSelected(gamePayload.tasks).data.title"
                    />
                </div>
                <h3 v-else class='font-semi-bold text-2xl mb-2'>
                    {{ item.title }}
                </h3>
                <input
                    v-if="controlBy=='admin'"
                    v-model="getSelected(gamePayload.tasks).data.description"
                    class="text-black text-opacity-80 border-0 p-0 text-center" type="text" 
                    placeholder="Title" 
                />
                <p v-else>{{ item.description }}</p>
            </div> 

            <label v-if="controlBy!='admin'" class='px-4 py-1 bg-orange-300 shadow rounded block w-full relative mt-14'>
                UPLOAD IMAGE
                <input type='file' hidden />
            </label>
            <button v-if="controlBy!='admin'" class='text-sm mt-4'>Skip</button>
        </div>
    </div>
</template>

<script setup>
    import useDataSource from "@/Pages/Frontend/useDataSource"
    import useTaskCreate from "@/Components/Backend/Game/useTaskCreate";
    import useConnfiguration from "@/Components/Backend/Game/useConnfiguration";


    defineProps({
        controlBy: {
            type: String,
            default: null
        }
    });

    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();

    const settings = {
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1
    }
</script>

<style lang="scss" scoped>

</style>