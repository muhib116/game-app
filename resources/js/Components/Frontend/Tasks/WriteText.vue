<template>
    <div className="relative">
        <div className='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
            <img 
                src='https://plus.unsplash.com/premium_photo-1664100478021-c3b6599f0d7b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxOXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60' 
                alt=""
                className='w-full block mb-6'
            />
            <input
                v-model="getSelected(gamePayload.tasks).data.title"
                v-if="controlBy=='admin'"
                class="font-semi-bold text-2xl mb-2 border-0 w-full text-center"
                type="text"
            />
            <h3 v-else className='font-semi-bold text-2xl mb-2'>{{ data.title }}</h3>
            <input 
                v-model="getSelected(gamePayload.tasks).data.description"
                v-if="controlBy=='admin'"
                type="text"
                class="border-0 text-center"
            />
            <p v-else>{{ data.description }}</p>
            

            <Button v-if="controlBy!='admin'" label="WRITE IN TEXT" className='mt-14' />
            <button v-if="controlBy!='admin'" className='text-sm mt-4'>Skip</button>
        </div>
    </div>
</template>

<script setup>
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'
    import useDataSource from "@/Pages/Frontend/useDataSource"
    defineProps({
        controlBy: {
            type: String,
            default: null
        },
        data: {
            type: Object,
            default: {}
        }
    });

    const { gamePayload } = useConnfiguration();
    const { getSelected } = useTaskCreate();
    const { taskData } = useDataSource()

</script>