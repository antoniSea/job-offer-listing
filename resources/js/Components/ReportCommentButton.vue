<script setup>
    import { useAutoAnimate } from '@formkit/auto-animate/vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import { ref, onUnmounted } from 'vue'
    import { Inertia } from '@inertiajs/inertia'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Swal from 'sweetalert2'

    const [parrent] = useAutoAnimate()

    const props = defineProps({
        offer: Object,
        comment: Object,
    });

    let reportReason = ref(1)
    let reportDescripton = ""

    document.body.style.overflow = 'hidden'

    onUnmounted(() => {
        document.body.style.overflow = 'auto'
    })

    const close = () => {
        document.querySelector('.modal').classList.add('fade-out')

        setTimeout(() => {
            Inertia.visit(route('offers.front.show', {'id': props.offer.id}), {
                preserveScroll: true,
            })
        }, 100)
    }

    const save = () => {
        Inertia.post(route('offers.front.submtit-report-comment', {'offer_id': props.offer.id, 'comment_id': props.comment.id}), {
            'report_reason': reportReason.value,
            'report_description': reportDescripton

        },{
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Komentarz został zgłoszony!',
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
                Zgłoś komentarz
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
                    Wybierz powód zgłoszenia:
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="report_reason" value="spam" v-model="reportReason">
                            <span class="ml-2">Spam</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" class="form-radio" name="report_reason" value="inappropriate" v-model="reportReason">
                            <span class="ml-2">Nieodpowiedni</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" class="form-radio" name="report_reason" value="other" v-model="reportReason">
                            <span class="ml-2">inne</span>
                        </label>
                    </div>

                    <div v-if="reportReason == 3" class="mt-4">
                        <label class="block">
                            <span class="text-gray-700">Treść zgłoszenia</span>
                            <textarea required class="mt-1 block w-full rounded" rows="3" placeholder="Treść zgłoszenia" v-model="reportDescripton"></textarea>
                        </label>
                    </div>
                </div>
              </p>
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b gap-2">
              <button @click.prevent="close" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition" v-on:click="toggleModal">
                Zamknij
              </button>
              
              <PrimaryButton @click="save">
                Wyślij zgłoszenie
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