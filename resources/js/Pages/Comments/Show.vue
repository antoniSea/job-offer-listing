<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import { Link } from '@inertiajs/inertia-vue3';

    const props = defineProps({
        comment: Object,
    });

</script>

<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('comments.index')">Komentarze</Link> -> Wyświetlanie komentarzy
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <article class="px-12 my-12">
                            <div class="flex items-center mb-4 space-x-4">
                                <img :src="comment.user.profile_photo_url" v-if="comment.user"
                                    class="w-10 h-10 rounded-full" alt="">
                                <img src="https://ui-avatars.com/api/?name={{ comment.user.name ?? 'gość' }}&background=0D8ABC&color=fff"
                                    v-else class="w-10 h-10 rounded-full" alt="">
                                <div class="space-y-1 font-medium">
                                    <p> <span v-if="comment.user">{{ comment.user.name }}</span> <span
                                            v-else>Gość</span> <time v-if="comment.user"
                                            class="block text-sm text-gray-500 dark:text-gray-400">Dołączono {{
                                            comment.user.created_at.split("T")[0] }}</time> <time v-else
                                            class="block text-sm text-gray-500 dark:text-gray-400">Dołączono {{
                                            comment.created_at.split("T")[0] }} </time></p>
                                </div>
                            </div>
                            <div class="flex items-center mb-1">
                                <svg v-for="n in comment.rating" aria-hidden="true" class="w-5 h-5 text-yellow-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>First star</title>
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </div>
                            <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                                <p>Stworzono {{ comment.created_at.split("T")[0] }} o godzinie {{
                                    comment.created_at.split("T")[1].split('.')[0] }}</p>
                            </footer>
                            <p class="mb-2 font-light text-gray-500 dark:text-gray-400">{{ comment.body }}</p>
                            <aside>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ comment.found_helpful }}
                                    uznaje ten komentarz za pomocny</p>
                            </aside>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
