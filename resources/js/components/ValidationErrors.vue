<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()

const errors = computed(() => {
  return page.props.errors
})

const hasErrors = computed(() => {
  return Object.keys(errors.value).length > 0
})
</script>

<template>
  <div v-if="hasErrors">
    <div class="font-medium text-red-600">Oups ! Un problème est survenu.</div>

    <ul class="mt-3 list-inside list-disc text-sm text-red-600">
      <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
    </ul>
  </div>
</template>
