<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Inputerror from '@/Components/InputError.vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Swal from 'sweetalert2'
    import ImageEditModal from '../../Components/ImageEditModal.vue'
    import { useAutoAnimate } from '@formkit/auto-animate/vue'
    import { Link } from '@inertiajs/inertia-vue3'

    const form = useForm({
        name: '',
        description: '',
        contact_number: '',
        contact_email: '',
        contact_city: '',
        contact_name: '',
        contact_address: '',
        contact_street: '',
        contact_postal_code: '',
        contact_country: '',
        images: [],
    });

    const [parent] = useAutoAnimate()

    const submit = () => {
        form.post(route('offers.store'), {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire('Sukces!', 'Oferta została dodana.', 'success')
            }
        })
    }

    const addImage = (e) => {
        // check if file is image
        if (!e.target.files[0].type.includes('image')) {
            Swal.fire({
                icon: 'error',
                title: 'Nieprawidłowy format',
                text: 'Wybrany plik',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            return
        }

        // base64 encode image
        const reader = new FileReader()
        reader.readAsDataURL(e.target.files[0])
        reader.onload = () => {
            // push object to images array
            const obj = {
                url: reader.result,
                alt: 'nie podano',
                title: 'nie podano',
                description: 'nie podano',
            }
            form.images.push(obj)
        }
        e.target.value = ''

        
        Swal.fire({
            icon: 'success',
            title: 'Dodano zdjęcie',
            text: 'Zdjęcie zostało dodane do listy.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    }

    const removeImage = (index) => {
        form.images.splice(index, 1)
    }
</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('offers.index')">Oferty</Link> -> Nowa oferta
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <form @submit.prevent="submit">
                        <!-- Name -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                    Nazwa
                                </label>
                                <input
                                    v-model="form.name"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="name"
                                    type="text"
                                    placeholder="Nazwa"
                                >
                                <Inputerror :message="form.errors.name" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                                    Opis
                                </label>
                                <textarea
                                    v-model="form.description"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="description"
                                    type="text"
                                    placeholder="Opis"
                                ></textarea>
                                <Inputerror :message="form.errors.description" />
                            </div>
                        </div>

                        <!-- Contact country -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_country">
                                    Kraj
                                </label>
                                <input
                                    v-model="form.contact_country"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_country"
                                    type="text"
                                    placeholder="Kraj"
                                >
                                <Inputerror :message="form.errors.contact_country" />
                            </div>
                        </div>

                        <!-- Contact postal code -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_postal_code">
                                    Kod pocztowy
                                </label>
                                <input
                                    v-model="form.contact_postal_code"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_postal_code"
                                    type="text"
                                    placeholder="Kod pocztowy"
                                >
                                <Inputerror :message="form.errors.contact_postal_code" />
                            </div>
                        </div>
                        <!-- Contact street -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_street">
                                    Ulica
                                </label>
                                <input
                                    v-model="form.contact_street"
                                    class="appearance-none block w-full bg-gray-200
                                    text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_street"
                                    type="text"
                                    placeholder="Ulica"
                                >
                                <Inputerror :message="form.errors.contact_street" />
                            </div>
                        </div>
                        <!-- Contact name -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_name">
                                    Imię i nazwisko
                                </label>
                                <input
                                    v-model="form.contact_name"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_name"
                                    type="text"
                                    placeholder="Imię i nazwisko"
                                >
                                <Inputerror :message="form.errors.contact_name" />
                            </div>
                        </div>
                        <!-- Contact address -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_address">
                                    Adres
                                </label>
                                <input
                                    v-model="form.contact_address"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_address"
                                    type="text"
                                    placeholder="Adres"
                                >
                                <Inputerror :message="form.errors.contact_address" />
                            </div>
                        </div>
                        <!-- Contact number -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">

                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_number">
                                    Numer kontaktowy
                                </label>
                                <input
                                    v-model="form.contact_number"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_number"
                                    type="text"
                                    placeholder="Numer kontaktowy"
                                >
                                <Inputerror :message="form.errors.contact_number" />
                            </div>
                        </div>
                        <!-- Contact email -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_email">
                                    Email kontaktowy
                                </label>
                                <input
                                    v-model="form.contact_email"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_email"
                                    type="text"
                                    placeholder="Email kontaktowy"
                                >
                                <Inputerror :message="form.errors.contact_email" />
                            </div>
                        </div>
                        <!-- Contact city -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_city">
                                    Miasto
                                </label>
                                <input
                                    v-model="form.contact_city"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="contact_city"
                                    type="text"
                                    placeholder="Miasto"
                                >
                                <Inputerror :message="form.errors.contact_city" />
                            </div>
                        </div>
                        <!-- Add multiple images -->
                        <div ref="parent" class="flex gap-4 overflow-y-hidden overflow-x-scroll">
                            <div  v-for="url in form.images">
                                <button @click="removeImage(url)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <img
                                    @click="url.selected = !url.selected"
                                    :src="url.url"
                                    class="cursor-pointer max-w-xs hover:scale-110 transition duration-300 ease-in-out"
                                />
                                <ImageEditModal :info="url" />
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3 mt-4">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="images">
                                    Dodaj zdjęcia
                                </label>
                                <input
                                    @change="addImage"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="images"
                                    type="file"
                                    placeholder="Dodaj zdjęcia"
                                >
                                <Inputerror :message="form.errors.images" />
                            </div>
                        </div>
                        <!-- Submit -->
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <PrimaryButton>
                                    Zapisz
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>