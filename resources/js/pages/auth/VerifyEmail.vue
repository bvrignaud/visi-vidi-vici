<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3'
import TextLink from '@/components/features/TextLink.vue'
import { Button } from '@/components/ui/buttons'
import { Spinner } from '@/components/ui/spinner'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import { logout } from '@/routes'
import { send } from '@/routes/verification'

defineOptions({
  layout: {
    title: 'Email verification',
    description: 'Please verify your email address by clicking on the link we just emailed to you.',
  },
})

defineProps<{
  status?: string
}>()
</script>

<template>
  <Head title="Email verification" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <div
      v-if="status === 'verification-link-sent'"
      class="mb-4 text-center text-sm font-medium text-green-600"
    >
      {{
        $t(
          'A new verification link has been sent to the email address you provided during registration.',
        )
      }}
    </div>

    <Form v-bind="send.form()" class="space-y-6 text-center" v-slot="{ processing }">
      <Button :disabled="processing" variant="secondary">
        <Spinner v-if="processing" />
        {{ $t('Resend Verification Email') }}
      </Button>

      <TextLink :href="logout()" as="button" class="mx-auto block text-sm">{{
        $t('Log Out')
      }}</TextLink>
    </Form>
  </JetAuthenticationCard>
</template>
