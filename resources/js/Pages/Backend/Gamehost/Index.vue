<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">Gamehost</p>
        </div>
        <div class="px-5 py-5">
            <div class="mt-5 bg-white py-5 px-5 rounded max-w-screen-xl mx-auto shadow-md"> 
                <div class="bg-white overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="text-left font-bold bg-slate-100">
                                <th class="py-2 px-2 text-center">Index</th>
                                <th class="py-2 px-2 text-center">Host Name</th>
                                <th class="py-2 px-2 text-center">Email</th>
                                <th class="py-2 px-2 text-center">Total game</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(host, index) in gamehosts" :key="host.id" class="hover:bg-gray-100 focus-within:bg-gray-100 border-b">
                                <td class="py-3 px-2 text-center">
                                    {{ index + 1 }}
                                </td>
                                <td class="py-3 px-2 text-center">
                                    {{ host.name }}
                                </td>
                                <td class="py-3 px-2 text-center">
                                    {{ host.email }}
                                </td>
                                <td class="text-center">
                                    {{ host.game_count }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </Master>
</template>

<script setup>
import Master from '../Master.vue'
defineProps({
    gamehosts: Array,
});
</script>
