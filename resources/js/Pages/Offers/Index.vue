<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
    import DangerButton from '@/Components/DangerButton.vue'
    import Swal from 'sweetalert2'

    const props = defineProps({
        offers: Array
    });

    const deleteOffer = (id) => {
        Swal.fire({
            title: 'Czy na pewno chcesz usunąć ofertę?',
            text: "Nie będziesz mógł cofnąć tej operacji!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tak, usuń!',
            cancelButtonText: 'Anuluj'
        }).then((result) => {
            if (result.isConfirmed) {
                Inertia.delete(route('offers.destroy', {'id': id}), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        Swal.fire(
                            'Usunięto!',
                            'Oferta została usunięta.',
                            'success'
                        )
                    }
                })
            }
        })
    }
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                Oferty
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <Link class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition my-3" :href="route('offers.create')">Dodaj nową ofertę</Link>
                    <div v-if="offers.length === 0" class="text-3xl text-center">
                        Nie masz ofert. <Link :href="route('offers.create')" class="text-blue-500">Dodaj nową</Link>
                    </div>
                    <!-- Table (index of offers owned by team) -->
                    <div v-else class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
                                <tr class="bg-white border-b" v-for="offer in offers">
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
                                        <Link class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition" :href="route('offers.show', {'id': offer.id})">Zobacz</Link>
                                        <DangerButton @click="deleteOffer(offer.id)">Usuń</DangerButton>
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
