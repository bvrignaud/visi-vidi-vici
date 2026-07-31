<template>
  <Head :title="$t('Register')" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <ValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="name" :value="$t('Name')" />
        <JetInput
          id="name"
          v-model="form.name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="name"
        />
      </div>

      <div class="mt-4">
        <JetLabel for="email" value="Email" />
        <JetInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required />
      </div>

      <div class="mt-4">
        <JetLabel for="password" value="Mot de passe" />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <JetLabel for="password_confirmation" value="Confirmez votre mot de passe" />
        <JetInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <Link :href="login()" class="text-sm text-gray-600 underline hover:text-gray-900">
          {{ $t('Already registered?') }}
        </Link>

        <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          {{ $t('Register') }}
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
import { login } from '@/routes'
import { store as registerStore } from '@/routes/register'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
})

const submit = () => {
  form.submit(registerStore(), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>
