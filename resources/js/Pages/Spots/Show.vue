<template>
  <app-layout title="Spots">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ spot.name }}</h2>
    </template>

    <div class="pb-10">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mt-5 overflow-hidden overflow-x-auto bg-white p-2 shadow-xl sm:rounded-lg">
          <h3>Prévisions</h3>
          <table>
            <thead>
              <tr>
                <td class="sticky-col"></td>
                <th
                  v-for="(forecast, date) in forecastsAvg"
                  :class="{ 'actual-day rounded-t text-xl': isNow(date) }"
                >
                  {{
                    dayjs(date)
                      .toDate()
                      .toLocaleString(undefined, {
                        weekday: 'short',
                        month: 'numeric',
                        day: 'numeric',
                      })
                  }}
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="sticky-col">Note</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :class="{ 'actual-day': isNow(date) }"
                  :style="{ color: numberToColor(forecast.note, 0, 10) }"
                >
                  {{ Math.round(forecast.note) }}
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Cloud cover') }}</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :class="{ 'actual-day': isNow(date) }"
                  :style="{ color: numberToColor(forecast.cloudCover, 0, 100) }"
                >
                  {{ Math.round(forecast.cloudCover) }}%
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Air temperature') }}</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :class="{ 'actual-day': isNow(date) }"
                  :style="{ color: numberToColor(forecast.airTemperature, 0, 40) }"
                >
                  {{ Math.round(forecast.airTemperature) }}°
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Water temperature') }}</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :class="{ 'actual-day': isNow(date) }"
                  :style="{ color: numberToColor(forecast.waterTemperature, 0, 40) }"
                >
                  {{ Math.round(forecast.waterTemperature) }}°
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Wind') }}</th>
                <td v-for="(forecast, date) in forecastsAvg" :class="{ 'actual-day': isNow(date) }">
                  <WindArrow :direction="forecast.windDirection" :wind-speed="forecast.windSpeed" />
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Swell height') }}</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :class="{ 'actual-day': isNow(date) }"
                  :style="{ color: numberToColor(forecast.swellHeight, 0, 2) }"
                >
                  {{ forecast.swellHeight.toPrecision(1) }}m
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Tides') }}</th>
                <td
                  v-for="(tidesRow, key) in tidesRows"
                  :class="{ 'actual-day': dayjs().format('YYYY-MM-DD') === key }"
                >
                  <div v-for="tide in tidesRow.tides">
                    <strong>{{ tide.type === 'low' ? 'basse' : 'haute' }}</strong> :
                    {{ dayjs(tide.time).format('HH[h]mm') }} ({{ tide.height.toFixed(1) }}m)
                  </div>
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Sun') }}</th>
                <td
                  v-for="(sunInfo, date) in sunInfos"
                  :class="{ 'actual-day rounded-b': isNow(date) }"
                >
                  {{ sunInfo.sunrise }}<br />{{ sunInfo.sunset }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="mt-5 overflow-hidden overflow-x-auto bg-white p-2 shadow-xl sm:rounded-lg">
          <h3>{{ $t('Details') }}</h3>
          <table class="detailed">
            <thead>
              <tr>
                <td class="sticky-col"></td>
                <th v-for="forecast in forecasts" :class="{ 'actual-day': isNow(forecast.time) }">
                  {{
                    new Date(forecast.time).toLocaleString(undefined, {
                      weekday: 'short',
                      month: 'numeric',
                      day: 'numeric',
                    })
                  }}
                  {{ new Date(forecast.time).toLocaleString(undefined, { hour: 'numeric' }) }}
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="sticky-col">Note</th>
                <td
                  v-for="forecast in forecasts"
                  :class="{ 'actual-day': isNow(forecast.time) }"
                  :style="{ color: numberToColor(forecast.note, 0, 10) }"
                >
                  {{ Math.round(forecast.note) }}
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Air temperature') }}</th>
                <td
                  v-for="forecast in forecasts"
                  :class="{ 'actual-day': isNow(forecast.time) }"
                  :style="{ color: numberToColor(forecast.airTemperature, 0, 40) }"
                >
                  {{ Math.round(forecast.airTemperature) }}°
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Water temperature') }}</th>
                <td
                  v-for="forecast in forecasts"
                  :class="{ 'actual-day': isNow(forecast.time) }"
                  :style="{ color: numberToColor(forecast.waterTemperature, 0, 40) }"
                >
                  {{ Math.round(forecast.waterTemperature) }}°
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Cloud cover') }}</th>
                <td
                  v-for="forecast in forecasts"
                  :class="{ 'actual-day': isNow(forecast.time) }"
                  :style="{ color: numberToColor(forecast.cloudCover, 0, 100) }"
                >
                  {{ Math.round(forecast.cloudCover) }}%
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Swell height') }}</th>
                <td
                  v-for="forecast in forecasts"
                  :class="{ 'actual-day': isNow(forecast.time) }"
                  :style="{ color: numberToColor(forecast.swellHeight, 0, 2) }"
                >
                  {{ forecast.swellHeight }}m
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Wind direction') }}</th>
                <td v-for="forecast in forecasts" :class="{ 'actual-day': isNow(forecast.time) }">
                  <WindArrow :direction="forecast.windDirection" :wind-speed="forecast.windSpeed" />
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Wind speed') }}</th>
                <td
                  v-for="forecast in forecasts"
                  :class="{ 'actual-day': isNow(forecast.time) }"
                  :style="{ color: numberToColor(forecast.windSpeed * 1.9438, 0, 20) }"
                >
                  {{ Math.round(forecast.windSpeed * 1.9438) }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div
          class="mt-5 flex flex-row flex-wrap overflow-hidden bg-white p-2 shadow-xl sm:flex-nowrap sm:rounded-lg"
        >
          <div class="sm:basis-1/5">
            <strong>{{ spot.name }}</strong>
            <ul>
              <li>
                {{ $t('Favorable wind') }} :
                <WindArrow :direction.="props.spot.optimal_wind_direction" />
              </li>
              <li>
                lat : {{ props.spot.lat }}<br />
                lon : {{ props.spot.lng }}
              </li>
            </ul>
          </div>
          <Map class="flex-auto" :markers="markers" :link-on-marker="true" />
        </div>
        <div
          v-if="webcams.length"
          class="mt-5 flex flex-wrap justify-around gap-1 overflow-hidden bg-white p-2 shadow-xl sm:rounded-lg"
        >
          <div v-for="webcam in webcams" class="">
            <WebcamThumbnail :webcam="webcam" />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<style scoped>
table {
  @apply text-center;
}

th.actual-day,
td.actual-day {
  @apply bg-yellow-300;
}

.sticky-col {
  @apply sticky left-0 z-10 bg-white;
}

table.detailed th {
  @apply text-sm;
}

table.detailed td {
  @apply p-0 text-xs;
}
</style>

<script setup lang="ts">
import dayjs from 'dayjs'
import { meanBy } from 'lodash'
import { onMounted, ref } from 'vue'
import Map from '../../Components/Map.vue'
import WebcamThumbnail from '../../Components/WebcamThumbnail.vue'
import WindArrow from '../../Components/WindArrow.vue'
import MarkerType from '../../Enums/MarkerType'
import AppLayout from '../../Layouts/AppLayout.vue'
import { webcamsService } from '../../Services/Api/webcamsService'
import Spot from '../../Types/Spot'
import Webcam from '../../Types/Webcam'

const props = defineProps<{
  spot: Spot
}>()

const forecasts = ref<Array<any>>([])
const forecastsAvg = ref({})
const sunInfos = ref([])
const tidesRows = ref({})
const today: string = dayjs().format('YYYY-MM-DD')
const markers = ref<Array<any>>([])
const webcams = ref<Array<Webcam>>([])

onMounted(async () => {
  fetch(`/api/spots/${props.spot.id}/forecast`)
    .then((response) => response.json())
    .then((data) => {
      forecasts.value = data.forecasts
      sunInfos.value = data.sun_infos
      calculateAvgForecasts(data.forecasts)
      forecasts.value.forEach((forecast) => {
        const key = dayjs(forecast.time).format('YYYY-MM-DD')
        if (!tidesRows[key]) {
          tidesRows.value[key] = {
            colspan: 0,
            tides: [],
          }
        }
        if (sunInfos[key] !== undefined) {
          if (sunInfos[key].colspan === undefined) {
            sunInfos[key].colspan = 1
          } else {
            sunInfos[key].colspan++
          }
        }
        tidesRows.value[key].colspan++
      })
      data.tides.forEach((tide) => {
        tidesRows.value[dayjs(tide.time).format('YYYY-MM-DD')].tides.push(tide)
      })
    })
  webcamsService.getAll({ lat: props.spot.lat, lng: props.spot.lng }).then((data) => {
    webcams.value = data.map((webcam: object) => {
      return {
        id: webcam.id,
        coordinates: [webcam.lat, webcam.lng],
        options: { title: webcam.title },
        url: webcam.url,
        type: MarkerType.Webcam,
      }
    })
    markers.value = markers.value.concat(webcams.value)
  })
  markers.value.push({
    id: props.spot.id,
    coordinates: [+props.spot.lat, +props.spot.lng],
    options: { title: props.spot.name },
  })
})

function calculateAvgForecasts(forecasts): void {
  let day = dayjs().startOf('day').subtract(5, 'days')
  for (let i = 0; i < 10; i++) {
    const key = day.format('YYYY-MM-DD')
    const forecastsFiltered = forecasts.filter(
      (forecast) => dayjs(forecast.time).format('YYYY-MM-DD') === key,
    )
    forecastsAvg.value[key] = {
      note: meanBy(forecastsFiltered, 'note'),
      airTemperature: meanBy(forecastsFiltered, 'airTemperature'),
      cloudCover: meanBy(forecastsFiltered, 'cloudCover'),
      swellHeight: meanBy(forecastsFiltered, 'swellHeight'),
      waterTemperature: meanBy(forecastsFiltered, 'waterTemperature'),
      windDirection: meanBy(forecastsFiltered, 'windDirection'),
      windSpeed: meanBy(forecastsFiltered, 'windSpeed'),
    }
    day = day.add(1, 'day')
  }
}

function isNow(time) {
  return dayjs(time).format('YYYY-MM-DD') === today
}

function numberToColor(i, min, max) {
  let R = 0
  let G = 0
  const B = 0

  const percentage = (i * 100) / (max - min)

  if (percentage > 50) {
    R = (255 * percentage) / 100
  } else if (percentage < 50) {
    G = 255 - (255 * percentage) / 100
  }
  return `rgb(${R},${G},${B})`
}
</script>
