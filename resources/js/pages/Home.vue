<template>
  <app-layout :title="$t('Home')">
    <template #header>
      <h2 class="text-xl leading-tight font-semibold text-gray-800">Visi vidi vici</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-row">
          <div class="basis-1/3 overflow-hidden bg-white p-2 pt-0 shadow-xl sm:rounded-lg">
            <h3>Spots</h3>
            <table>
              <tbody>
                <tr v-for="spot in spots" :key="spot.id">
                  <td>
                    <Link :href="`${route('spots.show', spot)}`">{{ spot.name }}</Link>
                  </td>
                </tr>
              </tbody>
            </table>
            <Link v-if="$page.props.auth.user?.is_admin" :href="route('spots.create')">
              <Button>{{ $t('Add a new Spot') }}</Button>
            </Link>
          </div>

          <div class="basis-2/3 overflow-hidden bg-white p-2 shadow-xl sm:rounded-lg">
            <Map :markers="markers()" :link-on-marker="true" />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import Map from '@/components/Map.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import type { Spot } from '@/types/Spot'
import { Link } from '@inertiajs/vue3'
import Button from '../components/ui/buttons/Button.vue'

const props = defineProps<{
  spots: Spot[]
}>()

function markers() {
  return props.spots.map((spot) => {
    return {
      id: spot.id,
      coordinates: [spot.lat, spot.lng],
      options: { title: spot.name },
      url: route('spots.show', spot.id),
    }
  })
}
</script>
