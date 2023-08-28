<template>
    <Master :showNavigation="true">
        <div class='h-full'>
            <div class="h-full relative" v-if="selectSteap(gameData)">
                <component :is="componentList[selectSteap(gameData).component]" :data="selectSteap(gameData)" />
                <div v-if="Number(gameData.instruction.length) != index + 1">
                    <button class='absolute right-4 bottom-4 z-20 w-[100px] h-[100px] bg-[var(--fave)] text-[var(--color)] font-black !text-2xl rounded-full' @click="nextSteap(gameData)">
                        {{ translate('Next', 'en') }}
                    </button>
                </div>
                <Link 
                    v-else
                    :href="`${$page.props.ziggy.url}/start-game/${get(gameData, 'username')}/${get(gameData, 'login.gameCode')}`" 
                    class='absolute right-4 bottom-4 z-20 w-[100px] h-[100px] flex items-center justify-center bg-[var(--fave)] text-[var(--color)] font-black !text-2xl rounded-full'
                >
                    {{ translate('Start', 'en') }}
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
import useLanguage from '@/useLanguage'
const { asideActive } = useGlobalSetting();

defineProps({
    gameData: Object
});

const { translate } = useLanguage()

const { componentList, index, selectSteap, nextSteap, shouldShow } = useGameHandle();

onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const pageSize = urlParams.get('q');
    index.value = Number(pageSize);
});
</script>

<style lang="scss" scoped>

</style>