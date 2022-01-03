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
                                <th>Note</th>
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}"
                                    :style="{ color: numberToColor(weather.note, 0, 10)}">
                                    {{ Math.round(weather.note) }}
                                </td>
                            </tr>
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
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}">
                                  <WindArrow :direction="weather.windDirection" :wind-speed="weather.windSpeed" />
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
                                <td v-for="(weather, date) in weathers" :class="{'actual-day' : date === today}">
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
                                <td v-for="(forecast, date) in forecasts" :class="{'actual-day rounded-b' : date === today}">
                                    {{ forecast.sun.sunrise }}<br>{{ forecast.sun.sunset }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 mt-5">
                  <div>
                    <strong>{{ spot.name }}</strong>
                    <ul>
                      <li>
                        Vent favorable :
                        <WindArrow :direction.="spot.optimal_wind_direction" />
                      </li>
                    </ul>
                  </div>
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
import WindArrow from "@/Components/WindArrow";

export default defineComponent({
    components: {
        WindArrow,
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
