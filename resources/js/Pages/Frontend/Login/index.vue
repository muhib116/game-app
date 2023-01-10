<template>
  <Master showNavigation={false}>
    <div 
      class="py-4 px-8 h-[100vh] grid items-center bg-no-repeat bg-cover relative text-white text-opacity-80"
      :class="wrapper"
    >
        <div class="relative z-10 box grid max-h-[400px] h-full">
          <h1 class='text-4xl font-black text-center self-start'>Sign In</h1>
          <div class="grid gap-10 self-end">
              <Input label='Game code' type='text' />
              <Input label='Password' type='text' />
              <Button label='SIGN IN' />
          </div>
        </div>
    </div>
</Master>
</template>

<script setup>
  import classes from './style.module.css'
  import Button from '@/Components/Global/Button'
  import Input from '@/Components/Global/Input.vue'
  import Master from '@/Pages/Frontend/Master.vue'
</script>

<style scoped>
  .wrapper{
    background-image: url(./login-bg.jpg);
  }

  .wrapper::before{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    content: '';
    background-color: #000000c2;
  }
</style>