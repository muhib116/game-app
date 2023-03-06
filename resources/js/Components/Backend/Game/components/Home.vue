<template>
    <div class="relative h-full flex flex-col" >
      <div class="py-2 px-2 bg-white z-10 flex justify-between items-center gap-3 border-b" v-if="controlBy=='admin'">
        <div class='flex h-[25px] items-center gap-3'>
          <label class='flex gap-2 text-xs items-center'>
            Color:
            <span class="w-6 h-3 bg-[var(--dbg)] border-[1px] cursor-pointer" :style="`--dbg: ${data.settings.color}`"></span>
            <input v-model="data.settings.color" type="color" class='w-4 h-4 absolute opacity-0' />
          </label>
          <label class='flex gap-2 items-center text-xs'>
            Opacity:
            <input type="number" v-model="data.settings.opacity" min="0" max="100" class='w-12 h-4 bg-transparent block px-0 pl-1 text-xs border-1' />
          </label>
          <label class='cursor-pointer flex gap-2 text-xs items-center'>
            Image
            <input type='file' hidden @change="(e) => {
              handleUpload(e.target.files[0], e);
            }" />
            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.213 6.639c-.276 0-.546.025-.809.068C13.748 4.562 11.716 3 9.309 3c-2.939 0-5.32 2.328-5.32 5.199 0 .256.02.508.057.756a3.567 3.567 0 0 0-.429-.027C1.619 8.928 0 10.51 0 12.463S1.619 16 3.617 16H8v-4H5.5L10 7l4.5 5H12v4h3.213C17.856 16 20 13.904 20 11.32c0-2.586-2.144-4.681-4.787-4.681z" />
            </svg>
          </label>
        </div>
        <label class='cursor-pointer flex gap-2 text-xs items-center'>
          Show
          <input type="checkbox" v-model="data.show" />
        </label>
      </div>
      <div class="relative h-full">
        <span class='absolute top-0 left-0 w-full h-full bg-white bg-opacity-[var(--bgOpacity)] pointer-events-none' :style="`--bgOpacity: ${(data.settings.opacity / 100).toFixed(3)}`"></span>
        <img v-if="data.settings.image" :src="data.settings.image" class='h-full block w-full object-cover object-center' />
        <div class="absolute bottom-0 p-4 h-full flex flex-col justify-end overflow-y-auto py-6 mb-24">
          <div class="max-h-full" :style="`--dbg: ${data.settings.color}`">
            
            <input v-if="controlBy=='admin'" v-model="data.title" class='text-sm font-extrabold mb-2 bg-transparent border-0 text-[var(--dbg)]' />
            <p v-else class="text-sm font-extrabold mb-2 bg-transparent border-0 text-[var(--dbg)]">{{ data.title }}</p>

            <textarea v-if="controlBy=='admin'" class='w-full text-[var(--dbg)] text-4xl leading-9 mb-1 bg-transparent border-0 h-auto' v-model="data.subtitle" />
            <p v-else class="w-[85%] text-[var(--dbg)] text-4xl leading-9 mb-1 bg-transparent border-0 h-auto">{{ data.subtitle }}</p>
            <textarea v-if="controlBy=='admin'" class="italic text-[var(--dbg)] bg-transparent border-0 block w-full" rows="5" v-model="data.description" />
            <p v-else class="italic text-[var(--dbg)] bg-transparent border-0 block w-full">{{ data.description }}</p>
          </div>
        </div>
      </div>
      <template v-if="controlBy=='admin'">
        <button v-if="data.settings.image" @click="handleRemove(data.settings.image)" className='bg-red-500 py-2 px-4 w-full text-white font-bold self-end'>Remove Image</button>
      </template>
      <!-- <button className='bg-[var(--fave)] py-2 px-4 w-full text-white font-bold'>Save</button> -->
    </div>
  
</template>

<script setup>
import { onMounted } from 'vue'
import useFileUpload from '@/useFileUpload';

const { handleImageUpload, deleteImage } = useFileUpload();
const props = defineProps({
  data: Object,
  controlBy: {
    type: String,
    default: null,
  }
})

async function handleRemove(oldLink) {
      let data = props.data;
      if (oldLink) {
          await deleteImage(oldLink);
          data.settings.image = null;
      }
  }

const handleUpload = async (file, e) => {
  let data = props.data;
  const response = await handleImageUpload(file);
  if (response.status == 'error') {
    console.log('error');
  }
  if (response.status == 'success') {
    let old = data.settings.image;
    if (old) {
      deleteImage(old);
    }
    data.settings.image = response.path;
    e.target.value = null;
  }
}

const shouldShow = (controlBy, data) => {
  if (controlBy=='admin') {
    return true;
  }
  if (data.show == true) {
    return true;
  }
  return false;
}
</script>