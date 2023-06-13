<template>
    <Master>
        <div className="flex justify-between p-5 bg-white">
            <p className="text-2xl font-bold text-black">{{ translate('Contacts') }}</p>
        </div>
        <div class="pb-4 px-1">
            <div class="">
                <div class="bg-white rounded-md py-5 px-5 shadow">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <div>{{ translate('Limit') }}</div>
                            <select class="border-gray-300 py-1" v-model="filterData.limit">
                                <option v-for="(item, index) in [2, 10, 20, 30, 50, 100]" :key="index" :value="item">{{ item }}</option>
                            </select>
                        </div>
                        <!-- <div class="flex gap-1">
                            <div>
                                <div>Start date</div>
                                <input type="date" v-model="filterData.start" class="border-gray-300 py-1">
                            </div>
                            <div>
                                <div>End date</div>
                                <input type="date" v-model="filterData.end" class="border-gray-300 py-1">
                            </div>
                        </div> -->
                    </div>
                    <div class="relative overflow-x-auto printArea">
                        <!-- <div class="text-center hidden print:!block border-b border-slate-400">
                            <h1 class="mb-3 text-xl font-bold text-center pb-1">
                                Contact List
                            </h1>
                            <div v-if="filterData.start">
                                Date from: {{ filterData.start }}
                            </div>
                            <div v-if="filterData.end">
                                Date end: {{ filterData.end }}
                            </div>
                        </div> -->
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-2 py-2">{{ translate('Sl') }}</th>
                                    <th scope="col" class="px-2 py-2">{{ translate('Date') }}</th>
                                    <th scope="col" class="px-2 py-2">{{ translate('First Name') }}</th>
                                    <th scope="col" class="px-2 py-2">{{ translate('Last name') }}</th>
                                    <th scope="col" class="px-2 py-2">{{ translate('Email') }}</th>
                                    <th scope="col" class="px-2 py-2">{{ translate('Company') }}</th>
                                    <th scope="col" class="px-2 py-2">{{ translate('Message') }}</th>
                                    <!-- <th scope="col" class="px-2 py-2 w-28 text-right print:hidden">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(sale, index) in sales.data" :key="index" class="bg-white border-b   hover:bg-slate-50">
                                    <td class="px-2 py-2">{{ index + 1 }}</td>
                                    <td class="px-2 py-2">{{ moment(sale.created_at).format('DD-MM-YYYY h:mm a') }}</td>
                                    <td class="px-2 py-2">{{ sale.first_name }}</td>
                                    <td class="px-2 py-2">{{ sale.last_name }}</td>
                                    <td class="px-2 py-2">{{ sale.email }}</td>
                                    <td class="px-2 py-2">{{ sale.company }}</td>
                                    <td class="px-2 py-2">
                                        {{ sale.message }}
                                    </td>
                                    <!-- <td class="px-2 py-2 print:hidden">
                                        <div class="flex gap-5">
                                        </div>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center mt-4 gap-2 justify-between">
                        <span class="text-sm text-gray-700 dark:text-gray-400">
                            {{ translate('Showing') }}
                            <span class="font-semibold text-gray-900 dark:text-slate-200">
                                {{ sales.from }}
                            </span>
                            {{ translate('to') }}
                            <span class="font-semibold text-gray-900 dark:text-slate-200">
                                {{ sales.to }}
                            </span>
                            {{ translate('of') }}
                            <span class="font-semibold text-gray-900 dark:text-slate-200">
                                {{ sales.total }}
                            </span>
                            {{ translate('Entries') }}
                        </span>
                        <div class="inline-flex">
                            <button @click="getContact(sales.prev_page_url)" class="inline-flex items-center px-4 py-2 text-sm select-none font-medium text-white bg-gray-800 rounded-l hover:bg-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" :class="!sales.prev_page_url ? 'opacity-80 cursor-not-allowed pointer-events-none' : ''">
                                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                </svg>
                                {{ translate('Prev') }}
                            </button>
                            <button @click="getContact(`${sales.next_page_url}`)" class="inline-flex items-center px-4 py-2 text-sm select-none font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" :class="!sales.next_page_url ? 'opacity-80 cursor-not-allowed pointer-events-none' : ''">
                                {{ translate('Next') }}
                                <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </Master>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import Master from '../Master.vue'
import { ref, watchEffect } from 'vue'
import Preloader from '@/Components/Global/Preloader.vue';
import moment from 'moment';
import { translate } from '@/useLanguage';

const filterData = ref({
    type: 'all',
    start: null,
    end: null,
    limit: 10,
})

const sales = ref({})

function getContact(url) {
    axios.post(url ? url : route('contacts.filter'), {
        start: filterData.value.start,
        end: filterData.value.end,
        limit: filterData.value.limit,
        type: filterData.value.type
    })
        .then(res => res.data)
        .then(result => {
            sales.value = result;
        })
}

watchEffect(() => {
    getContact();
})

</script>
