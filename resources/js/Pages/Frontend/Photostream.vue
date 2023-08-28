<template>
    <Master  :showNavigation="true" :gameData="gameData">
        <div class="py-5 px-5 bg-[var(--fave)] text-[var(--color)] h-full overflow-y-auto">
            <div class="font-bold text-xl">
                {{ translate('Photo Stream', 'en') }} 
            </div>
            <div class="py-5 myDiv flex flex-col gap-1" v-if="get(gameData, 'login.photoStream')">
                <template v-if="!isEmpty(byGroup())">
                    <template v-for="(team, teamcode) in byGroup()" :key="teamcode">
                        <div class="mt-2 font-semibold">
                            {{ get(getTeam(gameData.login.team, teamcode), 'teamName') }}
                        </div>
                        <div v-for="(item, index) in team" :key="index" class="grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                            <img v-if="item.image" :src="item.image" alt="">
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </Master>
</template>
<script setup>
import Master from './Master.vue'
import { isEmpty, forEach, get, find } from 'lodash';
import { onMounted, ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import { Link, usePage } from '@inertiajs/inertia-vue3'
import useLanguage from '@/useLanguage';
const props = defineProps({
    gameData: Object
})

const result = ref([]);
const {translate} = useLanguage()

onMounted(()=>{
    generateResult()
})


const getTeam = (teams, teamcode) => find(teams, item => item.teamCode == teamcode)

const byGroup = () => {
    return result.value.reduce(function (r, a) {
                    r[a.team] = r[a.team] || [];
                    r[a.team].push(a);
                    return r;
                }, Object.create(null));
}

const generateResult = () => {
    result.value = [];
    let tasks = usePage().props.value.gameData.tasks;
    forEach(tasks, item => {
        if (item.component == "UploadImage") {
            forEach(item.userAnswer, ans => {
                result.value.push(ans);
            })
        }
    })
}


</script>

<style scoped>
.myDiv:empty::before{
    content: 'No photo found!';
    color: #0005;
    font-size: 15px;
}
</style>