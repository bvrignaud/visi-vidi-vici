<template>
    <app-layout title="Spots">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ spot.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 overflow-x-auto">
                    <h3>Prévisions</h3>
                    <table class="text-center">
                        <thead>
                            <tr>
                                <td></td>
                                <th v-for="(weather, date) in weathers"
                                    :class="{ 'actual-day text-xl rounded-t' : date === today }">
                                    {{ (new Date(date)).toLocaleString(undefined, {weekday: "short", month: "numeric", day: "numeric"}) }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>airTemperature</th>
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}"
                                    :style="{ color: numberToColor(weather.airTemperature, 0, 40)}">
                                    {{ Math.round(weather.airTemperature) }}°
                                </td>
                            </tr>
                            <tr>
                                <th>cloudCover</th>
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}"
                                    :style="{ color: numberToColor(weather.cloudCover, 0, 100)}">
                                    {{ Math.round(weather.cloudCover) }}%
                                </td>
                            </tr>
                            <tr>
                                <th>swellHeight</th>
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}"
                                    :style="{ color: numberToColor(weather.swellHeight, 0, 2)}">
                                    {{ weather.swellHeight }}m
                                </td>
                            </tr>
                            <tr>
                                <th>windDirection</th>
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}"
                                    :title="`${Math.round(weather.windDirection)}°`">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         x="0px" y="0px"
                                         width="20px" height="20px" viewBox="0 0 493.356 493.356" class="inline-block"
                                         style="enable-background:new 0 0 493.356 493.356;"
                                         :style="{transform: 'rotate(' + (weather.windDirection + 180) + 'deg)', fill: numberToColor(weather.windSpeed * 1.9438, 0, 20)}"
                                         xml:space="preserve">
                                            <path d="M442.627,185.388L265.083,7.844C260.019,2.78,253.263,0,245.915,0c-7.204,0-13.956,2.78-19.02,7.844L49.347,185.388
                                                    c-10.488,10.492-10.488,27.568,0,38.052l16.12,16.128c5.064,5.06,11.82,7.844,19.028,7.844c7.204,0,14.192-2.784,19.252-7.844
                                                    l103.808-103.584v329.084c0,14.832,11.616,26.932,26.448,26.932h22.8c14.832,0,27.624-12.1,27.624-26.932V134.816l104.396,104.752
                                                    c5.06,5.06,11.636,7.844,18.844,7.844s13.864-2.784,18.932-7.844l16.072-16.128C453.163,212.952,453.123,195.88,442.627,185.388z"
                                            />
                                    </svg>
                                </td>
                            </tr>
                            <tr>
                                <th>windSpeed</th>
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}"
                                    :style="{ color: numberToColor(weather.windSpeed * 1.9438, 0, 20)}">
                                    {{ Math.round(weather.windSpeed * 1.9438) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Marées</th>
                                <td v-for="(weather, date) in weathers" :class="{'actual-day rounded-b' : date === today}">
                                    <div v-for="tide in tides">
                                        <span v-if="formatDateToYmd(new Date(tide.time)) === formatDateToYmd(new Date(date))">
                                            <strong>{{ tide.type === 'low' ? 'basse' : 'haute' }}</strong> :
                                            {{ dayjs(tide.time).format('HH[h]mm') }} ({{ tide.height.toFixed(1) }}m)
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Sun</th>
                                <td v-for="(forecast, date) in forecasts" :class="{'actual-day' : date === today}">
                                    {{ forecast.sun.sunrise }}<br>{{ forecast.sun.sunset }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 mt-5">
                    <Map :markers="markers()" :link-on-marker="false" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<style scoped>
    th.actual-day, td.actual-day {
        @apply bg-yellow-300;
    }
</style>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Map from "@/Components/Map";
import dayjs from "dayjs";

export default defineComponent({
    components: {
        AppLayout,
        Map,
    },
    props: {
        spot: Object,
        weathers: Object,
        tides: Array,
    },
    data() {
        return {
            forecasts: [],
            today: dayjs().format('YYYY-MM-DD'),
        }
    },
    async mounted() {
        fetch(`/api/spots/${this.spot.id}/forecast`)
            .then(response => response.json())
            .then(data => this.forecasts = data.forecasts)
    },
    methods: {
        dayjs: dayjs,
        formatDateToYmd(date) {
          return `${date.getFullYear()}${date.getMonth() + 1}${date.getDate()}`;
        },
        numberToColor(i, min, max) {
            let R = 0;
            let G = 0;
            let B = 0;

            let percentage = (i * 100) / (max - min);

            if (percentage > 50) {
                R = (255 * percentage) / 100;
            } else if (percentage < 50) {
                G = 255 - ((255 * percentage) / 100);
            }
            return `rgb(${R},${G},${B})`;
        },
        markers() {
            return [{
                id: this.spot.id,
                coordinates: [+this.spot.lat, +this.spot.lng],
                options: {title: this.spot.name},
            }];
        },
    }
})
</script>
