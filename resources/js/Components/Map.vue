<template>
    <l-map style="height:50vh" :center="center" :zoom="`12`">
        <l-tile-layer
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            :attribution="attribution"
        />
        <l-marker v-for="marker in markers"
            :key="marker.id"
            :lat-lng="marker.coordinates"
            :options="marker.options"
            @click="goToSpot(marker.id)"
        >
            <l-icon
                :icon-url="`/images/favicon.png`"
                :icon-size="[32, 32]"
            />
        </l-marker>
    </l-map>
</template>

<script>
import "leaflet/dist/leaflet.css"
import { LMap, LIcon, LMarker, LTileLayer } from "@vue-leaflet/vue-leaflet";
export default {
    components: {
        LIcon,
        LMap,
        LMarker,
        LTileLayer,
    },
    data() {
        return {
            attribution: '&copy; <a target="_blank" href="https://osm.org/copyright">OpenStreetMap</a> contributors',
            center: [ 46.47, -1.75 ],
        };
    },
    props: {
        markers: {
            type: Array,
            default: []
        }
    },
    methods: {
        goToSpot(spotId) {
            this.$inertia.visit(route('spots.show', spotId));
        },
    },
};
</script>
