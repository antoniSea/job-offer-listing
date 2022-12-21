<script setup>
    import Navbar from '@/Components/Navbar.vue'
    import Foter from '@/Components/Foter.vue'
    const props = defineProps({
        offer: Object
    })
</script>

<template>
    <Navbar />
    <div class="p-12">
        <!-- Image slider -->
        <div class="flex justify-center gap-6">
            <div class="lg:w-1/2" v-for="image in offer.images">
                <img :src="image.image" alt="offer image" class="w-full">
            </div>
        </div>

        <div class="lg:flex flex-row pr-32 mt-4">
            <div class="flex-1">
                <h1 class="text-6xl font-bold mt-4">{{ offer.name }}</h1>
                <p class="mt-4">
                    {{ offer.description }}
                </p>
            </div>

            <div class="ml-auto mt-4 p-10 pl-20">
                <div class="ml-auto w-fit">
                    <div class="flex flex-row-reverse">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold">{{ offer.team.name }}</h2>
                        </div>
                        <div class="flex-1">
                            <img src="https://ui-avatars.com/api/?name=E+U&color=7F9CF5&background=EBF4FF" alt="team image" class="w-20 h-20 rounded-full">
                        </div>
                    </div>
                </div>
                <div class="m-4 mt-8">
                    <div class="flex">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" id="Layer_1" x="0" y="0" version="1.1" viewBox="0 0 29 29" xml:space="preserve"><path d="M20.666 27.021a5.907 5.907 0 0 1-2.934-.779l-.126-.071A39.137 39.137 0 0 1 3.491 12.355l-.657-1.095a5.849 5.849 0 0 1 .881-7.153l1.309-1.309c1.1-1.1 2.889-1.1 3.988 0l2.884 2.884a2.83 2.83 0 0 1 .464 3.378l-1.084 1.925a.213.213 0 0 0 .035.255l6.421 6.421a.216.216 0 0 0 .257.034l1.922-1.083.001-.001a2.832 2.832 0 0 1 3.378.464l2.885 2.886c1.1 1.1 1.1 2.889 0 3.988l-1.367 1.366a5.848 5.848 0 0 1-4.142 1.706zM7.018 3.973c-.21 0-.42.08-.58.24L5.129 5.521a3.85 3.85 0 0 0-.58 4.708l.657 1.095a37.13 37.13 0 0 0 13.389 13.107l.126.071c1.526.873 3.446.626 4.672-.602l1.367-1.366a.82.82 0 0 0 0-1.16l-2.885-2.886a.823.823 0 0 0-.983-.134l-1.922 1.083a2.222 2.222 0 0 1-2.652-.363l-6.421-6.421a2.218 2.218 0 0 1-.363-2.651l1.084-1.924a.824.824 0 0 0-.135-.982L7.598 4.213a.818.818 0 0 0-.58-.24z"/></svg>
                        <span class="ml-2">{{ offer.contact_number }}</span>
                    </div>
                    <div class="flex mt-6">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="22" height="18"><g fill="none" fill-rule="evenodd" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M3 1h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2z"/><path d="m21 3-10 7L1 3"/></g></svg>
                        <span class="ml-2">{{ offer.contact_email }}</span>
                    </div>
                    <div class="mt-4 flex">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="32" height="32"><path fill-rule="evenodd" d="M19 4v8.955h-4v-4h-2v-1H9v1H7v3H4.1v-6H0v24h1v-9.5h.95v2H5V30h1V17.955h2.412v-2h2.275v2H13v-1h-1.313v-2H7.412v2H5v4.5H2.95v-2H1v-12.5h2.1v6H8v-3h2v-1h2v1h2v4h6V5h4v9.955h4v-7h3v11h-2.5v-2H24v1h3.5v2H31v10h1v-23h-5v7h-2V4h-6zm-1.977 10.953a.5.5 0 0 0-.05.002.5.5 0 0 0-.313.13l-6.498 6a.5.5 0 0 0 .338.87h.5v7.498a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-7.498h.5a.5.5 0 0 0 .34-.87l-.84-.774v-2.85a.5.5 0 0 0-.508-.506.5.5 0 0 0-.492.506v1.926l-4.66-4.301a.5.5 0 0 0-.317-.133zM17 16.137l5.22 4.818H11.78L17 16.137zm-5 6.033h10v6.783h-3v-3.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v3.5h-3V22.17zm4 3.783h2v3h-2v-3z" color="#000" font-family="sans-serif" font-weight="400" overflow="visible" style="line-height:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;block-progression:tb;white-space:normal;isolation:auto;mix-blend-mode:normal;solid-color:#000;solid-opacity:1"/></svg>
                        <span class="ml-2">{{ offer.contact_city }}</span>
                    </div>
                    <div class="mt-4 flex">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101"><path d="M50.4 54.5c10.1 0 18.2-8.2 18.2-18.2S60.5 18 50.4 18s-18.2 8.2-18.2 18.2 8.1 18.3 18.2 18.3zm0-31.7c7.4 0 13.4 6 13.4 13.4s-6 13.4-13.4 13.4S37 43.7 37 36.3s6-13.5 13.4-13.5zM18.8 83h63.4c1.3 0 2.4-1.1 2.4-2.4 0-12.6-10.3-22.9-22.9-22.9H39.3c-12.6 0-22.9 10.3-22.9 22.9 0 1.3 1.1 2.4 2.4 2.4zm20.5-20.5h22.4c9.2 0 16.7 6.8 17.9 15.7H21.4c1.2-8.9 8.7-15.7 17.9-15.7z"/></svg>
                        <span class="ml-2">{{ offer.contact_name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Foter />
</template>