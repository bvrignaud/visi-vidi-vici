<template>
  <app-layout title="Webcams">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Webcams</h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mt-5 overflow-hidden bg-white p-2 shadow-xl sm:rounded-lg">
          <Map :markers="markers" :link-on-marker="true" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import Map from '@/components/Map.vue'
import MarkerType from '@/enums/MarkerType'
import AppLayout from '@/layouts/AppLayout.vue'
import { webcamsService } from '@/services/Api/webcamsService'
import type Marker from '@/types/Marker'
import { onMounted, ref } from 'vue'

const markers = ref<Array<Marker>>([])

onMounted(async () => {
  webcamsService.getAll().then((data) => {
    markers.value = data.map((webcam: object) => {
      return {
        id: webcam.id,
        coordinates: [webcam.lat, webcam.lng],
        options: { title: webcam.title },
        url: webcam.url,
        type: MarkerType.Webcam,
      }
    })
  })
})
</script>
