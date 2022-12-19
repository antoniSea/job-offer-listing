<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
    import { ref } from 'vue'
    import DangerButton from '@/Components/DangerButton.vue'
    import Swal from 'sweetalert2'

    const props = defineProps({
        offers: Array
    });

    let voiceSearchActive = ref(false)
    let searchText = ""

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

    const voiceSearch = () => {
        const recognition = new webkitSpeechRecognition();
        recognition.lang = 'pl-PL';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;
        recognition.start();

        voiceSearchActive.value = true

        recognition.onresult = function (event) {
            let saidText = ""
            for (let i = event.resultIndex; i < event.results.length; i++) {
                if (event.results[i].isFinal) {
                saidText = event.results[i][0].transcript
                } else {
                saidText += event.results[i][0].transcript
                }
            }
            searchText = saidText
            voiceSearchActive.value = false
        };
    }

    const search = () => {
        Inertia.get(route('offers.index'), {
            search: searchText
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
                    <form @submit.prevent="search" class="flex items-center">   
                        <label for="voice-search" class="sr-only">Wyszukaj</label>
                        <div class="relative w-full">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" v-model="searchText" id="voice-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Szukaj ofert..." required>
                            <button @click="voiceSearch" type="button" class="flex absolute inset-y-0 right-0 items-center pr-3">
                                <svg class="w-4 h-4 text-gray-500 hover:text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                        <button type="submit" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Szukaj</button>
                    </form>

                    <div v-if="voiceSearchActive" class="absolute top-0 left-0 w-full h-full bg-white bg-opacity-50 flex items-center justify-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                            <div class="text-gray-500">Wyszukiwanie głosowe...</div>
                        </div>
                    </div>

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
