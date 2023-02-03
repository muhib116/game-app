<template>
  <div class="bg-gray-200">
    <div class='max-w-[768px] mx-auto bg-white h-[100vh] overflow-y-auto relative'>
      <Nav v-if="showNavigation" />
      <div :class="showNavigation && 'mt-[48px]'">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
  import Nav from '@/Components/Frontend/Nav/index.vue'
  import { get } from 'lodash'

  defineProps({
    showNavigation: {
      type: Boolean,
      default: true,
    },
    gameData: {
      type: Object,
      default: []
    }
  });
</script>