<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    
    const props = defineProps({
        offers: Object,
        chart: Object,
    });
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
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
</style>
