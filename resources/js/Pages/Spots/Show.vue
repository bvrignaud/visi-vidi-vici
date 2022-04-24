<template>
    <app-layout title="Spots">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ spot.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 mt-5 overflow-x-auto">
                  <table class="text-center">
                    <thead>
                      <tr>
                        <td class="sticky-col"></td>
                        <th
                          v-for="forecast in forecasts"
                          :class="{ 'actual-day' : isNow(forecast.time) }"
                        >
                          {{ (new Date(forecast.time)).toLocaleString(undefined, {weekday: "short", month: "numeric", day: "numeric"}) }}
                          {{ (new Date(forecast.time)).toLocaleString(undefined, {hour: "numeric"}) }}
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th class="sticky-col">Note</th>
                        <td v-for="forecast in forecasts"
                            :class="{ 'actual-day' : isNow(forecast.time) }"
                            :style="{ color: numberToColor(forecast.note, 0, 10)}">
                          {{ Math.round(forecast.note) }}
                        </td>
                      </tr>
                      <tr>
                        <th class="sticky-col">airTemperature</th>
                        <td v-for="forecast in forecasts"
                            :class="{ 'actual-day' : isNow(forecast.time) }"
                            :style="{ color: numberToColor(forecast.airTemperature, 0, 40)}">
                          {{ Math.round(forecast.airTemperature) }}°
                        </td>
                      </tr>
                      <tr>
                        <th class="sticky-col">cloudCover</th>
                        <td v-for="forecast in forecasts"
                            :class="{ 'actual-day' : isNow(forecast.time) }"
                            :style="{ color: numberToColor(forecast.cloudCover, 0, 100)}">
                          {{ Math.round(forecast.cloudCover) }}%
                        </td>
                      </tr>
                      <tr>
                        <th class="sticky-col">swellHeight</th>
                        <td v-for="forecast in forecasts"
                            :class="{ 'actual-day' : isNow(forecast.time) }"
                            :style="{ color: numberToColor(forecast.swellHeight, 0, 2)}">
                          {{ forecast.swellHeight }}m
                        </td>
                      </tr>
                      <tr>
                        <th class="sticky-col">windDirection</th>
                        <td v-for="forecast in forecasts"
                            :class="{ 'actual-day' : isNow(forecast.time) }"
                        >
                          <WindArrow :direction="forecast.windDirection" :wind-speed="forecast.windSpeed" />
                        </td>
                      </tr>
                      <tr>
                        <th class="sticky-col">windSpeed</th>
                        <td v-for="forecast in forecasts"
                            :class="{ 'actual-day' : isNow(forecast.time) }"
                            :style="{ color: numberToColor(forecast.windSpeed * 1.9438, 0, 20)}">
                          {{ Math.round(forecast.windSpeed * 1.9438) }}
                        </td>
                      </tr>
                      <tr>
                        <th class="sticky-col">Marées</th>
                        <td
                          v-for="(tidesRow, key) in tidesRows"
                          :colspan="tidesRow.colspan"
                          :class="{ 'actual-day' : dayjs().format('YYYY-MM-DD') === key }"
                        >
                          <div v-for="tide in tidesRow.tides">
                            <strong>{{ tide.type === 'low' ? 'basse' : 'haute' }}</strong> :
                            {{ dayjs(tide.time).format('HH[h]mm') }} ({{ tide.height.toFixed(1) }}m)
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <th class="sticky-col">Sun</th>
                        <td
                          v-for="(sunInfo, date) in sunInfos"
                          :class="{ 'actual-day' : isNow(date) }"
                          :colspan="sunInfo.colspan">
                          {{ sunInfo.sunrise }} - {{ sunInfo.sunset }}
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
    th {
      @apply text-sm;
    }
    th.actual-day, td.actual-day {
        @apply bg-yellow-300;
    }
    .sticky-col {
      @apply sticky left-0 bg-white z-10;
    }
    td {
      @apply text-xs p-0;
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
    },
    data() {
        return {
          forecasts: [],
          sunInfos: [],
          tides: [],
          tidesRows: {},
          today: dayjs().format('YYYY-MM-DD'),
        }
    },
    async mounted() {
      fetch(`/api/spots/${this.spot.id}/forecast`)
        .then(response => response.json())
        .then(data => {
          this.forecasts = data.forecasts
          this.sunInfos = data.sun_infos
          this.forecasts.forEach(forecast => {
            const key = dayjs(forecast.time).format('YYYY-MM-DD')
            if (! this.tidesRows[key]) {
              this.tidesRows[key] = {
                colspan: 0,
                tides: [],
              }
            }
            if (this.sunInfos[key] !== undefined) {
              if (this.sunInfos[key].colspan === undefined) {
                this.sunInfos[key].colspan = 1
              } else {
                this.sunInfos[key].colspan++
              }
            }
            this.tidesRows[key].colspan++
          })
          data.tides.forEach(tide => {
            this.tidesRows[dayjs(tide.time).format('YYYY-MM-DD')].tides.push(tide)
          })
        })
    },
    methods: {
      dayjs: dayjs,
      formatDateToYmd(date) {
        return `${date.getFullYear()}${date.getMonth() + 1}${date.getDate()}`;
      },
      isNow(time) {
        return dayjs(time).format('YYYY-MM-DD') === this.today
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
