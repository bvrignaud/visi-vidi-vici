<template>
    <app-layout title="Spots">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Visi vidi vici</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 pt-0">
                    <h3>Spots</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th class="hidden sm:table-cell">Longitude</th>
                                <th class="hidden sm:table-cell">Latitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="spot in spots">
                                <td>
                                    <Link :href="`${route('spots.show', spot)}`">{{ spot.name }}</Link>
                                </td>
                                <td class="hidden sm:table-cell">
                                    {{ spot.lng }}
                                </td>
                                <td class="hidden sm:table-cell">
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


<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        Link,
        AppLayout,
    },
    props: {
        spots: Array,
    },
})
</script>
