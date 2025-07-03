<script setup lang="ts">
import { reactive } from 'vue'
import '../../css/app.css'
import WindArrow from './WindArrow.vue'

const state = reactive({
  direction: 0,
  windSpeed: 2,
})
</script>

<template>
  <Story title="WindArrow" :layout="{ type: 'grid', width: '200px' }">
    <Variant title="Light North">
      <WindArrow :direction="0" :windSpeed="2" />
    </Variant>

    <Variant title="Moderate East">
      <WindArrow :direction="90" :windSpeed="5" />
    </Variant>

    <Variant title="Strong South">
      <WindArrow :direction="180" :windSpeed="10" />
    </Variant>

    <Variant title="Very Strong West">
      <WindArrow :direction="270" :windSpeed="15" />
    </Variant>

    <Variant title="Custom">
      <WindArrow :direction="state.direction" :windSpeed="state.windSpeed" />
    </Variant>

    <template #controls>
      <HstSlider title="Direction" v-model="state.direction" :min="0" :max="359" :step="1" />
      <HstSlider title="Wind Speed" v-model="state.windSpeed" :min="0" :max="20" :step="0.1" />
    </template>
  </Story>
</template>
