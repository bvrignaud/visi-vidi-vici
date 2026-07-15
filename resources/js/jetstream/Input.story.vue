<script setup lang="ts">
import { reactive } from 'vue'
import '../../css/app.css'
import Input from './Input.vue'

const state = reactive({
  value: 'Example input',
})
</script>

<template>
  <Story title="Jetstream/Input">
    <Variant title="Basic">
      <Input v-model="state.value" />
    </Variant>

    <template #controls>
      <HstText title="Value" v-model="state.value" />
    </template>
  </Story>
</template>
