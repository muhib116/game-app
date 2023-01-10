<template>
    <div class='p-6 flex flex-col justify-between h-[90vh]'>
        <div class="">
            <div class="qrCode w-[100px] h-[100px] grid items center object-fill object-center mx-auto mt-10">
                <svg class='w-full h-full' width="512" height="512" viewBox="0 0 426.667 426.667"><g fill="#fdba74"><path d="M277.333 0v149.333h149.333V0H277.333zM384 106.667h-64v-64h64v64zM0 192h85.333v42.667H0zm128 0h64v42.667h-64zm64-42.667h42.667V192H192zm-42.667-64V0H0v149.333h192v-64h-42.667zm-42.666 21.334h-64v-64h64v64zM192 0h42.667v85.333H192zm106.667 234.667h42.666v64H384V192H234.667v42.667H256v42.666h42.667zm-85.334 42.666H256v64h-42.667zM384 298.667h42.667v42.667H384z" data-original="#000000"/><path data-original="#000000" d="M298.667 341.333H256V384h-42.667v42.667h85.334V384h42.666v42.667h64V384H384v-42.667h-42.667zm-149.334 0v-64H0v149.333h149.333V384h64v-42.667h-64zM106.667 384h-64v-64h64v64z"/></g><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/></svg>
            </div>
            <h1 class="font-bolder  text-center mt-5 text-2xl">
                FIND THE QR CODE
            </h1>
        </div>
        <div class="">
            <p class='text-center mb-5 max-h-[260px] overflow-y-auto'>
                Go to Sony Departments store and look for the QR code we have hidden in the female bathroom. Scan it .
            </p>
            <Button label='OPEN CAMERA AND SCAN QR' />
        </div>
    </div>
</template>

<script setup>
    import Button from '@/Components/Global/Button.vue'
</script>