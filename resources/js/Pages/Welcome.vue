<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3'
    import Navbar from '../Components/Navbar.vue'
    import Foter from '../Components/Foter.vue'

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        offers: Array
    });
</script>

<template>

    <Head title="Witamy" />

    <div>
        <Navbar />

        <section class="bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-white">Przeglądaj oferty pracy z całej polski</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl text-gray-400">Skorzystaj z naszej platformy dla pracowników i pracodawców. Aplikuj do pracy lub stwórz konto.</p>
                    <a href="#offers" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-900">
                        Rozpocznij
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <Link :href="route('register')" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg focus:ring-4 text-white border-gray-700 hover:bg-gray-700 focus:ring-gray-800">
                        Dodaj ogłoszenie
                    </Link> 
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
                </div>                
            </div>
        </section>

        <!-- Display offers in grid -->
        <div id="offers" class="text-center mr-auto space-y-reverse flex flex-wrap gap-4 lg:w-[84%] ml-auto mt-4" style="flex: 0 0 33.333333%;">
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md" v-for="offer in offers.data">
                <a v-if="offer.images.length > 0" href="#">
                    <img class="rounded-t-lg" :src="offer.images[0].image" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ offer.name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">{{ offer.description.slice(0, 100) }}...</p>
                    <Link :href="route('offers.front.show', {'id': offer.id})" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Zobacz więcej
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </Link>
                </div>
            </div>
        </div>


        <Foter />


    </div>
</template>

<style>
* {
    scroll-behavior: smooth;
}
</style>