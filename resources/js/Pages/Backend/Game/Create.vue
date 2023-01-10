<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Games</p>
        </div>
        <Nav :options="options" :setOptions="options" :setActiveComponents="activeComponent" />
        <components :is="activeComponent" />
    </Master>
</template>

<script setup>
    import { ref } from 'vue'
    import Nav from '@/Components/Backend/Game/Nav.vue'
    import Master from '../Master.vue'
    import LoginSetup from '@/Components/Backend/Game/LoginSetup.vue'
    import InstructionSetup from '@/Components/Backend/Game/InstructionSetup.vue'
    import TaskCreate from '@/Components/Backend/Game/TaskCreate.vue'

    const options = ref([
        {
            id: 'LoginSetup',
            title: 'Login Page Setup',
            component: LoginSetup,
            isActive: true
        },
        {
            id: 'InstructionSetup',
            title: 'Instruction Setup',
            component: InstructionSetup,
            isActive: false
        },
        {
            id: 'TaskCreate',
            title: 'Task Create',
            component: TaskCreate,
            isActive: false
        }
    ])
    
    const activeComponent = ref(LoginSetup)


    const handleNav = (itemId) => {
        // setOptions((prevState) => {
        //     return prevState.map(item => {
        //         item.isActive = item.id == itemId
        //         if(item.isActive){
        //             setActiveComponents(item.component)
        //         }
        //         return item
        //     })
        // })
    }
</script>

<style lang="scss" scoped>

</style>


<!-- 

import Nav from '@/Components/Backend/Game/Nav.vue'
import React, { useState } from 'react'
import Master from '../Master.vue'
import LoginSetup from '@/Components/Backend/Game/LoginSetup.vue'
import InstructionSetup from '@/Components/Backend/Game/InstructionSetup.vue'
import TaskCreate from '@/Components/Backend/Game/TaskCreate.vue'


export default function Create() 
{
    const [Options, setOptions] = useState([
        {
            id: 'LoginSetup',
            title: 'Login Page Setup',
            component: LoginSetup,
            isActive: true
        },
        {
            id: 'InstructionSetup',
            title: 'Instruction Setup',
            component: InstructionSetup,
            isActive: false
        },
        {
            id: 'TaskCreate',
            title: 'Task Create',
            component: TaskCreate,
            isActive: false
        }
    ])

    const [ActiveComponents, setActiveComponents] = useState(LoginSetup)
    return (
        <Master>
            <div className="flex justify-between p-5 bg-white">
                <p className="text-2xl font-bold text-black">Games</p>
            </div>
            <Nav Options={ Options } setOptions={ setOptions } setActiveComponents={ setActiveComponents } />
            { ActiveComponents }
        </Master>
    )
} -->
