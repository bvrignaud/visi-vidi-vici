<script setup lang="ts">
import { ref } from 'vue'

defineProps<{
  modelValue?: string | number | null
}>()

defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

const input = ref<HTMLInputElement | null>(null)

const focus = () => {
  input.value?.focus()
}

defineExpose({ focus })
</script>

<template>
  <input
    ref="input"
    class="rounded-md border-gray-300 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-black/50 focus:ring-indigo-200"
    :value="modelValue"
    @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
  />
</template>
