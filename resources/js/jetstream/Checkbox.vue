<script setup lang="ts">
import { computed } from 'vue'

const emit = defineEmits<{
  (e: 'update:checked', value: any): void
}>()

const props = withDefaults(
  defineProps<{
    checked?: any[] | boolean
    value?: any
  }>(),
  {
    checked: false,
    value: null,
  },
)

const proxyChecked = computed({
  get() {
    return props.checked
  },

  set(val) {
    emit('update:checked', val)
  },
})
</script>

<template>
  <input
    type="checkbox"
    :value="value"
    v-model="proxyChecked"
    class="rounded-xs border-gray-300 text-indigo-600 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-black/50 focus:ring-indigo-200"
  />
</template>
