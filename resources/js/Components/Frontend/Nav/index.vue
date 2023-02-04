<template>
  <div>
    <div class='flex justify-between px-6 py-3 bg-orange-300 shadow absolute top-0 left-0 right-0'>
      <button @click="asideActive = true">
        <svg class='w-5 h-5' width="24px" height="24px" viewBox="0 0 24 24">
            <g>
              <path fill="none" d="M0 0h24v24H0z"/>
              <path d="M12 3v2H3V3h9zm4 16v2H3v-2h13zm6-8v2H3v-2h19z"/>
            </g>
        </svg>
      </button>
      <div>
        GAME INFO
      </div>
      <div>
        <form @submit.prevent="quiteGame" method="POST">
          <button class="text-white bg-red-500 px-3 rounded">Quit</button>
        </form>
        <!-- <Link :href="route('game_exit')" method="POST" type="button">
          Exit Game
        </Link> -->
      </div>
      <!-- <button class='flex self-end'>
        <svg width="48px" height="48px" viewBox="0 0 48 48" fill="none" class='w-5 h-5' xmlns="http://www.w3.org/2000/svg">
          <rect width="48" height="48" fill="white" fillOpacity="0.01"/>
          <path d="M41.5 10H35.5" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M27.5 6V14" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M27.5 10L5.5 10" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M13.5 24H5.5" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M21.5 20V28" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M43.5 24H21.5" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M41.5 38H35.5" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M27.5 34V42" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
          <path d="M27.5 38H5.5" stroke="black" strokeWidth="4" strokeLinecap="round" strokeLinejoin="round"/>
        </svg>
      </button> -->
    </div>
    <div
      class="absolute z-40 top-0 left-0 right-0 bottom-0 text-sm bg-black bg-opacity-60 transition-opacity"
      :class="asideActive ? 'opacity-100 delay-0' : 'opacity-0 pointer-events-none'"
    >
      <div 
        class="bg-orange-300 h-full w-[250px] transition-all duration-[0.3s] p-4 pt-16 relative flex flex-col gap-2"
        :class="asideActive ? '-ml-0 delay-[0s]' : '-ml-[200px]'"
      > 
        <button @click="asideActive = false" class='absolute right-4 top-4 cursor-pointer'>
          <svg class='w-4 h-4' width="20" height="20" viewBox="0 0 20 20" fill='currentColor'><path d="M10 8.586 2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
        </button>

        <!-- <button class='text-left'>About</button> -->
        <template v-if="get($page.props, 'gameData.instruction')">
          <Dropdown label="Instructions">
            <button 
              class='text-left'
              v-for="(item, index) in get($page.props, 'gameData.instruction')"
              :key="index+Math.random()*50000"
              @click="showIndex($page.props.gameData, index)"
            >
              {{ item.component }}
            </button>
          </Dropdown>
        </template>
        <!-- <Dropdown label='Tasks'>
          <button 
              class='text-left'
              v-for="(item, index) in get($page.props, 'gameData.tasks')"
              :key="index+Math.random()*50000"
              @click="showIndex($page.props.gameData, index)"
            >
              {{ get(item, 'data.title') }}
            </button>
        </Dropdown> -->
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import Dropdown from './Dropdown.vue'
  import { get } from 'lodash'
  import useGameHandle from '@/Pages/Frontend/useGameHandle';
import { useGlobalSetting } from '@/helper';
import { Inertia } from '@inertiajs/inertia';
  const showDrawer = ref(false)
  const { asideActive, closeAside } = useGlobalSetting();
  const { componentList, index, selectSteap, nextSteap, shouldShow, showIndex } = useGameHandle();

  const quiteGame = () => {
    Inertia.post(route('game_exit'));
  }
</script>

<style lang="scss" scoped>

</style>