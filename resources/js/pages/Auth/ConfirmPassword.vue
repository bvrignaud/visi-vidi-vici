<template>
  <Head :title="$t('Secure Area')" />

  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      {{
        $t(
          'This is a secure area of the application. Please confirm your password before continuing.',
        )
      }}
    </div>

    <validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <jet-label for="password" :value="$t('Password')" />
        <jet-input
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
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
  </jet-authentication-card>
</template>

<script>
import ValidationErrors from '@/components/features/ValidationErrors.vue'
import Button from '@/components/ui/buttons/Button.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import JetInput from '@/jetstream/Input.vue'
import JetLabel from '@/jetstream/Label.vue'
import { store as passwordConfirmStore } from '@/routes/password/confirm'
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

  setup() {
    return { passwordConfirmStore }
  },

  data() {
    return {
      form: this.$inertia.form({
        password: '',
      }),
    }
  },

  methods: {
    submit() {
      this.form.submit(this.passwordConfirmStore(), {
        onFinish: () => this.form.reset(),
      })
    },
  },
})
</script>
