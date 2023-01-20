<template>
  <Master showNavigation={false}>
    <div class="py-4 px-8 h-[100vh] grid items-center bg-no-repeat bg-cover relative text-white text-opacity-80 wrapper">
      <div class="relative z-10 box grid max-h-[400px] h-full">
        <h1 class='text-4xl font-black text-center self-start'>Sign In</h1>
        <form class="grid gap-10 self-end" @submit.prevent="handleAuthorize">
          <!-- <Input label='Game code' type='text' v-model="gameForm.gameCode" />
          <Input label='Password' type='text' v-model="gameForm.password" /> -->
          <input class="text-black" label='Game code' type='text' v-model="gameForm.gameCode" />
          <input class="text-black" label='Password' type='text' v-model="gameForm.password" />
          <Button type="submit" label='SIGN IN' />
        </form>
      </div>
    </div>
  </Master>
</template>

<script setup>
import Button from '@/Components/Global/Button.vue'
import Input from '@/Components/Global/Input.vue'
import Master from '@/Pages/Frontend/Master.vue'
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';

const gameForm = useForm({
  gameCode: '',
  password: '',
});

defineProps({
  game: {
    type: Object,
    default: {}
  },
});

const handleAuthorize = () => {
  Inertia.post(route('authorizeGame'), gameForm, {
    onSuccess(res) {
      if (res.props.flash.error) {
        alert(res.props.flash.error);
      }
    },
    onError(e) {
      console.log(e);
    }
  });
}

</script>

<style scoped>
.wrapper {
  background-image: url(./login-bg.jpg);
}

.wrapper::before {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  content: '';
  background-color: #000000c2;
}
</style>