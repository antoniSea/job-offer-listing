<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <footer class="p-4 bg-white rounded-lg shadow md:flex md:items-center md:justify-between md:p-6">
        <span class="text-sm text-gray-500 sm:text-center">© 2022. Wszystkie prawa zastrzezone. Wykonanie <a class="text-blue-500" href="https://github.com/antonisea">Antoni Seba</a>
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 sm:mt-0">
            <li>
                <Link :href="route('offers.front.index')" class="mr-4 hover:underline md:mr-6 ">Lista ofert</Link>
            </li>
        </ul>
    </footer>
</template>