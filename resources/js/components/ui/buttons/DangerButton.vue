<template>
  <button
    :type="type"
    class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition hover:bg-red-500 focus:border-red-700 focus:ring-3 focus:ring-red-200 focus:outline-hidden active:bg-red-600 disabled:opacity-25"
  >
    <slot></slot>
  </button>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    type: {
      type: String,
      default: 'button',
    },
  },
})
</script>
