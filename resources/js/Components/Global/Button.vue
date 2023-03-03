<template>
  <button class="px-4 py-2 bg-[var(--fave)] shadow rounded block w-full relative">
    {{ label }}
    <span v-if="isLoading" class='absolute right-2 top-[50%] transform -translate-y-1/2'>
      <svg class='block animate-spin font-bolder' width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.2" fillRule="evenodd" clipRule="evenodd" d="M12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19ZM12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="black"/>
        <path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z" fill="black"/>
      </svg>
    </span>
  </button>
</template>

<script setup>
  defineProps({
    label: String,
    isLoading: {
      type: Boolean,
      default: false
    }
  })
</script>