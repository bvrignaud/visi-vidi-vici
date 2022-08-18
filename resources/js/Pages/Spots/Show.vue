<template>
    <app-layout title="Spots">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ spot.name }}</h2>
        </template>

        <div class="pb-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 mt-5 overflow-x-auto">
                <h3>Prévisions</h3>
                <table>
                  <thead>
                  <tr>
                    <td class="sticky-col"></td>
                    <th v-for="(forecast, date) in forecastsAvg" :class="{ 'actual-day text-xl rounded-t' : isNow(date) }">
                      {{ dayjs(date).toDate().toLocaleString(undefined, {weekday: "short", month: "numeric", day: "numeric"}) }}
                    </th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="sticky-col">Note</th>
                      <td
                        v-for="(forecast, date) in forecastsAvg"
                        :class="{ 'actual-day' : isNow(date) }"
                        :style="{ color: numberToColor(forecast.note, 0, 10)}"
                      >
                        {{ Math.round(forecast.note) }}
                      </td>
                    </tr>
                    <tr>
                      <th class="sticky-col">cloudCover</th>
                      <td
                        v-for="(forecast, date) in forecastsAvg"
                        :class="{ 'actual-day' : isNow(date) }"
                        :style="{ color: numberToColor(forecast.cloudCover, 0, 100)}"
                      >
                        {{ Math.round(forecast.cloudCover) }}%
                      </td>
                    </tr>
                    <tr>
                      <th class="sticky-col">airTemperature</th>
                      <td
                        v-for="(forecast, date) in forecastsAvg"
                        :class="{ 'actual-day' : isNow(date) }"
                        :style="{ color: numberToColor(forecast.airTemperature, 0, 40)}"
                      >
                        {{ Math.round(forecast.airTemperature) }}°
                      </td>
                    </tr>
                    <tr>
                      <th class="sticky-col">wind</th>
                      <td
                        v-for="(forecast, date) in forecastsAvg"
                        :class="{ 'actual-day' : isNow(date) }"
                      >
                        <WindArrow :direction="forecast.windDirection" :wind-speed="forecast.windSpeed" />
                      </td>
                    </tr>
                    <tr>
                      <th class="sticky-col">swellHeight</th>
                      <td
                        v-for="(forecast, date) in forecastsAvg"
                        :class="{ 'actual-day' : isNow(date) }"
                        :style="{ color: numberToColor(forecast.swellHeight, 0, 2)}"
                      >
                        {{ forecast.swellHeight.toPrecision(1) }}m
                      </td>
                    </tr>
                    <tr>
                      <th class="sticky-col">Marées</th>
                      <td
                        v-for="(tidesRow, key) in tidesRows"
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
                        :class="{ 'actual-day rounded-b' : isNow(date) }"
                      >
                        {{ sunInfo.sunrise }}<br>{{ sunInfo.sunset }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2 mt-5 overflow-x-auto">
                <h3>Détails</h3>
                <table class="detailed">
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
    table {
      @apply text-center;
    }
    th.actual-day, td.actual-day {
        @apply bg-yellow-300;
    }
    .sticky-col {
      @apply sticky left-0 bg-white z-10;
    }

    table.detailed th {
      @apply text-sm;
    }

    table.detailed td {
      @apply text-xs p-0;
    }
</style>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Map from "@/Components/Map.vue";
import dayjs from "dayjs";
import { meanBy } from "lodash";
import WindArrow from "@/Components/WindArrow.vue";

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
          days: [],
          startTime: dayjs().startOf('day').subtract(5, 'days'),
          endTime: dayjs().startOf('day').add(5, 'days'),
          forecasts: [],
          forecastsAvg: {},
          sunInfos: [],
          tides: [],
          tidesRows: {},
          today: dayjs().format('YYYY-MM-DD'),
        }
    },
    async mounted() {
      // let day = dayjs().startOf('day').subtract(5, 'days')
      // for(let i = 0; i < 10; i++) {
      //   this.days.push(day)
      //   this.forecastsAvg.push(day)
      //   day = day.add(1, 'day')
      // }
      fetch(`/api/spots/${this.spot.id}/forecast`)
        .then(response => response.json())
        .then(data => {
          this.forecasts = data.forecasts
          this.sunInfos = data.sun_infos
          // let lastForecast
          this.calculateAvgForecasts(data.forecasts)
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
      calculateAvgForecasts(forecasts) {
        let day = dayjs().startOf('day').subtract(5, 'days')
        for (let i = 0; i < 10; i++) {
          const key = day.format('YYYY-MM-DD')
          const forecastsFiltered = forecasts.filter(forecast => dayjs(forecast.time).format('YYYY-MM-DD') === key)
          this.forecastsAvg[key] = {
            note: meanBy(forecastsFiltered, 'note'),
            airTemperature: meanBy(forecastsFiltered, 'airTemperature'),
            cloudCover: meanBy(forecastsFiltered, 'cloudCover'),
            swellHeight: meanBy(forecastsFiltered, 'swellHeight'),
            windDirection: meanBy(forecastsFiltered, 'windDirection'),
            windSpeed: meanBy(forecastsFiltered, 'windSpeed'),
          }
          day = day.add(1, 'day')
        }
        // this.forecastsAvg.forEach((forecastAvg, index) => {
        //   const forecastsFiltered = forecasts.filter(forecast => dayjs(forecast.time).format('YYYY-MM-DD') === index)
        //   forecastAvg = {
        //     note: meanBy(forecastsFiltered, note)
        //   }
        // })
        // forecasts.forEach(forecast => {
        //
        // })
      },
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
