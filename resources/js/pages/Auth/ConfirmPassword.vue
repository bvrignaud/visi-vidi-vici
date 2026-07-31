<template>
  <Head :title="$t('Secure Area')" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      {{
        $t(
          'This is a secure area of the application. Please confirm your password before continuing.',
        )
      }}
    </div>

    <ValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="password" :value="$t('Password')" />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
          autofocus
        />
      </div>

      <div class="mt-4 flex justify-end">
        <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          {{ $t('Confirm') }}
        </Button>
      </div>
    </form>
  </JetAuthenticationCard>
</template>

<script setup lang="ts">
import ValidationErrors from '@/components/features/ValidationErrors.vue'
import Button from '@/components/ui/buttons/Button.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import JetInput from '@/jetstream/Input.vue'
import JetLabel from '@/jetstream/Label.vue'
import { store as passwordConfirmStore } from '@/routes/password/confirm'
import { Head, useForm } from '@inertiajs/vue3'

const form = useForm({
  password: '',
})

const submit = () => {
  form.submit(passwordConfirmStore(), {
    onFinish: () => form.reset(),
  })
}
</script>
