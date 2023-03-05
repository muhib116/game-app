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
  // import UploadImage from '@/Components/Frontend/Tasks/UploadImage.vue'
  // import WriteText from '@/Components/Frontend/Tasks/WriteText.vue'
  // import Quiz from '@/Components/Frontend/Tasks/Quiz.vue'
  // import QRCodeFinder from '@/Components/Frontend/Tasks/QRCodeFinder.vue'

  const { components, componentList, makeSelected, addTemplate, removeItem } = useTaskCreate() 
  const { config, gamePayload } = useConnfiguration();
  // let components = [
  //   UploadImage,
  //   WriteText,
  //   Quiz,
  //   QRCodeFinder
  // ]

  const index = ref(0)
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