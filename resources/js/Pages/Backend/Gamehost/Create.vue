<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Create game host</p>
        </div>
        <div class="px-5 py-5">
            <div class="bg-white p-5 rounded-md shadow-md">
                <form class="max-w-[500px] grid gap-4" @submit.prevent="saveGameHost">
                    <div class="w-full grid gap-1">
                        <div>Game host name</div>
                        <input type="text" v-model="form.name" placeholder="Name" class="w-full" required />
                        <span class="text-red-500" v-if="form.errors.name">{{ form.errors.name }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>Unique game host username</div>
                        <input type="text" v-model="form.username" placeholder="username" class="w-full" required />
                        <span class="text-red-500" v-if="form.errors.username">{{ form.errors.username }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>Unique email</div>
                        <input type="email" v-model="form.email" placeholder="Email" class="w-full" required />
                        <span class="text-red-500" v-if="form.errors.email">{{ form.errors.email }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>Password</div>
                        <input type="text" v-model="form.password" placeholder="username" class="w-full" required />
                        <span class="text-red-500" v-if="form.errors.password">{{ form.errors.password }}</span>
                    </div>
                    <div class="w-full grid gap-1">
                        <div>
                            <button type="submit" class="py-2 px-5 bg-slate-800 text-white flex items-center" :disabled="form.processing">
                                <Preloader v-if="form.processing" />
                                Save
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
import { watch } from 'vue'

import { slug } from '@/helper'

const form = useForm({
    name: null,
    username: null,
    email: null,
    password: null,
})

const saveGameHost = () => {
    form.post(route('storeGameHost'))
}

watch(()=> form.username, ()=>{
    form.username = slug(form.username)
})


</script>
