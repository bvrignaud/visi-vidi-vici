<script setup lang="ts">
import { Button } from '@/components/ui/buttons'
import ActionSection from '@/jetstream/ActionSection.vue'
import { reactive } from 'vue'
import '../../css/app.css'

const state = reactive({
  title: 'Browser Sessions',
  description: 'Manage and log out your active sessions on other browsers and devices.',
})
</script>

<template>
  <Story title="Jetstream/ActionSection">
    <Variant title="Default">
      <ActionSection>
        <template #title>
          {{ state.title }}
        </template>
        <template #description>
          {{ state.description }}
        </template>
        <template #content>
          <div class="max-w-xl text-sm text-gray-600">
            <p>
              If necessary, you may log out of all of your other browser sessions across all of your
              devices. Some of your recent sessions are listed below; however, this list may not be
              exhaustive. If you feel your account has been compromised, you should also update your
              password.
            </p>
          </div>

          <div class="mt-5">
            <Button>Log Out Other Browser Sessions</Button>
          </div>
        </template>
      </ActionSection>
    </Variant>

    <Variant title="Delete Account">
      <ActionSection>
        <template #title> Delete Account </template>
        <template #description> Permanently delete your account. </template>
        <template #content>
          <div class="max-w-xl text-sm text-gray-600">
            <p>
              Once your account is deleted, all of its resources and data will be permanently
              deleted. Before deleting your account, please download any data or information that
              you wish to retain.
            </p>
          </div>

          <div class="mt-5">
            <Button class="bg-red-600 hover:bg-red-700">Delete Account</Button>
          </div>
        </template>
      </ActionSection>
    </Variant>

    <template #controls>
      <HstText title="Title" v-model="state.title" />
      <HstText title="Description" v-model="state.description" />
    </template>
  </Story>
</template>
