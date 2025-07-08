<script setup lang="ts">
import { DangerButton } from '@/components/ui/buttons'
import { reactive } from 'vue'
import '../../../../css/app.css'

const state = reactive({
  type: 'button',
})
</script>

<template>
  <Story title="Ui/Buttons/DangerButton">
    <Variant title="Default">
      <DangerButton :type="state.type">Delete Account</DangerButton>
    </Variant>

    <Variant title="As Submit">
      <DangerButton type="submit">Delete Account</DangerButton>
    </Variant>

    <template #controls>
      <HstSelect title="Type" v-model="state.type" :options="['submit', 'button', 'reset']" />
    </template>
  </Story>
</template>
