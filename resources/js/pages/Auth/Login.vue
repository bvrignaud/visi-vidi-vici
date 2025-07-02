<script setup lang="ts">
import Button from '@/components/buttons/Button.vue'
import TextLink from '@/components/TextLink.vue'
import ValidationErrors from '@/components/ValidationErrors.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import JetCheckbox from '@/jetstream/Checkbox.vue'
import JetInput from '@/jetstream/Input.vue'
import JetLabel from '@/jetstream/Label.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineProps<{
  status?: string
  canResetPassword: boolean
}>()

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <Head :title="$t('Log in')" />

  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <validation-errors class="mb-4" />

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="flex flex-col gap-6">
      <div>
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
        />
      </div>

      <div class="mt-4">
        <jet-label for="password" :value="$t('Password')" />
        <jet-input
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="current-password"
        />
      </div>

      <div class="mt-4 block">
        <label class="flex items-center">
          <jet-checkbox name="remember" v-model:checked="form.remember" />
          <span class="ml-2 text-sm text-gray-600">{{ $t('Remember me') }}</span>
        </label>
      </div>

      <div class="mt-4 flex items-center justify-end">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="text-sm text-gray-600 underline hover:text-gray-900"
        >
          {{ $t('Forgot your password?') }}
        </Link>

        <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          {{ $t('Log in') }}
        </Button>
      </div>

      <div class="text-muted-foreground text-center text-sm">
        {{ $t('pages.login.dont_have_an_account') }}
        <TextLink :href="route('register')" :tabindex="5">
          {{ $t('pages.login.sign_up') }}
        </TextLink>
      </div>
    </form>
  </jet-authentication-card>
</template>
