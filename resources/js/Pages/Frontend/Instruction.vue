<template>
    <Master :showNavigation="false">
        <div class='p-6'>
            <Button label="INSTRUCTIONS" class='mb-5 py-1 shadow-none rounded-none' />
            <div class="relative">
                <div class='text-sm mb-2 px-4 text-center leading-8 text-black text-opacity-75'>
                    <p>
                        Just text about the game, time limit and 
                        how to solve it. 
                    </p>
                    <p>
                        this text should also be restrictied so is 
                        fits on maximum two screens 
                        scrollingdown. 
                    </p>
                    <p>
                        bla bla bla bla bla bla bla bla blaJust 
                        text about the game, time limit and how 
                        to solve it. 
                    </p>
                    <p>
                        this text should also be restrictied so is 
                        fits on maximum two screens 
                        scrollingdown. 
                    </p>
                    <p>
                        bla bla bla bla bla bla bla bla blaJust 
                        text about the game, time limit and how 
                        to solve it. 
                    </p>
                    <p>
                        this text should also be restrictied so is 
                        fits on maximum two screens 
                        scrollingdown 
                    </p>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                    <p>
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                    </p>
                </div>

                <Link :href="route('start.game')">
                    <Button label="START GAME" class='mt-5' />
                </Link>
            </div>
        </div>
    </Master>
</template>

<script setup>
    import Master from './Master.vue'
    import image_one from '@/Assets/image-one.jpg'
    import Button from '@/Components/Global/Button.vue'
    import { Link } from '@inertiajs/inertia-vue3'
</script>

<style lang="scss" scoped>

</style>