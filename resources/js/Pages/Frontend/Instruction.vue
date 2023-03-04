<template>
    <Master :showNavigation="true">
        <div class=''>
            <div class="relative">
                <template v-if="selectSteap(gameData)">
                    <component :is="componentList[selectSteap(gameData).component]" :data="selectSteap(gameData)" />
                </template>
                <div v-if="Number(gameData.instruction.length) != index + 1">
                    <Button label="Next" class='mt-5' @click="nextSteap(gameData)" />
                </div>
                <Link :href="`${$page.props.ziggy.url}/start-game/${get(gameData, 'username')}/${get(gameData, 'login.gameCode')}`" v-else>
                    <Button label="START GAME" class='mt-5' />
                </Link>
            </div>
        </div>
    </Master>
</template>

<script setup>
import Master from './Master.vue'
import image_one from '@/Assets/image-one.jpg'
import Button from '@/Components/Global/Button.vue'
import { Link } from '@inertiajs/inertia-vue3'
import useGameHandle from '@/Pages/Frontend/useGameHandle'
import { ref, onMounted, watch } from 'vue'
import { get } from 'lodash'
import { useGlobalSetting } from '@/helper'
const { asideActive } = useGlobalSetting();

defineProps({
    gameData: Object
});
const { componentList, index, selectSteap, nextSteap, shouldShow } = useGameHandle();

onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const pageSize = urlParams.get('q');
    index.value = Number(pageSize);
});
</script>

<style lang="scss" scoped>

</style>