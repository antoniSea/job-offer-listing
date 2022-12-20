<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Banner from '../Components/Banner.vue';
    import Navbar from '../Components/Navbar.vue';

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        offers: Array
    });
</script>

<template>

    <Head title="Welcome" />

    <div>
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

        </div>
       
        <Navbar />

        <section class="bg-gray-900">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-white">Przeglądaj oferty pracy z całej polski</h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl text-gray-400">Skorzystaj z naszej platformy dla pracowników i pracodawców. Aplikuj do pracy lub stwórz konto.</p>
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-900">
                        Rozpocznij
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg focus:ring-4 text-white border-gray-700 hover:bg-gray-700 focus:ring-gray-800">
                        Dodaj ogłoszenie
                    </a> 
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
                </div>                
            </div>
        </section>

        <!-- Display offers in grid -->
        <div class="p-4 text-center gap-4 flex flex-wrap" style="flex: 0 0 33.333333%;">
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md" v-for="offer in offers.data">
                <a v-if="offer.images.length > 0" href="#">
                    <img class="rounded-t-lg" :src="offer.images[0].image" alt="" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ offer.name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700">{{ offer.description }}</p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Zobacz więcej
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>
        </div>


        <footer class="p-4 bg-white rounded-lg shadow md:flex md:items-center md:justify-between md:p-6">
            <span class="text-sm text-gray-500 sm:text-center">© 2022. Wszystkie prawa zastrzezone. Wykonanie <a class="text-blue-500" href="https://github.com/antonisea">Antoni Seba</a>
            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 sm:mt-0">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </footer>


    </div>
</template>
