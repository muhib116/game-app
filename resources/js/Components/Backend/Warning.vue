<template>
    <div v-if="Show && title && description" className="bg-[#fffaeb] rounded overflow-hidden shadow relative">
        <div className="px-5 py-3 bg-[#ffe08a] font-bold">
            {{ title }}
            <button @click="() => setShow(false)">
                <i className="fa fa-close absolute right-4 top-3"></i>
            </button>
        </div>
        <div className="p-5">
            {{ description }}
        </div>
    </div>
</template>

<script setup>
    defineProps({
        title: String, 
        description: String
    })
</script>