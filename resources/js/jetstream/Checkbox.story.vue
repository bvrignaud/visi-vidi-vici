<script setup lang="ts">
import Checkbox from '@/jetstream/Checkbox.vue'
import { reactive } from 'vue'
import '../../css/app.css'

const state = reactive({
  checked: false,
  value: 'option1',
  checkedArray: ['option1'],
})
</script>

<template>
  <Story title="Jetstream/Checkbox" :layout="{ type: 'grid', width: '200px' }">
    <Variant title="Unchecked">
      <Checkbox :checked="false" />
    </Variant>

    <Variant title="Checked">
      <Checkbox :checked="true" />
    </Variant>

    <Variant title="With Value">
      <Checkbox :checked="state.checkedArray" :value="state.value" />
    </Variant>

    <Variant title="Custom">
      <Checkbox
        :checked="state.checked"
        :value="state.value"
        @update:checked="state.checked = $event"
      />
    </Variant>

    <template #controls>
      <HstCheckbox title="Checked" v-model="state.checked" />
      <HstText title="Value" v-model="state.value" />
    </template>
  </Story>
</template>
