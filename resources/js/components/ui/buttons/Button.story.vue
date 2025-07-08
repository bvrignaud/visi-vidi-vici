<script setup lang="ts">
import { Button } from '@/components/ui/buttons'
import { reactive } from 'vue'
import '../../../../css/app.css'

const state = reactive({
  type: undefined,
})
</script>

<template>
  <Story title="Ui/Buttons/Button">
    <Variant title="default">
      <Button :type="state.type">Button</Button>
    </Variant>

    <template #controls>
      <HstSelect title="type" v-model="state.type" :options="['submit', 'reset', 'button']" />
    </template>
  </Story>
</template>
