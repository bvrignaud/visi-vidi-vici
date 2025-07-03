<script setup lang="ts">
import SecondaryButton from '@/jetstream/SecondaryButton.vue'
import { reactive } from 'vue'
import '../../css/app.css'

const state = reactive({
  type: 'button',
})
</script>

<template>
  <Story title="Jetstream/SecondaryButton">
    <Variant title="Default">
      <SecondaryButton :type="state.type">Cancel</SecondaryButton>
    </Variant>

    <Variant title="As Submit">
      <SecondaryButton type="submit">Submit</SecondaryButton>
    </Variant>

    <template #controls>
      <HstSelect title="Type" v-model="state.type" :options="['submit', 'button', 'reset']" />
    </template>
  </Story>
</template>
