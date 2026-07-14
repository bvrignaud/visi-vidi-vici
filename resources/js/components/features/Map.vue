<template>
  <l-map
    ref="map"
    :center
    :inertia="true"
    :zoom="16"
    :minZoom="3"
    :maxZoom="19"
    style="height: 50vh"
    @ready="zoomFitToMarkers()"
    :useGlobalLeaflet="false"
  >
    <l-tile-layer
      url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    />
    <l-tile-layer
      url="https://tiles.openseamap.org/seamark/{z}/{x}/{y}.png"
      attribution='Map data: &copy; <a href="https://www.openseamap.org">OpenSeaMap</a> contributors'
    />
    <template v-for="marker in markers" :key="marker.id">
      <l-marker
        v-if="marker.type === MarkerType.Webcam"
        :lat-lng="marker.coordinates"
        :options="marker.options"
        @click="goTo(marker.url)"
      >
        <l-icon icon-url="/images/icons/cam.png" :icon-size="[20, 20]" />
      </l-marker>
      <l-marker
        v-else
        :lat-lng="marker.coordinates"
        :options="marker.options"
        @click="goTo(marker.url)"
      />
    </template>
  </l-map>
</template>

<script setup lang="ts">
import MarkerType from '@/enums/MarkerType'
import { router } from '@inertiajs/vue3'
import { LIcon, LMap, LMarker, LTileLayer } from '@vue-leaflet/vue-leaflet'
import { PointTuple } from 'leaflet'
import 'leaflet/dist/leaflet.css'
import { ref, watch } from 'vue'

const center = ref<PointTuple>([46.47, -1.75])
const map = ref()
const { linkOnMarker = true, markers = [] } = defineProps<{
  linkOnMarker: boolean
  markers: Array<{
    id: number
    coordinates: PointTuple
    options: {}
    url: string
    type?: MarkerType
  }>
}>()

watch(
  () => markers,
  () => {
    zoomFitToMarkers()
  },
)

function zoomFitToMarkers(): void {
  if (markers.length > 1) {
    map.value?.leafletObject.fitBounds(markers.map((m) => m.coordinates))
    map.value?.leafletObject.fitBounds(markers.map((m) => m.coordinates))
  } else if (markers.length) {
    center.value = markers[0].coordinates
  }
}

function goTo(url: string): void {
  if (linkOnMarker) {
    if (url.startsWith(window.location.href)) {
      router.visit(url)
    } else {
      window.open(url)
    }
  }
}
</script>
