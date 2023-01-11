<template>
  <div className="relative border h-full flex flex-col">
    <div className="py-2 px-2 bg-white z-10 flex justify-between items-center gap-3 border-b">
      <div className='flex h-[25px] items-center gap-3'>
        <label className='flex gap-2 text-xs items-center'>
          Color: 
          <span className="w-6 h-3 bg-red-300 border-[1px] cursor-pointer"></span>
          <input type="color" className='w-4 h-4 absolute opacity-0' />
        </label>
        <label className='flex gap-2 items-center text-xs'>
          Opacity: 
          <input type="number" :value="data.opacity" min="0" max="100" className='w-12 h-4 bg-transparent block px-0 pl-1 text-xs border-1' />
        </label>
        <label className='cursor-pointer flex gap-2 text-xs items-center'>
          Image
          <input type='file' hidden />
          <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M15.213 6.639c-.276 0-.546.025-.809.068C13.748 4.562 11.716 3 9.309 3c-2.939 0-5.32 2.328-5.32 5.199 0 .256.02.508.057.756a3.567 3.567 0 0 0-.429-.027C1.619 8.928 0 10.51 0 12.463S1.619 16 3.617 16H8v-4H5.5L10 7l4.5 5H12v4h3.213C17.856 16 20 13.904 20 11.32c0-2.586-2.144-4.681-4.787-4.681z"/></svg>
        </label>
      </div>
      <label className='cursor-pointer flex gap-2 text-xs items-center'>
        Show
        <input type="checkbox" :checked="data.show" />
      </label>
    </div>
    <div className="relative h-full">
      <span className='absolute top-0 left-0 w-full h-full bg-white bg-opacity-50 pointer-events-none'></span>
      <img :src="data.settings.image" className='h-[75vh] block w-full object-cover object-center' />
      <div className="absolute bottom-0 p-4 h-full flex flex-col justify-end overflow-y-auto py-6">
          <div className="max-h-full">
            <input :value="data.title" className='text-sm font-extrabold mb-2 bg-transparent border-0' />
            <textarea className='w-full text-4xl leading-9 mb-1 bg-transparent border-0 h-auto' :value="data.subtitle" />
            <textarea className="italic bg-transparent border-0 block w-full" rows="5" :value="data.description" />
          </div>
      </div>
    </div>
    <button className='bg-green-500 py-2 px-4 w-full text-white font-bold'>Save</button>
  </div>
</template>

<script setup>
  // import Button from '@/Components/Global/Button.vue'
  defineProps({
    data: Object
  })
</script>