<script setup lang="ts">
import { reactive } from 'vue'
import '../../../css/app.css'
import WebcamIcon from './WebcamIcon.vue'

const state = reactive({
  color: '#3498db',
})
</script>

<template>
  <Story title="Icons/WebcamIcon" :layout="{ type: 'grid', width: '200px' }">
    <Variant title="Default">
      <WebcamIcon />
    </Variant>

    <Variant title="Custom Color">
      <div :style="`color: ${state.color}`">
        <WebcamIcon />
      </div>
      <template #controls>
        <HstColorSelect v-model="state.color" title="color" />
      </template>
    </Variant>
  </Story>
</template>
