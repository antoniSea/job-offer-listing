<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import { useAutoAnimate } from '@formkit/auto-animate/vue'
    import { Inertia } from '@inertiajs/inertia';
    import Swal from 'sweetalert2'
    import OfferEditModal from '@/Components/Offer/EditModal.vue'

    const [parrent] = useAutoAnimate()

    const props = defineProps({
        offer: Object,
        edit: Boolean
    });

    let openModal = false
    
    if (props.edit) {
        document.body.style.overflow = 'hidden'
    } else {
        document.body.style.overflow = null
    }

    const deleteOffer = () => {
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
                Inertia.delete(route('offers.destroy', {'id': props.offer.id}), {
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
                <Link :href="route('offers.index')">Oferty</Link> -> Wyświetl ofertę: {{ offer.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <!-- Offer details -->
                    <h1 class="text-4xl font-semibold mb-4 ml-16">
                        {{ offer.name }}
                    </h1>

                    <div class="lg:flex p-4 lg:justify-between lg:px-16">                        
                        <div>
                            <div>
                                opis: {{ offer.description }}
                            </div>
                            <div>
                                numer kontaktowy: {{ offer.contact_number ?? 'nie podano' }}
                            </div>
                            <div>
                                email kontaktowy: {{ offer.contact_email ?? 'nie podano' }}
                            </div>
                            <div>
                                imie: {{ offer.contact_name ?? 'nie podano' }}
                            </div>
                            <div>
                                miasto: {{ offer.contact_city ?? 'nie podano' }}
                            </div>
                        </div>
                        
                        <div>
                            <div>
                                ulica: {{ offer.contact_street ?? 'nie podano' }}
                            </div>
                            <div>
                                kod pocztowy: {{ offer.contact_postal_code ?? 'nie podano' }}
                            </div>
                            <div>
                                kraj: {{ offer.contact_country ?? 'nie podano' }}
                            </div>
                            <div>
                                dodano: {{ offer.created_at }}
                            </div>
                            <div>
                                zaktualizowano: {{ offer.updated_at }}
                            </div>
                        </div>
                    </div>

                    <!-- images -->
                    <div class="flex mt-4 gap-4 overflow-y-hidden overflow-x-scroll mx-16">
                        <div  v-for="url in offer.images">
                            <button @click="removeImage(url)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <img
                                @click="url.selected = !url.selected"
                                :src="url.image"
                                class="cursor-pointer max-w-xs hover:scale-110 transition duration-300 ease-in-out"
                            />
                            <ImageEditModal :info="url" />
                        </div>
                    </div>

                    <!-- Edit and delete buttons -->
                    <div class="flex justify-end mt-4">
                        <Link class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition" :href="route('offers.edit', offer.id)">Edytuj</Link>
                        <button class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition ml-2" @click="deleteOffer">Usuń</button>
                    </div>

                    <div ref="modal" v-if="edit">
                        <OfferEditModal
                            class="modal-open"
                            :offer="offer"
                        />
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
