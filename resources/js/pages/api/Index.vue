<template>
  <app-layout title="API Tokens">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">API Tokens</h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <api-token-manager
          :tokens="tokens"
          :available-permissions="availablePermissions"
          :default-permissions="defaultPermissions"
        />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout.vue'
import ApiTokenManager from '@/pages/api/Partials/ApiTokenManager.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  props: ['tokens', 'availablePermissions', 'defaultPermissions'],

  components: {
    ApiTokenManager,
    AppLayout,
  },
})
</script>
