<template>
  <textarea
    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
    >{{ modelValue }}</textarea
  >
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
