<template>
  <input
    class="rounded-md border-gray-300 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-black/50 focus:ring-indigo-200"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  props: ['modelValue'],

  emits: ['update:modelValue'],

  methods: {
    focus() {
      this.$refs.input.focus()
    },
  },
})
</script>
