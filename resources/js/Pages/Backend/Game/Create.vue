<template>
    <Master>
        <!-- <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">{{ translate('Games') }}</p> 
        </div> -->
        <Nav :options="options" :setOptions="options" @handleNav="handleNav" />
        <component :is="activeComponent" :next="nextComponent" :gameData="gamePayload" /> 
    </Master>
</template>

<script setup>
    import { onMounted, ref } from 'vue'
    import Nav from '@/Components/Backend/Game/Nav.vue'
    import Master from '../Master.vue'
    import LoginSetup from '@/Components/Backend/Game/LoginSetup.vue'
    import InstructionSetup from '@/Components/Backend/Game/InstructionSetup.vue'
    import TaskCreate from '@/Components/Backend/Game/TaskCreate.vue'
    import FinishingPage from '@/Components/Backend/Game/FinishingPage.vue'
    import useConnfiguration from '@/Components/Backend/Game/useConnfiguration'
    import gameDrain from '@/Components/Backend/Game/gameDrain'
    import { findIndex } from 'lodash'
    import { translate } from '@/useLanguage'

    const { gamePayload } = useConnfiguration();
    const { gameList, saveGame } = gameDrain();
    const props = defineProps({
        id: Number
    });

    const options = ref([
        {
            id: 'LoginSetup',
            title: translate('Login Page Setup'),
            component: LoginSetup,
            isActive: true
        },
        {
            id: 'InstructionSetup',
            title: translate('Instruction Setup'),
            component: InstructionSetup,
            isActive: false
        },
        {
            id: 'TaskCreate',
            title: translate('Task Create'),
            component: TaskCreate,
            isActive: false
        },
        {
            id: 'FinishingPage',
            title: translate('Closing page'),
            component: FinishingPage,
            isActive: false
        },
    ])

    const activeComponent = ref(LoginSetup)

    const handleNav = (selectedOption) => {
        activeComponent.value = selectedOption.component;
        options.value.forEach(item => {
            item.isActive = selectedOption.id == item.id;
        });
        saveGame(gamePayload.value)
    }
    
    const nextComponent = () => {
        saveGame(gamePayload.value)
        // let fnd = options.value.find(item => item.id = activeComponent.value.__name);
        let fnd = findIndex(options.value, (itm) => itm.id == activeComponent.value.__name);
        if (fnd < options.value.length) {
            options.value[fnd].isActive = false;
            options.value[fnd+1].isActive = true;
            activeComponent.value = options.value[fnd+1].component;
        }
    }

    onMounted(async()=> {
        const getFirst = await gameList({
            id: props.id,
            getFirst: true,
        });
        gamePayload.value = getFirst;
        // console.log('pore', gamePayload.value);
    });
</script>

<style lang="scss" scoped>

</style>
