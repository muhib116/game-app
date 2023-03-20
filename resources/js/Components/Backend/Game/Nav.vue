<template>
    <nav className='p-5 bg-white border-t shadow flex text-gray-500 gap-4'>
        <button 
            @click="$emit('handleNav', option)" 
            v-for="option in options" 
            :key="option.id" 
            class="bg-slate-200 py-2 px-3 rounded text-black"
            :class="option.isActive ? '!text-white !bg-[var(--faveDark)]' : ''">
            {{ option.title }}
        </button>
    </nav>
</template>

<script setup>
    const props = defineProps({
        options: Array,
    })

</script>