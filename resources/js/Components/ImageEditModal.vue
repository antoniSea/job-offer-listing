<script setup>
    import { useAutoAnimate } from '@formkit/auto-animate/vue'

    const [parrent] = useAutoAnimate()

    const props = defineProps({
        info: Object
    }); 
</script>

<template>
    <div ref="parrent">
      <div v-if="info.selected" v-auto-animate class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
        <div class="relative w-auto my-6 mx-auto max-w-6xl">
          <!--content-->
          <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
            <!--header-->
            <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
              <h3 class="text-3xl font-semibold">
                Edytuj zdjęcie
              </h3>
              <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModal()">
                <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                  ×
                </span>
              </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
              <p class="my-4 text-slate-500 w-[50vw]">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_postal_code">
                            Tytuł obrazka
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200
                            text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="text"
                            placeholder="Tytuł obrazka"
                            v-model="info.title"
                        >
                    </div>

                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_postal_code">
                            Alt obrazka
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200
                            text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="text"
                            placeholder="Alt obrazka"
                            v-model="info.alt"
                        >
                    </div>

                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_postal_code">
                            Opis obrazka
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200
                            text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            type="text"
                            placeholder="Opis obrazka"
                            v-model="info.description"
                        />
                    </div>
                </div>
              </p>
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
              <button @click="info.selected = false" class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
                Zamknij
              </button>
            </div>
          </div>
        </div>
      </div>
      <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
  </template>
  