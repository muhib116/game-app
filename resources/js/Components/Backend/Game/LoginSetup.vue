<template>
    <div className='p-5'>
        <Warning 
            title='Make sure you are not using incognito mode' 
            description='As changes are saved locally on your browser, using an incognito browser will erase your progress if you close it. Do not use the incognito mode when building games.'
        />
        <div className="bg-white shadow rounded mt-5">
            <div className="p-4 bg-[#fefefe] border-b font-bold text-black">
                Game Details & Welcome Screen
            </div>
            <div className="p-4 flex gap-5">
                <div>
                    <h2 className='font-bold'>Login Cover photo*</h2>
                    <h3 className='mb-2'>Shown to players before starting the game.</h3>
                    <img src='https://images.unsplash.com/photo-1672508644320-c39f93a9904f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=627&q=80' />
                </div>
                <div className='w-full'>
                    <label className='relative block mt-10 mb-5'>
                        <label className='block'>Cover Photo Upload</label>
                        <input type="file" />
                    </label>
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="floating_game_title" id="floating_game_title" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label htmlFor="floating_game_title" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Title*</label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="text" name="game_code" id="game_code" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label htmlFor="game_code" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Code*</label>
                    </div>
                    <div class="relative z-0 mb-6 w-full group">
                        <input type="password" name="game_password" id="game_password" className="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label htmlFor="game_password" className="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Game Password*</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Warning from '../Warning.vue'
</script>