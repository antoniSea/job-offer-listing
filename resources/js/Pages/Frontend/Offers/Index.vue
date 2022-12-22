<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Navbar from '@/Components/Navbar.vue';
    import Foter from '@/Components/Foter.vue';
    import Pagination from '@/Components/Pagination.vue';

    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        offers: Array
    });
</script>

<template>

    <Head title="Lista ofert" />

    <div>
        <Navbar />

        <!-- Display offers in grid -->
        <div id="offers" class="text-center mr-auto space-y-reverse flex flex-wrap gap-4 lg:w-[84%] ml-auto" style="flex: 0 0 33.333333%;">
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

        <Pagination :links="offers.links" />
        
        <Foter />
    </div>
</template>

<style>
* {
    scroll-behavior: smooth;
}
</style>