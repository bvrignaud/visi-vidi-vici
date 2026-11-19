<template>
  <Head title="Email Verification" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      Thanks for signing up! Before getting started, could you verify your email address by clicking
      on the link we just emailed to you? If you didn't receive the email, we will gladly send you
      another.
    </div>

    <div v-if="verificationLinkSent" class="mb-4 text-sm font-medium text-green-600">
      A new verification link has been sent to the email address you provided during registration.
    </div>

    <form @submit.prevent="submit">
      <div class="mt-4 flex items-center justify-between">
        <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Resend Verification Email
        </Button>

        <Link
          :href="logout()"
          method="post"
          as="button"
          class="text-sm text-gray-600 underline hover:text-gray-900"
        >
          Log Out
        </Link>
      </div>
    </form>
  </JetAuthenticationCard>
</template>

<script setup lang="ts">
import Button from '@/components/ui/buttons/Button.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import { logout } from '@/routes'
import { Head, Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps<{
  status?: string
}>()

const form = useForm({})

const submit = () => {
  form.post('/email/verification-notification')
}

const verificationLinkSent = computed(() => props.status === 'verification-link-sent')
</script>
