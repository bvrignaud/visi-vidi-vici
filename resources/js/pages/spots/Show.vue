<template>
  <app-layout title="Spots">
    <template #header>
      <h2 class="text-xl leading-tight font-semibold text-gray-800">{{ spot.name }}</h2>
    </template>

    <div class="pb-10">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mt-5 overflow-hidden overflow-x-auto bg-white p-2 shadow-xl sm:rounded-lg">
          <h3>Prévisions</h3>
          <div class="relative">
            <table>
              <thead>
              <tr>
                <td class="sticky-col"></td>
                <th
                  v-for="(forecast, date) in forecastsAvg"
                  :key="date"
                  :class="{ 'actual-day rounded-t text-xl': isNow(date) }"
                >
                  {{
                    dayjs(date).toDate().toLocaleString(undefined, {
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
                  :key="date"
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
                  :key="date"
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
                  :key="date"
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
                  :key="date"
                  :class="{ 'actual-day': isNow(date) }"
                  :style="{ color: numberToColor(forecast.waterTemperature, 0, 40) }"
                >
                  {{ Math.round(forecast.waterTemperature) }}°
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Wind') }}</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :key="date"
                  :class="{ 'actual-day': isNow(date) }"
                >
                  <WindArrow
                    :direction="forecast.windDirection"
                    :wind-speed="forecast.windSpeed"
                  />
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Swell height') }}</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :key="date"
                  :class="{ 'actual-day': isNow(date) }"
                  :style="{ color: numberToColor(forecast.swellHeight, 0, 2) }"
                >
                  {{ forecast.swellHeight.toPrecision(1) }}m
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Swell period') }}</th>
                <td
                  v-for="(forecast, date) in forecastsAvg"
                  :key="date"
                  :class="{ 'actual-day': isNow(date as string) }"
                  :style="{ color: numberToColor(forecast.swellPeriod, 0, 18) }"
                >
                  {{ forecast.swellPeriod }}s
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Tides') }}</th>
                <td
                  v-for="(tidesRow, key) in tidesRows"
                  :key="key"
                  :class="{ 'actual-day': dayjs().format('YYYY-MM-DD') === key }"
                >
                  <div v-for="(tide, key) in tidesRow.tides" :key="key">
                    <strong>{{ tide.type === 'low' ? 'basse' : 'haute' }}</strong> :
                    {{ dayjs(tide.time).format('HH[h]mm') }} ({{ tide.height.toFixed(1) }}m)
                  </div>
                </td>
              </tr>
              <tr>
                <th class="sticky-col">{{ $t('Sun') }}</th>
                <td
                  v-for="(sunInfo, date) in sunInfos"
                  :key="date"
                  :class="{ 'actual-day rounded-b': isNow(date) }"
                >
                  {{ sunInfo.sunrise }}<br />{{ sunInfo.sunset }}
                </td>
              </tr>
              </tbody>
            </table>
            <!--            <button id="arrow-end" class="next-7-days absolute top-100 right-5">❯</button>-->
            <circle-button class="absolute top-100 -left-2 z-10" @click="fetchForecast">
              ❮
            </circle-button>
            <circle-button class="absolute top-100 -right-2 z-10" @click="fetchForecastNext">
              ❯
            </circle-button>
          </div>
        </div>

        <div class="mt-5 overflow-hidden overflow-x-auto bg-white p-2 shadow-xl sm:rounded-lg">
          <h3>{{ $t('Details') }}</h3>
          <table class="detailed">
            <thead>
            <tr>
              <td class="sticky-col"></td>
              <th
                v-for="forecast in forecasts"
                :key="forecast.time"
                :class="{ 'actual-day': isNow(forecast.time) }"
              >
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
                :key="forecast.time"
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
                :key="forecast.time"
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
                :key="forecast.time"
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
                :key="forecast.time"
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
                :key="forecast.time"
                :class="{ 'actual-day': isNow(forecast.time) }"
                :style="{ color: numberToColor(forecast.swellHeight, 0, 2) }"
              >
                {{ forecast.swellHeight }}m
              </td>
            </tr>

            <tr>
              <th class="sticky-col">{{ $t('Swell period') }}</th>
              <td
                v-for="forecast in forecasts"
                :key="forecast.time"
                :class="{ 'actual-day': isNow(forecast.time) }"
                :style="{ color: numberToColor(forecast.swellPeriod, 0, 18) }"
              >
                {{ forecast.swellPeriod }}s
              </td>
            </tr>

            <tr>
              <th class="sticky-col">{{ $t('Wind direction') }}</th>
              <td
                v-for="forecast in forecasts"
                :key="forecast.time"
                :class="{ 'actual-day': isNow(forecast.time) }"
              >
                <WindArrow :direction="forecast.windDirection" :wind-speed="forecast.windSpeed" />
              </td>
            </tr>
            <tr>
              <th class="sticky-col">{{ $t('Wind speed') }}</th>
              <td
                v-for="forecast in forecasts"
                :key="forecast.time"
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
          <div v-for="webcam in webcams" :key="webcam.id">
            <WebcamThumbnail :webcam="webcam" />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
  <dialog-modal :show="showModalPaymentRequired">
    <template #title>{{ $t('pages.spots.show.dialogs.paymentRequired.title') }}</template>
    <template #content>
      <p>
        {{ $t('pages.spots.show.dialogs.paymentRequired.line_1') }}
      </p>
      <p v-html="$t('pages.spots.show.dialogs.paymentRequired.line_2')" />
      <p>
        {{ $t('pages.spots.show.dialogs.paymentRequired.line_3') }}
      </p>
      <div class="mx-auto my-3 flex justify-center">
        <buy-me-a-coffee-button />
      </div>
    </template>
    <template #footer>
      <SecondaryButton @click="showModalPaymentRequired = false">
        {{ $t('actions.close') }}
      </SecondaryButton>
    </template>
  </dialog-modal>
</template>

<script setup lang="ts">
import Map from '@/components/Map.vue'
import { BuyMeACoffeeButton, CircleButton, SecondaryButton } from '@/components/ui/buttons'
import { DialogModal } from '@/components/ui/modal'
import WebcamThumbnail from '@/components/WebcamThumbnail.vue'
import WindArrow from '@/components/WindArrow.vue'
import { useSpot } from '@/composables/useSpot'
import MarkerType from '@/enums/MarkerType'
import AppLayout from '@/layouts/AppLayout.vue'
import { webcamsService } from '@/services/Api/webcamsService'
import type { Forecast, ForecastAvg } from '@/types/Forecast'
import type { Spot } from '@/types/Spot'
import { SunInfo } from '@/types/SunInfo'
import type Webcam from '@/types/Webcam'
import dayjs from 'dayjs'
import { meanBy } from 'lodash'
import { onMounted, ref } from 'vue'

const { fetchSpotForecast } = useSpot()

const props = defineProps<{
  spot: Spot
}>()

const forecasts = ref<Array<Forecast>>([])
const forecastsAvg = ref<{ [date: string]: ForecastAvg }>({})
const sunInfos = ref<{ [date: string]: SunInfo }>({})
const tidesRows = ref<{ [date: string]: { colspan: number; tides: Array<any> } }>({})
const startDate = ref(dayjs().startOf('day').subtract(4, 'days'))
const today: string = dayjs().format('YYYY-MM-DD')
const markers = ref<Array<any>>([])
const webcams = ref<Array<Webcam>>([])
const showModalPaymentRequired = ref(false)

function fetchForecast() {
  tidesRows.value = {}
  sunInfos.value = {}
  forecasts.value = []
  forecastsAvg.value = {}
  fetchSpotForecast(props.spot.id, startDate.value.toDate())
    .then((data) => {
      forecasts.value = data.forecasts
      sunInfos.value = data.sun_infos
      calculateAvgForecasts(data.forecasts)
      forecasts.value.forEach((forecast) => {
        const key = dayjs(forecast.time).format('YYYY-MM-DD')
        if (!tidesRows.value[key]) {
          tidesRows.value[key] = {
            colspan: 0,
            tides: [],
          }
        }
        tidesRows.value[key].colspan++
      })
      data.tides.forEach((tide) => {
        tidesRows.value[dayjs(tide.time).format('YYYY-MM-DD')].tides.push(tide)
      })
    })
    .catch((error) => {
      if (error.response.status === 402) {
        showModalPaymentRequired.value = true
      } else {
        alert('Oups ! Désolé, une erreur est survenue.')
      }
    })
}

function fetchForecastNext() {
  startDate.value = startDate.value.add(2, 'day')
  fetchForecast()
}

function fetchForecastPrev() {
  startDate.value = startDate.value.subtract(2, 'day')
  fetchForecast()
}

onMounted(async () => {
  fetchForecast()
  webcamsService.getAll({ lat: props.spot.lat, lng: props.spot.lng }).then((data) => {
    webcams.value = data.map(
      (webcam: { id: number; lat: number; lng: number; title: string; url: string }) => {
        return {
          id: webcam.id,
          coordinates: [webcam.lat, webcam.lng],
          options: { title: webcam.title },
          url: webcam.url,
          type: MarkerType.Webcam,
        }
      },
    )
    markers.value = markers.value.concat(webcams.value)
  })
  markers.value.push({
    id: props.spot.id,
    coordinates: [+props.spot.lat, +props.spot.lng],
    options: { title: props.spot.name },
  })
})

function calculateAvgForecasts(forecasts: Forecast[]): void {
  // let day = dayjs().startOf('day').subtract(4, 'days')
  let day = startDate.value.clone()
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
      swellPeriod: +meanBy(forecastsFiltered, 'swellPeriod').toFixed(),
      waterTemperature: meanBy(forecastsFiltered, 'waterTemperature'),
      windDirection: meanBy(forecastsFiltered, 'windDirection'),
      windSpeed: meanBy(forecastsFiltered, 'windSpeed'),
    }
    day = day.add(1, 'day')
  }
}

function isNow(time: number | string) {
  return dayjs(time).format('YYYY-MM-DD') === today
}

function numberToColor(i: number, min: number, max: number) {
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

<style scoped>
@reference "../../../css/app.css";

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
