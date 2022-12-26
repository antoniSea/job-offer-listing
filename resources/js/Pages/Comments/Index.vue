<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/inertia-vue3'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    
    const props = defineProps({
        comments: Array,
        searched_offer_id: Number,
    });

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <span v-if="searched_offer_id"><Link :href="route('comments.index')">Komentarze</Link> -> Wyszukaj przez ofertę: {{ searched_offer_id }}</span> <span v-else>Komentarze</span>
            </h2>
        </template> 

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- Comments listing -->
                        <div class="flex justify-between">
                            <Link v-if="!searched_offer_id" method="POST" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition mb-4" :href="route('comments.change-view-mode')">Zmień na widok ofert</Link>
                            <Link v-else method="POST" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition mb-4" :href="route('comments.change-view-mode')">Zmień na widok wszystkich komentarzy</Link>

                            <a class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition mb-4" :href="route('comments.pdf')" target="_blank">Generuj plik pdf</a>
                        </div>
                            
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Nazwa uytkownika
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Zajawka treści
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Stworzono
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Edytowano
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Akcje
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b" v-for="comment in comments.data">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        <span v-if="comment.user"> {{ comment.user.name }} </span>
                                        <span v-else> Anonim </span>
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ comment.body.slice(0, 150) }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ comment.created_at.split("T")[0] }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ comment.updated_at.split("T")[0] }}
                                    </td>
                                    <td class="py-4 px-6 flex gap-4">
                                        <Link class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition" :href="route('comments.show', {'id': comment.id})">Zobacz</Link>
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