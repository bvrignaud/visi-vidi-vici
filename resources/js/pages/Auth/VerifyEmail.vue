<template>
  <Head title="Email Verification" />

  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      Thanks for signing up! Before getting started, could you verify your email address by clicking
      on the link we just emailed to you? If you didn't receive the email, we will gladly send you
      another.
    </div>

    <div class="mb-4 text-sm font-medium text-green-600" v-if="verificationLinkSent">
      A new verification link has been sent to the email address you provided during registration.
    </div>

    <form @submit.prevent="submit">
      <div class="mt-4 flex items-center justify-between">
        <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Resend Verification Email
        </Button>

        <Link
          :href="route('logout')"
          method="post"
          as="button"
          class="text-sm text-gray-600 underline hover:text-gray-900"
          >Log Out
        </Link>
      </div>
    </form>
  </jet-authentication-card>
</template>

<script>
import Button from '@/components/ui/buttons/Button.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import { Head, Link } from '@inertiajs/vue3'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    Button,
    Link,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form(),
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('verification.send'))
    },
  },

  computed: {
    verificationLinkSent() {
      return this.status === 'verification-link-sent'
    },
  },
})
</script>
