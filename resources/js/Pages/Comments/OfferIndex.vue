<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'

    const props = defineProps({
        offers: Array
    })
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Wybierz ofertę
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Link method="POST" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition mb-4" :href="route('comments.change-view-mode')">Zmień na widok wszystkich komentarzy</Link>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                                    <th scope="col" class="py-3 px-6">
                                        Akcje
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b" v-for="offer in offers.data">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ offer.name }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ offer.contact_number ?? 'nie podano' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ offer.contact_email ?? 'nie podano' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ offer.contact_city ?? 'nie podano' }}
                                    </td>
                                    <td class="py-4 px-6 flex gap-4">
                                        <Link class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition" :href="route('comments.show-by-offer', {'offer_id': offer.id})">Zobacz</Link>
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
