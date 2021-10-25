<template>
    <app-layout title="Spots">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Spots</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                    <table>
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="spot in spots">
                                <td>
                                    <a :href="`${route('spots.show', spot)}`">{{ spot.name }}</a>
                                </td>
                                <td>
                                    {{ spot.lng }}
                                </td>
                                <td>
                                    {{ spot.lat }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped>
    td {
        @apply p-2;
    }
</style>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

export default defineComponent({
    components: {
        AppLayout,
    },
    props: {
        spots: Array,
    },
})
</script>
