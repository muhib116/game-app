<template>
  <div className='grid'>
      <Navigation />
      <div className="admin_main_wrapper">
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
</script>

<style lang="scss" scoped>

</style>