<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import { useAutoAnimate } from '@formkit/auto-animate/vue'
    import { Inertia } from '@inertiajs/inertia';
    import Swal from 'sweetalert2'
    import OfferEditModal from '@/Components/Offer/EditModal.vue'
    import { onBeforeUnmount } from 'vue'

    const [parrent] = useAutoAnimate()

    const props = defineProps({
        offer: Object,
        edit: Boolean,
        image: Object,
    });

    let openModal = false
    
    if (props.edit) {
        document.body.style.overflow = 'hidden'
    } else {
        document.body.style.overflow = null
    }

    onBeforeUnmount(() => {
        document.body.style.overflow = null
    })

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

    const removeImage = (id) => {
        Swal.fire({
            title: 'Czy na pewno chcesz usunąć zdjęcie?',
            text: "Nie będziesz mógł cofnąć tej operacji!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tak, usuń!',
            cancelButtonText: 'Anuluj'
        }).then((result) => {
            if (result.isConfirmed) {
                Inertia.post(route('offers.delete-image', {'id': id}))
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
                    <div class="lg:flex p-4 lg:justify-between lg:px-16">                        
                        <div class="p-8">
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
                        
                        <div class="p-8">
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
                    <div class="flex mt-4 gap-4 overflow-y-hidden overflow-x-scroll lg:mx-16">
                        <div v-for="url in offer.images">
                            <button @click="removeImage(url.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <Link :href="route('offers.show-image', {'id': url.id})">
                                <img
                                    @click="url.selected = !url.selected"
                                    :src="url.image"
                                    class="cursor-pointer max-w-xs hover:scale-110 transition duration-300 ease-in-out"
                                />
                            </Link>
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

                    <div class="image" v-if="image">
                        <!-- image centered verticaly and horizontaly with dark background -->
                        <div class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-75 flex items-center justify-center">
                            <div class="relative">
                                <Link :href="route('offers.show', offer.id)" @click="image = false" class="  mt-4 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </Link>
                                <!-- Arrows to next and previous image -->
                                <Link v-if="image.previous" :href="route('offers.show-image', {'id': image.previous.id})" class="absolute top-1/2 left-0">
                                    <button @click="prevImage" class="bg-gray-600 bg-opacity-25 rounded-full p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                </Link>
                                <img :src="image.current.image" class="max-w-3xl max-h-3xl" />
                                <Link v-if="image.next" :href="route('offers.show-image', {'id': image.next.id})" class="absolute top-1/2 right-0">
                                    <button  class="bg-gray-600 bg-opacity-25 rounded-full p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </Link>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
@keyframes fadeIn {
  0% { opacity: 0.3; }
  100% { opacity: 1; }
}
.image {
    animation: fadeIn 0.4s; 
}
</style>