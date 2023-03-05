<template>
  <Master>
      <component :is="componentList[components[index].name]" />
      <!-- <button @click="changeTask" class='shadow px-4 py-2 rounded mx-auto block'>Change Template</button> -->
      
  </Master>
</template>

<script setup>
  import useConnfiguration from '@/Components/Backend/Game/useConnfiguration';
  import useTaskCreate from '@/Components/Backend/Game/useTaskCreate';
  import { ref } from 'vue'
  import Master from './Master.vue'

  const { components, componentList } = useTaskCreate() 
  const { config, gamePayload } = useConnfiguration();

  const index = ref(1)
  const changeTask = () => {
    if(index.value<3){
      index.value += 1
      return
    }
    index.value = 0
  }
</script>

<style lang="scss" scoped>

</style>