<template>
    <div className="relative">
        <div className='p-6 text-black text-opacity-80 leading-8 text-lg'>
            <div className='text-black text-opacity-80'>
                <h3 className='font-semi-bold text-2xl mb-2 text-center'>Task#3: Quiz Time</h3>
                <p className="">How many city districts is there in Paris? </p>
            </div>
            <div className='grid gap-5 mt-16'>
                <label className='flex gap-4 text-sm items-center'>
                    <input type="checkbox" />
                    12
                </label>
            </div>
            <Button label="WRITE IN TEXT" className='mt-14' />
            <button className='text-sm mt-4 text-center block w-full'>Skip</button>
        </div>
    </div>
</template>

<script setup>
    import Button from '@/Components/Global/Button.vue'
    defineProps({
        controlBy: {
            type: String,
            default: null
        }
    })
</script>

<style lang="scss" scoped>

</style>