<template>
  <div className="px-5 flex justify-between items-center shadow bg-white sticky top-0 z-50">
      <a href="#">Logo</a>
      <div className="flex gap-3 items-center">
          <a href="#" className='py-4'>{{ $page.props.auth.user.name }}</a>
          <Link :href="route('logout')" method="POST">
              <svg className='w-5 h-5' width="32" height="32" viewBox="0 0 32 32">
                  <path d="M6 30h12a2.002 2.002 0 0 0 2-2v-3h-2v3H6V4h12v3h2V4a2.002 2.002 0 0 0-2-2H6a2.002 2.002 0 0 0-2 2v24a2.002 2.002 0 0 0 2 2Z"/>
                  <path d="M20.586 20.586 24.172 17H10v-2h14.172l-3.586-3.586L22 10l6 6-6 6-1.414-1.414z"/>
              </svg>
          </Link>
      </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>