<script setup lang="ts">
import SectionTitle from '@/jetstream/SectionTitle.vue'
import '../../css/app.css'
</script>

<template>
  <Story title="Jetstream/SectionTitle" :layout="{ type: 'grid', width: '600px' }">
    <Variant title="Default">
      <div class="p-4 bg-gray-100">
        <SectionTitle>
          <template #title>Profile Information</template>
          <template #description>
            Update your account's profile information and email address.
          </template>
        </SectionTitle>
      </div>
    </Variant>

    <Variant title="With Aside Content">
      <div class="p-4 bg-gray-100">
        <SectionTitle>
          <template #title>API Tokens</template>
          <template #description>
            API tokens allow third-party services to authenticate with our application on your behalf.
          </template>
          <template #aside>
            <button class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">
              Create API Token
            </button>
          </template>
        </SectionTitle>
      </div>
    </Variant>
  </Story>
</template>
