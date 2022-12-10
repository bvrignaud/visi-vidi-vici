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

<script>
import "leaflet/dist/leaflet.css"
import {LMap, LMarker, LTileLayer} from "@vue-leaflet/vue-leaflet";
export default {
    components: {
        LMap,
        LMarker,
        LTileLayer,
    },
    data() {
        return {
            center: [ 46.47, -1.75 ],
        };
    },
    props: {
        linkOnMarker: {
            type: Boolean,
            default: true,
        },
        markers: {
            type: Array,
            default: []
        }
    },
    methods: {
        zoomFitToMarkers() {
            if (this.markers.length > 1) {
                this.$refs.map.leafletObject.fitBounds(this.markers.map(m => m.coordinates));
            } else if (this.markers.length) {
                this.center = this.markers[0].coordinates;
            }
        },
        goToSpot(spotId) {
            if (this.linkOnMarker) {
                this.$inertia.visit(route('spots.show', spotId));
            }
        },
    },
};
</script>
