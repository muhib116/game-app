<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">{{ translate('Create game host') }}</p>
        </div>
        <div class="px-5 py-5">
            <div class="bg-white p-5 rounded-md shadow-md">
                <form class="max-w-[500px] grid gap-4" @submit.prevent="saveGameHost">
                    <div class="w-full grid gap-1">
                        <div>{{ translate('Game host name') }}</div>
                        <input type="text" v-model="form.name" :placeholder="translate('Name')" class="w-full" required />
                        <span class="text-red-500" v-if="form.errors.name">{{ form.errors.name }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>{{ translate('Unique game host username') }}</div>
                        <input type="text" v-model="form.username" :placeholder="translate('Username')" class="w-full" required />
                        <span class="text-red-500" v-if="form.errors.username">{{ form.errors.username }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>{{ translate('Unique email') }}</div>
                        <input type="email" v-model="form.email" placeholder="Email" class="w-full" required />
                        <span class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>{{ translate('Password') }}</div>
                        <input type="text" v-model="form.password" :placeholder="translate('Password')" class="w-full" :required="!form.id" />
                        <span class="text-red-500" v-if="form.errors.password">{{ form.errors.password }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <label class="flex gap-2 items-center">
                            <input type="checkbox" v-model="form.status" />
                            {{ translate('Game host status') }}
                        </label>
                        <span class="text-red-500" v-if="form.errors.status">{{ form.errors.status }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>
                            <button type="submit" class="py-2 px-5 bg-slate-800 text-white flex items-center" :disabled="form.processing">
                                <Preloader v-if="form.processing" />
                                <template v-if="form.id">
                                    {{ translate('Update') }}
                                </template>
                                <template v-else>
                                    {{ translate('Save') }}
                                </template>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </Master>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Master from '../Master.vue'
import Preloader from '@/Components/Global/Preloader.vue';
import { watch, onMounted } from 'vue'

import { slug } from '@/helper'
import { get, isEmpty } from 'lodash';
import { translate } from '@/useLanguage';

const props = defineProps({
    gamehost: {
        type: Object,
        default: {}
    }
})

const form = useForm({
    id: null,
    name: null,
    username: null,
    email: null,
    password: null,
    status: true,
})


onMounted(()=> {
    if (get(props.gamehost, 'id')) {
        let gamehost = props.gamehost;
        form.id = gamehost.id;
        form.name = gamehost.name;
        form.username = gamehost.username;
        form.email = gamehost.email;
        form.status = gamehost.status;
        console.log(gamehost.status);
    }
})

const saveGameHost = () => {
    if (form.id) {
        form.post(route('updateGameHost', form.id))
    } else {
        form.post(route('storeGameHost'))
    }
}

watch(()=> form.username, ()=>{
    form.username = slug(form.username)
})


</script>
