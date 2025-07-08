<script setup lang="ts">
import { SecondaryButton } from '@/components/ui/buttons'
import { reactive } from 'vue'
import '../../../../css/app.css'

const state = reactive({
  type: 'button',
})
</script>

<template>
  <Story title="Ui/Buttons/SecondaryButton">
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
