<template>
    <div className='p-5'>
        <div className="bg-white shadow rounded mt-5">
            <div className="p-4 bg-[#fefefe] border-b font-bold text-black">
                Game Instruction
            </div>
            <div className="p-4 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
                <div v-for="item in components" :key="item.component">
                    <component :is="item.component" :data="item" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Home from '@/Components/Backend/Game/components/Home.vue'
    import Instruction from '@/Components/Backend/Game/components/Instruction.vue'
    import StartGame from '@/Components/Backend/Game/components/StartGame.vue'
    import image_one from '@/Assets/image-one.jpg'

    const components = [
        {
            component: Home,
            show: false,
            title: 'This is your game:',
            subtitle: 'Get to know paris in 3 hours',
            description: 'Grab items, take photos and taste the french cusine',
            settings: {
                image: image_one,
                opacity: 100,
                color: 'black'
            }
        },
        {
            component: Instruction,
            show: false,
            text: [
                'Just text about the game, time limit and how to solve it.',
                'this text should also be restrictied so is fits on maximum two screens scrollingdown.'
            ],
            settings: {
                image: image_one,
                opacity: 100,
                color: 'black'
            }
        },
        {
            component: StartGame,
            show: false,
            title: ' Your start point',
            description: 'lorem',
            settings: {}
        }
    ]
</script>
