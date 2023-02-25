<template>
    <Master  :showNavigation="true" :gameData="gameData">
        <div class="py-5 px-5 bg-[var(--themeColor)] h-[calc(100vh-48px)] overflow-y-auto">
            <div class="font-bold text-xl">
                Scoreboard 
            </div>
            <div class="py-5">
                <div class="flex justify-between bg-white py-2 px-2">
                    <div class="flex gap-3">
                        <span>1</span>
                        <span>Nathan</span>
                    </div>
                    <span>28,008</span>
                </div>
                <div class="flex justify-between py-2 px-2 border-b border-slate-500/50">
                    <div class="flex gap-3">
                        <span>2</span>
                        <span>Susan</span>
                    </div>
                    <span>15,225</span>
                </div>
                <div class="flex justify-between py-2 px-2 border-b border-slate-500/50">
                    <div class="flex gap-3">
                        <span>3</span>
                        <span>Susan</span>
                    </div>
                    <span>15,225</span>
                </div>
                <div class="flex justify-between py-2 px-2 border-b border-slate-500/50">
                    <div class="flex gap-3">
                        <span>4</span>
                        <span>Susan</span>
                    </div>
                    <span>15,225</span>
                </div>
                <div class="flex justify-between py-2 px-2 border-b border-slate-500/50">
                    <div class="flex gap-3">
                        <span>5</span>
                        <span>Susan</span>
                    </div>
                    <span>15,225</span>
                </div>
            </div>
        </div>
    </Master>
</template>
<script setup>
import Master from './Master.vue'

defineProps({
    gameData: Object
})

</script>