<template>
  <nav class="py-2 px-4 bg-white flex justify-between items-center sticky top-0">
    <Link class="w-[50px]">
    <img class="block w-full" src="https://cdn3d.iconscout.com/3d/premium/thumb/game-controller-4035922-3342601.png" alt="" />
    </Link>
    top nav
  </nav>

  <div class="text-center py-20">

    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">We invest in the world’s potential</h1>
    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
    <div class="flex gap-2 flex-wrap items-center justify-center">
      <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 border-2 border-blue-700 rounded-lg">
      Start now
      <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
      </svg>
    </a>
    <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-blue-700 border-2 border-blue-700 rounded-lg">
      Watch demo
      <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
      </svg>
    </a>
    </div>

  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>