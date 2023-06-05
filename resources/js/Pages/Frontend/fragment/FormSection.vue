<template>      
    <section class="pb-[100px] p-4 bg-[#fff]">
        <div class="max-w-[1200px] m-auto mt-10 lg:grid grid-cols-2 gap-[100px] ">
            <div class="">
                <img class="min-h-[800px] rounded-xl object-center object-cover" src="../img/form.png" alt="">
            </div> 
            <div>
                <div class="mb-[50px]">
                    <h3 class="font-[700] text-[35px] pb-2">Vil du ha en online demo?</h3>
                    <p class="font-[600] text-[16px]">
                        Kontakt oss for en uforpliktende demo. Vi kan levere en fiks<br>
                        ferdig rebus hvorsom helst i verden eller for HR, reise og <br>
                        eventbyrå kan dere få en egen innlogging og lage rebusløpet<br>
                        selv. 
                    </p>
                </div>
                <form action="#">
                    <div class="flex gap-6 mb-4 ">
                        <div class="w-[50%]">
                            <label for="" class="text-[14px] font-[700]">Fornavn </label><br>
                            <input type="text" placeholder="First name" class="w-full border border-slate-400 py-2.5 px-3 placeholder-gray-500 rounded-md mt-1">
                        </div>
                        <div class="w-[50%]">
                            <label for="" class="text-[14px] font-[700]">Etternavn </label><br>
                            <input type="text" placeholder="Last name" class="w-full border border-slate-400 py-2.5 px-3 placeholder-gray-500 rounded-md mt-1">
                        </div>
                    </div>  
                    <div class="mt-4">
                        <label for="" class="text-[14px] font-[700]">Epost </label><br>
                        <input type="email" placeholder="you@company.com" class="w-full border border-slate-400 py-2.5 px-3 placeholder-gray-500 rounded-md mt-1">
                    </div>
                    <div class="mt-4">
                        <label for="" class="text-[14px] font-[700]">Selskap </label><br>
                        <input type="email" placeholder="UNIUX" class="w-full border border-slate-400 py-2.5 px-3 placeholder-gray-500 rounded-md mt-1">
                    </div>
                    <div class="mt-4">
                        <label for="" class="text-[14px] font-[700]">Din beskjed!</label><br>
                        <textarea class="h-[150px] w-full border border-slate-400 py-2.5 px-3 placeholder-gray-500 rounded-md mt-1"></textarea>
                    </div>
                    <!-- <div>
                        <div class="font-extrabold text-4xl tracking-wider text-center bg-black block w-full py-4 text-[#FF8200]">Captcha</div>
                    </div> -->
                </form>
                <button type="submit" class="mt-4 text-center font-bold w-full py-[8px] text-black bg-[#29a3a3] text-[20px] rounded-[8px] hover:bg-[#34cbcb]">Send beskjed!</button>
            </div>       
        </div>
    </section>
</template>

<script setup>

</script>

<style scoped>

</style>