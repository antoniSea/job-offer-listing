<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link, usePage } from '@inertiajs/inertia-vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import { ref } from 'vue'
    import { useAutoAnimate } from '@formkit/auto-animate/vue'
    import { Inertia } from '@inertiajs/inertia'
    import Swal from 'sweetalert2'

    const [parrent] = useAutoAnimate()

    const props = defineProps({
        offers: Object,
        chart: Object,
        actions: Array,
    })

    let openModal = ref(false)

    const saveSettings = () => {
        Inertia.post(route('dashboard.prefrences.items-per-page-history'), {
            items_per_page_history: onSite
        }, {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                // swal toast
                Swal.fire({
                    icon: 'success',
                    title: 'Zapisano!',
                    text: 'Akcja została wykonana pomyślnie!',
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
        })

        openModal.value = false
    }

    let onSite = usePage().props.value.user.items_per_page_history
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="m-4">
                        <div class="p-4 text-2xl font-semibold text-center">
                            Witaj w panelu administracyjnym!
                        </div>
                        <apexchart :width="chart.width" :height="chart.height" :type="chart.type" :options="chart.options" :series="chart.series"></apexchart>
                        <p>
                            Ofert w bazie: <span class="value">{{ offers.length }}</span>
                        </p>

                        <ol class="relative border-l border-gray-200">                  
                            <li class="mb-10 ml-4" v-for="action in actions">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white"></div>
                                <time class="mb-1 text-sm font-normal leading-none text-gray-400">{{ action.created_at.split('T')[0] }}</time>
                                <h3 class="text-lg font-semibold text-gray-900">{{ action.name }}</h3>
                                <p class="mb-4 text-base font-normal text-gray-500">{{ action.description }} ip: {{ action.ip_address }}</p>
                                <Link v-if="action.href" :href="action.href" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700">Zobacz<svg class="ml-2 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></Link>
                            </li>
                        </ol>

                        <div class="flex justify-center mt-4">
                            <PrimaryButton @click="openModal = true">Ustawienia historii</PrimaryButton>
                        </div>

                        <!-- Modal -->
                        <div ref="parrent" v-if="openModal">
                            <div v-auto-animate class="mt-[20px] overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center">
                                <div class="relative w-auto my-32 mx-auto max-w-6xl">
                                <!--content-->
                                    <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                                        <!--header-->
                                        <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                                        <h3 class="text-3xl font-semibold">
                                            Ustawienia historii
                                        </h3>
                                        <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none">
                                            <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                                ×
                                            </span>
                                        </button>
                                        </div>
                                        <!--body-->
                                        <div class="flex flex-wrap -mx-3 mb-6 p-6">
                                            <div class="w-full px-3">
                                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="on_site">
                                                    Ilość na stronie
                                                </label>
                                                <input
                                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                    id="on_site"
                                                    type="number"
                                                    v-model="onSite"
                                                    placeholder="Ilość na stronie"
                                                >
                                            </div>
                                        </div>
                                        <!--footer-->
                                        <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b gap-2">
                                            <PrimaryButton @click="saveSettings">
                                                Zapisz
                                            </PrimaryButton>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
</style>
