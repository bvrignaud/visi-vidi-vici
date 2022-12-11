<template>
  <l-map
    ref="map"
    :center="center"
    :inertia="true"
    :zoom="16"
    :minZoom="3"
    :maxZoom="19"
    style="height:50vh"
    @ready="zoomFitToMarkers()"
  >
    <l-tile-layer
      url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
      attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    />
    <l-tile-layer
      url="https://tiles.openseamap.org/seamark/{z}/{x}/{y}.png"
      attribution='Map data: &copy; <a href="https://www.openseamap.org">OpenSeaMap</a> contributors'
    />
    <l-marker v-for="marker in markers"
              :key="marker.id"
              :lat-lng="marker.coordinates"
              :options="marker.options"
              @click="goToSpot(marker.id)"
    />
  </l-map>
</template>

<script setup>
import "leaflet/dist/leaflet.css"
import {LMap, LMarker, LTileLayer} from "@vue-leaflet/vue-leaflet";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";

const center = ref([46.47, -1.75]);
const map = ref(null);
const props = defineProps({
  linkOnMarker: {
    type: Boolean,
    default: true,
  },
  markers: {
    type: Array,
    default: []
  }
});

watch(
  () => props.markers,
  () => {
    zoomFitToMarkers();
  }
);

function zoomFitToMarkers() {
  if (props.markers.length > 1) {
    map.value.leafletObject.fitBounds(props.markers.map(m => m.coordinates));
    map.value.leafletObject.fitBounds(props.markers.map(m => m.coordinates));
  } else if (props.markers.length) {
    center.value = props.markers[0].coordinates;
  }
}

function goToSpot(spotId) {
  if (props.linkOnMarker) {
    Inertia.visit(route('spots.show', spotId));
  }
}
</script>
