<template>
    <div className="relative">
        <div className='p-6 text-black text-opacity-80 leading-8 text-lg'>
            <div className='text-black text-opacity-80'>
                <input 
                    v-if="controlBy=='admin'" 
                    v-model="getSelected(gamePayload.tasks).data.title"
                    type="text" placeholder="Title"
                    class="w-full border-0 text-center"
                />
                <h3 v-else className='font-semi-bold text-2xl mb-2 text-center'>Task#3: Quiz Time</h3>
                <input 
                    v-if="controlBy=='admin'"
                    class="text-center border-0 w-full"
                    v-model="getSelected(gamePayload.tasks).data.description" type="text"
                >
                <p v-else className="">How many city districts is there in Paris? </p>
            </div>
            <div className='grid gap-5 mt-16' v-if="controlBy='admin'">
                <template v-for="(item, index) in getSelected(gamePayload.tasks).data.options">
                    <label className='flex gap-4 text-sm items-center'>
                        <input 
                            type="checkbox" 
                            v-model="item.name"
                            :checked="item.isChecked" 
                        />
                        {{ item.name }}
                    </label>
                </template>

                <button 
                    @click="addOption(getSelected(gamePayload.tasks).data.options)" 
                    class="p-1 bg-yellow-500 text-white text-sm inline-block max-w-[100px]"
                >
                        Add option
                </button>
            </div>
            <div className='grid gap-5 mt-16' v-else>
                <label className='flex gap-4 text-sm items-center'>
                    <input type="checkbox" />
                    12
                </label>
            </div>
            <Button v-if="controlBy!='admin'" label="WRITE IN TEXT" className='mt-14' />
            <button v-if="controlBy!='admin'" className='text-sm mt-4 text-center block w-full'>Skip</button>
        </div>
    </div>
</template>

<script setup>
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
    import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
    import Button from '@/Components/Global/Button.vue'

    const { gamePayload } = useConnfiguration();
    const { getSelected, addOption } = useTaskCreate();
    
    defineProps({
        controlBy: {
            type: String,
            default: null
        }
    })
</script>

<style lang="scss" scoped>

</style>