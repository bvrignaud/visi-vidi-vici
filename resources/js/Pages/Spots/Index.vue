<template>
    <app-layout title="Spots">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Visi vidi vici</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="flex flex-row">
                <div class="basis-1/3 bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 pt-0">
                    <h3>Spots</h3>
                    <table>
                        <tbody>
                            <tr v-for="spot in spots">
                                <td>
                                    <Link :href="`${route('spots.show', spot)}`">{{ spot.name }}</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Link v-if="$page.props.auth.user" :href="route('spots.create')">
                        <Button>{{ $t('Add a new Spot') }}</Button>
                    </Link>
                </div>

                <div class="basis-2/3 bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                   <Map :markers="markers()" :link-on-marker="true" />
                </div>
              </div>
            </div>
        </div>
    </app-layout>
</template>


<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLayout from "../../Layouts/AppLayout.vue";
import Map from "../../Components/Map.vue";
import Button from "../../Jetstream/Button.vue";

const props = defineProps({
  spots: Array,
});

function markers() {
  return props.spots.map(spot => {
    return {
      id: spot.id,
      coordinates: [spot.lat, spot.lng],
      options: {title: spot.name},
      url: route('spots.show', spot.id),
    };
  });
}
</script>
