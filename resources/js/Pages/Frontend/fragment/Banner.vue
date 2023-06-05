<template>
    <section class="container mx-auto mb-[100px] px-5">
        <div class="m-auto pb-[30px] grid grid-cols-1 lg:grid-cols-2 items-center mt-16 md:mt-0">
            <div class="lg:pt-[140px] lg:mb-6">
                <h1 class="text-slate-900 font-extrabold text-4xl sm:text-5xl lg:text-6xl tracking-tight">
                    Rebusløp gjort <br>
                    <span class="bg-fave-400 inline-block py-2 px-1">enkelt! </span>
                </h1>
                <p class="font-[600] text-[16px]  mb-5">
                    Dette er den super enkle rebusløp-appen som fungerer<br>
                    uten at du eller deltagerne trenger å laste ned og installere <br>
                    programvare eller oppgi personlig info.  <br>
                    - Alt som kreves er en smarttelefon med internettforbindelse. <br>
                    Mens deltagerne løser utfordrende rebusløp oppgaver, kan du <br>
                    som administrator holde full oversikt over de ulike lagene, tildele <br>
                    poeng og se løpende status over hvem som har løst oppgavene.<br>
                </p>
                <button class="font-semibold bg-fave-400 text-white px-8 py-3 rounded hover:opacity-80 duration-200 flex items-center gap-2">
                    Registrer deg
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
                    </svg>
                </button>
            </div>
            <div class="w-full mt-20 lg:mt-0">
                <img class="w-full object-cover object-center" src="../img/banner.png" alt="">
            </div>
        </div>
    </section>
</template>

<script setup>
import useLanguage from '@/useLanguage'
const { translate, selectedLanguage } = useLanguage()
</script>