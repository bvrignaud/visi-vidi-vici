<script setup lang="ts">
import { Button } from '@/components/ui/buttons'
import ConfirmsPassword from '@/jetstream/ConfirmsPassword.vue'
import { reactive, onMounted } from 'vue'
import '../../css/app.css'

// Mock the axios and route functions that ConfirmsPassword uses
onMounted(() => {
  window.axios = {
    get: () => Promise.resolve({ data: { confirmed: false } }),
    post: () => Promise.resolve({}),
  }
  window.route = (name) => {
    return name === 'password.confirmation' ? '/password/confirm' : '/password/confirm'
  }
})

const state = reactive({
  title: 'Confirmez votre mot de passe',
  content: 'For your security, please confirm your password to continue.',
  button: 'Confirm',
})

function confirmed() {
  console.log('Password confirmed')
}
</script>

<template>
  <Story title="Jetstream/ConfirmsPassword">
    <Variant title="Default">
      <ConfirmsPassword
        :title="state.title"
        :content="state.content"
        :button="state.button"
        @confirmed="confirmed"
      >
        <Button>Confirm Password</Button>
      </ConfirmsPassword>
    </Variant>

    <Variant title="Custom Text">
      <ConfirmsPassword
        title="Custom Title"
        content="Custom content message for the confirmation modal."
        button="Submit"
        @confirmed="confirmed"
      >
        <Button>Confirm Password</Button>
      </ConfirmsPassword>
    </Variant>

    <template #controls>
      <HstText title="Title" v-model="state.title" />
      <HstText title="Content" v-model="state.content" />
      <HstText title="Button" v-model="state.button" />
    </template>
  </Story>
</template>
