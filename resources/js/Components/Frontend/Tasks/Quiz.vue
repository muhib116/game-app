<template>
    <div class="relative">
        <div class='p-6 text-black text-opacity-80 leading-8 text-lg'>
            <div class='text-black text-opacity-80'>
                <input 
                    v-if="controlBy=='admin'" 
                    v-model="getSelected(gamePayload.tasks).data.title"
                    type="text" placeholder="Title"
                    class="w-full border-0 text-center"
                />
                <h3 v-else class='font-semi-bold text-2xl mb-2 text-center'>{{ data.title }}</h3>
                <input 
                    v-if="controlBy=='admin'"
                    class="text-center border-0 w-full"
                    v-model="getSelected(gamePayload.tasks).data.description" type="text"
                >
                <p v-else class="text-center border-0 w-full">{{ data.description }}</p>
            </div> 
            <div class='grid gap-5 mt-16' v-if="controlBy=='admin'">
                <template v-for="(item, index) in getSelected(gamePayload.tasks).data.options" :key="index">
                    <label class='flex gap-4 text-sm items-center'>
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
            <div class='grid gap-5 mt-16' v-else> 
                <template v-for="(item, index) in data.options" :key="index">
                    <label class='flex gap-4 text-sm items-center'>
                        <input 
                            type="checkbox" 
                            v-model="item.name"
                            :checked="item.isChecked" 
                        />
                        {{ item.name }}
                    </label>
                </template>
            </div>
            <Button v-if="controlBy!='admin'" label="WRITE IN TEXT" class='mt-14' /> 
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
        },
        data: {
            type: Object,
            default: {}
        }
    })
</script>

<style lang="scss" scoped>

</style>