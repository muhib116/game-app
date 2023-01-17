<template>
    <div className='relative border h-full flex flex-col'>
        <div className='text-sm mb-4 text-center leading-8 text-black text-opacity-75'>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14602.255536706296!2d90.36542960000001!3d23.79853955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1671373285798!5m2!1sen!2sbd"  
                height="300" 
                className='w-full'
                allowFullScreen="" 
                loading="lazy" 
                referrerPolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>
        <div className='p-6 text-black text-opacity-80 text-center leading-8 text-lg h-full'>
            <input className="block w-full text-3xl mb-4 text-center" v-model="data.title" />
            <textarea 
                className='w-full block text-center bg-transparent border-none mb-2' 
                v-model="data.description"
                rows="0"
            />
        </div>
        <button className='bg-green-500 py-2 px-4 w-full text-white font-bold self-end'>Save</button>
    </div>
</template>

<script setup>
    defineProps({
        data: Object
    })
</script>

<style lang="scss" scoped>

</style>