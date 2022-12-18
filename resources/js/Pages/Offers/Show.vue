<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/inertia-vue3'

    const props = defineProps({
        offer: Object
    });
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Oferta
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <div class="flex gap-4 my-4">
                            <img v-for="img in offer.images" :src="img.image" alt="">
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Nazwa
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Numer kontaktowy
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Email kontaktowy
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Miasto
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ offer.name }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ offer.contact_number }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ offer.contact_email }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ offer.contact_city }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>