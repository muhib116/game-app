<template>
  <Master>
    <div className="p-6">
      <div className="relative">
        <span className='absolute top-0 left-0 w-full h-full bg-white bg-opacity-50 pointer-events-none'></span>
        <img :src="image_one" className='h-[75vh] block w-full object-cover object-center' />
        <div className="absolute bottom-0 p-4 h-full flex flex-col justify-end overflow-y-auto py-6">
          <div className="max-h-full">
            <p className='text-sm font-extrabold mb-2'>This is your game: </p>
            <p className='w text-4xl leading-9 mb-1'>Get to know paris in 3 hours</p>
            <p className="italic">Grab items, take photos and taste the french cusine</p>
          </div>
        </div>
      </div>
      <Link :href="route('instruction')">
        <Button label="VIEW INSTRUCTIONS" class='mt-5' />
      </Link>
    </div>
  </Master>
</template>

<script setup>
  import Master from './Master.vue'
  import image_one from '@/Assets/image-one.jpg'
  import Button from '@/Components/Global/Button.vue'
  import { Link } from '@inertiajs/inertia-vue3';
</script>