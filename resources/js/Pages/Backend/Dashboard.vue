<template>
  <Master>
    <div class="px-4 py-5">
      <div class="grid justify-center pt-4 pb-8">
        <h1 v-if="get($page.props, 'auth.user.type') == 'gamehost'" class="text-black text-2xl font-bold">
          {{ translate('Welcome to Gamehost') }}
        </h1>
        <h1 v-else class="text-black text-2xl font-bold">
          {{ translate('Welcome to Gamehost') }}
        </h1>
        <!-- {{ translate(`Welcome to ${get($page.props, 'auth.user.type') == 'gamehost' ? 'Gamehost' : 'Admin'} dashboard`) }} -->
      </div>
      <Widgets />

      <!-- <div class="py-5">
        <div class="bg-white px-5 py-10 shadow-md rounded flex flex-col items-center justify-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-44 h-44 text-slate-500" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="9" cy="12" r="1"></circle>
            <circle cx="15" cy="12" r="1"></circle>
            <path d="M7.5 7.5c3.5 -1 5.5 -1 9 0"></path>
            <path d="M7 16.5c3.5 1 6.5 1 10 0"></path>
            <path d="M15.5 17c0 1 1.5 3 2 3c1.5 0 2.833 -1.667 3.5 -3c.667 -1.667 .5 -5.833 -1.5 -11.5c-1.457 -1.015 -3 -1.34 -4.5 -1.5l-1 2.5"></path>
            <path d="M8.5 17c0 1 -1.356 3 -1.832 3c-1.429 0 -2.698 -1.667 -3.333 -3c-.635 -1.667 -.476 -5.833 1.428 -11.5c1.388 -1.015 2.782 -1.34 4.237 -1.5l1 2.5"></path>
          </svg>
        </div>
      </div> -->
    </div>
  </Master>
</template>

<script setup>
import Widgets from '@/Components/Backend/Dashboard/Widgets.vue';
import Master from '@/Pages/Backend/Master.vue'
import { translate } from '@/useLanguage';
import { get } from 'lodash'
</script>