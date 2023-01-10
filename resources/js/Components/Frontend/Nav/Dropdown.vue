<template>
    <div className='grid gap-1'>
        <button @click="showDropdown = !showDropdown" 
            className='flex justify-between items-center w-full'
        >
            {{ label }}
            <svg className='w-3 h-3' width="32" height="32" viewBox="0 0 32 32" fill='currentColor'><path d="M4.219 10.781 2.78 12.22l12.5 12.5.719.687.719-.687 12.5-12.5-1.438-1.438L16 22.562Z"/></svg>
        </button>
        {
            <div v-if="showDropdown" className='grid text-left ml-4 text-sm'>
                <slot></slot>
            </div>
        }
    </div>
</template>

<script setup>
    import { ref } from 'vue'
    const showDropdown = ref(false)
    defineProps({
        label: String
    })
</script>