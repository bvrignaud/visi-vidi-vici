<script setup lang="ts">
const { type = 'submit' } = defineProps<{ type?: string }>()
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition hover:bg-gray-700 focus:border-gray-900 focus:ring-3 focus:ring-gray-300 focus:outline-hidden active:bg-gray-900 disabled:opacity-25"
  >
    <slot></slot>
  </button>
</template>
