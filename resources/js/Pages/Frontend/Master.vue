<template>
  <GlobalLayout>
    <div class="bg-gray-200 h-full">
    <div class='max-w-[768px] mx-auto bg-white h-full overflow-y-auto relative'>
      <Nav v-if="showNavigation" />
      <div :class="showNavigation && 'mt-[48px]'" style="height: calc(100% - 48px)"> 
        <slot></slot>
      </div>
    </div>
  </div>
  </GlobalLayout>
</template>

<script setup>
  import Nav from '@/Components/Frontend/Nav/index.vue'
import GlobalLayout from '@/Components/GlobalLayout.vue';
  
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