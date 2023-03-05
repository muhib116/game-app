<template>
    <nav className='p-5 bg-white border-t shadow flex text-gray-500'>
        <button 
            @click="$emit('handleNav', option)" 
            v-for="option in options" 
            :key="option.id" 
            class="hover:text-black px-3 pl-0" 
            :class="option.isActive && 'text-black'">
            {{ option.title }}
        </button>
    </nav>
</template>

<script setup>
    const props = defineProps({
        options: Array,
    })

</script>