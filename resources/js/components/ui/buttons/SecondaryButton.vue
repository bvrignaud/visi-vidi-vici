<script setup lang="ts">
withDefaults(
  defineProps<{
    type?: 'button' | 'submit' | 'reset'
  }>(),
  {
    type: 'button',
  },
)
</script>

<template>
  <button
    :type="type"
    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase shadow-xs transition hover:text-gray-500 focus:border-blue-300 focus:ring-3 focus:ring-blue-200 focus:outline-hidden active:bg-gray-50 active:text-gray-800 disabled:opacity-25"
  >
    <slot />
  </button>
</template>
