<template>
    <nav className='p-5 bg-white border-t flex text-gray-400'>
        <button v-for="option in options" :key="item.id" class="hover:text-black px-3 pl-0" :class="item.isActive && 'text-black'">{{ item.id }}</button>
    </nav>
</template>

<script setup>
    const props = defineProps({
        options,
        setActiveComponents
    })

</script>