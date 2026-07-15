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
            <Deferred data="spots">
              <template #fallback>
                <div class="animate-pulse space-y-2">
                  <div class="h-4 w-3/4 rounded-sm bg-gray-200"></div>
                  <div class="h-4 w-1/2 rounded-sm bg-gray-200"></div>
                  <div class="h-4 w-5/6 rounded-sm bg-gray-200"></div>
                </div>
              </template>
              <table>
                <tbody>
                  <tr v-for="spot in spots" :key="spot.id">
                    <td>
                      <Link :href="spotShow(spot.id)">{{ spot.name }}</Link>
                    </td>
                  </tr>
                </tbody>
              </table>
            </Deferred>
            <Link v-if="$page.props.auth.user?.is_admin" :href="spotCreate()">
              <Button>{{ $t('Add a new Spot') }}</Button>
            </Link>
          </div>

          <div class="basis-2/3 overflow-hidden bg-white p-2 shadow-xl sm:rounded-lg">
            <Deferred data="spots">
              <template #fallback>
                <div class="flex h-[50vh] animate-pulse items-center justify-center bg-gray-100">
                  <span class="text-gray-400">Loading map...</span>
                </div>
              </template>
              <Map :markers="markers()" :link-on-marker="true" />
            </Deferred>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import Map from '@/components/features/Map.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { create as spotCreate, show as spotShow } from '@/routes/spots'
import type { Spot } from '@/types/Spot'
import { Deferred, Link } from '@inertiajs/vue3'
import Button from '../components/ui/buttons/Button.vue'

const props = defineProps<{
  spots?: Spot[]
}>()

function markers() {
  return (props.spots || []).map((spot) => {
    return {
      id: spot.id,
      coordinates: [spot.lat, spot.lng] as [number, number],
      options: { title: spot.name },
      url: spotShow.url(spot.id),
    }
  })
}
</script>
