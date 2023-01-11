<template>
    <nav className='p-5 bg-white border-t flex text-gray-400'>
        <button @click="$emit('handleNav', option)" v-for="option in options" :key="option.id" class="hover:text-black px-3 pl-0" :class="option.isActive && 'text-black'">{{ option.id }}</button>
    </nav>
</template>

<script setup>
    const props = defineProps({
        options: Array,
    })

</script>