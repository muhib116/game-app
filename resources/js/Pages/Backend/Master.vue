<template>
  <div className='grid'>
      <Navigation />
      <div class="admin_main_wrapper" :class="asideActive && 'asideActive'">
        <LeftSidebar />
        <div>
            <slot></slot>
          </div>
      </div>
  </div>
</template>

<script setup>
  import LeftSidebar from '@/Components/Backend/LeftSidebar.vue'
  import Navigation from '@/Components/Backend/Navigation.vue'
  import { useGlobalSetting } from '@/helper';
  const { asideActive, asideToggle } = useGlobalSetting();
</script>

<style lang="scss" scoped>

</style>