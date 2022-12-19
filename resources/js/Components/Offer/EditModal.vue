<script setup>
    import { useAutoAnimate } from '@formkit/auto-animate/vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import { Inertia } from '@inertiajs/inertia'
    import { defineProps, onMounted } from 'vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Swal from 'sweetalert2'

    const [parrent] = useAutoAnimate()
    
    const props = defineProps({
        offer: Object
    });

    const save = () => {
        Inertia.put(route('offers.update', {'id': props.offer.id}), props.offer, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire(
                    'Zapisano!',
                    'Zmiany zostały zapisane.',
                    'success'
                )
            }
        })
    }

    const close = () => {
        // execute fade uot animation on .modal element by css
        document.querySelector('.modal').classList.add('fade-out')

        setTimeout(() => {
            Inertia.visit(route('offers.show', {'id': props.offer.id}))
        }, 150)

        
    }
</script>

<template>
    <div class="modal">
      <div class="mt-[20px] overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center">
        <div class="relative w-auto my-6 mx-auto max-w-6xl">
          <!--content-->
          <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
              <h3 class="text-3xl font-semibold">
                Edytuj ofertę
              </h3>
              <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModal()">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                  ×
                </span>
              </button>
            </div>
            <!--body-->
            <div class="p-6 flex-auto flex w-full">
              <p class="my-4 text-slate-500 w-full">
                <div class="">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                Nazwa
                            </label>
                            <input
                                v-model="offer.name"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="name"
                                type="text"
                                placeholder="Kraj"
                            >
                        </div>
                    </div>

                    <!-- Contact country -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_country">
                                Kraj
                            </label>
                            <input
                                v-model="offer.contact_country"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_country"
                                type="text"
                                placeholder="Kraj"
                            >
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                                Opis
                            </label>
                            <textarea
                                v-model="offer.description"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="description"
                                type="text"
                                placeholder="Opis"
                            ></textarea>
                        </div>
                    </div>
                    <!-- Contact postal code -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_postal_code">
                                Kod pocztowy
                            </label>
                            <input
                                v-model="offer.contact_postal_code"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_postal_code"
                                type="text"
                                placeholder="Kod pocztowy"
                            >
                        </div>
                    </div>
                    <!-- Contact street -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_street">
                                Ulica
                            </label>
                            <input
                                v-model="offer.contact_street"
                                class="appearance-none block w-full bg-gray-200
                                text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_street"
                                type="text"
                                placeholder="Ulica"
                            >
                        </div>
                    </div>
                    <!-- Contact name -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_name">
                                Imię i nazwisko
                            </label>
                            <input
                                v-model="offer.contact_name"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_name"
                                type="text"
                                placeholder="Imię i nazwisko"
                            >
                        </div>
                    </div>
                    <!-- Contact address -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_address">
                                Adres
                            </label>
                            <input
                                v-model="offer.contact_address"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_address"
                                type="text"
                                placeholder="Adres"
                            >
                        </div>
                    </div>
                    <!-- Contact number -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">

                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_number">
                                Numer kontaktowy
                            </label>
                            <input
                                v-model="offer.contact_number"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_number"
                                type="text"
                                placeholder="Numer kontaktowy"
                            >
                        </div>
                    </div>
                    <!-- Contact email -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_email">
                                Email kontaktowy
                            </label>
                            <input
                                v-model="offer.contact_email"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_email"
                                type="text"
                                placeholder="Email kontaktowy"
                            >
                        </div>
                    </div>
                    <!-- Contact city -->
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_city">
                                Miasto
                            </label>
                            <input
                                v-model="offer.contact_city"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="contact_city"
                                type="text"
                                placeholder="Miasto"
                            >
                        </div>
                    </div>
                </div>
              </p>
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b gap-2">
              <a @click.prevent="close" :href="route('offers.show', {'id': offer.id})" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition" type="button" v-on:click="toggleModal()">
                Zamknij
              </a>
              
              <PrimaryButton @click="save">
                Zapisz
              </PrimaryButton>
            </div>
          </div>
        </div>
      </div>
      <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
  </template>
  
<style>

@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 1; }
}

@keyframes fadeOut {
  0% { opacity: 1; }
  100% { opacity: 0; }
}

.modal {
    animation: fadeIn 0.2s; 
}

.fade-out {
    animation: fadeOut 0.2s;
}
</style>