<template>
  <Head title="Forgot Password" />

  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      Mot de passe oublié ? Pas de soucis. Veuillez nous indiquer votre adresse e-mail et nous vous
      enverrons un lien de réinitialisation du mot de passe.
    </div>

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>

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

      <div class="mt-4 flex items-center justify-end">
        <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Lien de réinitialisation du mot de passe
        </Button>
      </div>
    </form>
  </jet-authentication-card>
</template>

<script>
import Button from '@/components/buttons/Button.vue'
import ValidationErrors from '@/components/ValidationErrors.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import JetInput from '@/jetstream/Input.vue'
import JetLabel from '@/jetstream/Label.vue'
import { Head } from '@inertiajs/vue3'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    Button,
    JetInput,
    JetLabel,
    ValidationErrors,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('password.email'))
    },
  },
})
</script>
