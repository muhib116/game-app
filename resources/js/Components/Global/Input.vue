<template>
    <label class='relative'>
        <input 
            @input="handleInput"
            :type="type"
            class='border-0 border-b bg-transparent w-full block pl-0 py-3 focus:ring-0 focus:border-orange-300'
            @focus="isFocused = true"
            @blur="!input.length ? isFocused = false : ''"
        />
        <span 
            class="absolute top-[50%] transform -translate-y-1/2 left-0 transition-all"
            :class="isFocused && 'text-sm -top-[0%] opacity-90 text-orange-300'"
        >
            { label }
        </span>
    </label>
</template>

<script setup>
    import { ref } from 'vue'
    const isFocused = ref(false)
    const input = ref('')
    const handleInput = (e) => {
        let target = e.target
        input.value = target.value
    }
    
    defineProps({
        label, type
    })
</script>