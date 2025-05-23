<template>
  <Head title="Reset Password" />

  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
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
        <jet-label for="password" value="Password" />
        <jet-input
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <jet-label for="password_confirmation" value="Confirmez votre mot de passe" />
        <jet-input
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Reset Password
        </jet-button>
      </div>
    </form>
  </jet-authentication-card>
</template>

<script>
import ValidationErrors from '@/components/ValidationErrors.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/jetstream/Button.vue'
import JetInput from '@/jetstream/Input.vue'
import JetLabel from '@/jetstream/Label.vue'
import { Head } from '@inertiajs/vue3'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetLabel,
    ValidationErrors,
  },

  props: {
    email: String,
    token: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        token: this.token,
        email: this.email,
        password: '',
        password_confirmation: '',
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('password.update'), {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    },
  },
})
</script>
