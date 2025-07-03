<script setup lang="ts">
import ActionMessage from '@/jetstream/ActionMessage.vue'
import { reactive } from 'vue'
import '../../css/app.css'

const state = reactive({
  on: true,
})
</script>

<template>
  <Story title="Jetstream/ActionMessage">
    <ActionMessage :on="state.on">Action was successful</ActionMessage>

    <template #controls>
      <HstCheckbox title="on" v-model="state.on" />
    </template>
  </Story>
</template>
