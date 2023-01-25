<template>
    <Master :showNavigation="false">
        <div class="relative">
            <div class='text-sm mb-4 text-center leading-8 text-black text-opacity-75'>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14602.255536706296!2d90.36542960000001!3d23.79853955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1671373285798!5m2!1sen!2sbd"  
                    height="300" 
                    class='w-full'
                    allowFullScreen="" 
                    loading="lazy" 
                    referrerPolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
            <div class='p-6 text-black text-opacity-80 text-center leading-8 text-lg'>
                <p class="text-3xl mb-4">
                    Your start point
                </p>
                <p>
                    This is were your team should start your game.
                </p>
                <p>
                    Please push start when you are in the right address. 
                </p>

                <!-- <Link :href="route('task')">
                    <Button label="START" class='mt-10' />
                </Link> -->
            </div>
        </div>
    </Master>
</template>

<script setup>
    import Master from './Master.vue'
    import Button from '@/Components/Global/Button.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    defineProps({});
</script>

<style lang="scss" scoped>

</style>