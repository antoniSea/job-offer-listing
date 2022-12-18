<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Oferty
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div v-if="offers.length === 0" class="text-3xl text-center">
                        Nie masz ofert. <Link :href="route('offers.create')" class="text-blue-500">Dodaj nową</Link>
                    </div>
                    <!-- Table (index of offers owned by team) -->
                    <div v-else class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
                                    <th scope="col" class="py-3 px-6">
                                        Akcje
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="offer in offers">
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
                                    <td class="py-4 px-6 flex gap-4">
                                        <Link :href="route('offers.show', {'id': offer.id})">Zobacz</Link>
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