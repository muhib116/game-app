<template>
  <Master :showNavigation="false">
    <div class="py-4 px-8 h-[100vh] grid items-center bg-no-repeat bg-cover relative text-white text-opacity-80 wrapper" :style="`background-image: url(${game.image})`">
      <div class="relative z-10 box grid max-h-[400px] h-full">
        <h1 class='text-4xl font-black text-center self-start'>Sign In</h1>
        <form class="grid gap-10 self-end" @submit.prevent="handleAuthorize"> 
          <input class="text-black" label='Game code' type='text' v-model="gameForm.team" placeholder="Team Code" required /> 
          <input class="text-black" label='Game code' type='text' v-model="gameForm.gameCode" placeholder="Game Code" required /> 
          <input class="text-black" label='Password' type='text' v-model="gameForm.password" placeholder="Game Password" required /> 
          <Button type="submit" label='SIGN IN' />
        </form>
      </div>
    </div>
    <template v-if="showFlash">
      <FlashScreen @close="handleCloseFlash" v-model="showFlash" />
    </template>
    <template v-if="showPresentedBy">
      <PresentedByScreen @closePresent="(e) => handlePresentedBy(e)" v-model="showPresentedBy" :game="game" />
    </template>
  </Master>
</template>

<script setup>
import Button from '@/Components/Global/Button.vue'
import Input from '@/Components/Global/Input.vue'
import Master from '@/Pages/Frontend/Master.vue'
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3';
import FlashScreen from '@/Components/Frontend/Popup/FlashScreen.vue';
import PresentedByScreen from '@/Components/Frontend/Popup/PresentedByScreen.vue';
import {ref} from 'vue'

const gameForm = useForm({
  gameCode: '',
  password: '',
  team: '',
});

defineProps({
  game: {
    type: Object,
    default: {}
  },
});

const showFlash = ref(true)
const showPresentedBy = ref(false)

const handleCloseFlash = () => {
  showFlash.value=false
  showPresentedBy.value=true
}

const handlePresentedBy = (e) => {
  showPresentedBy.value = false
}

const handleAuthorize = () => {
  Inertia.post(route('authorizeGame'), gameForm, {
    onSuccess(res) {
      if (res.props.flash.error) {
        alert(res.props.flash.error);
      }
    },
    onError(e) {
      alert('Opps! Invalid input');
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