<template>
  <Head title="Two-factor Confirmation" />

  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      <template v-if="!recovery">
        Please confirm access to your account by entering the authentication code provided by your
        authenticator application.
      </template>

      <template v-else>
        Please confirm access to your account by entering one of your emergency recovery codes.
      </template>
    </div>

    <jet-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div v-if="!recovery">
        <jet-label for="code" value="Code" />
        <jet-input
          ref="code"
          id="code"
          type="text"
          inputmode="numeric"
          class="mt-1 block w-full"
          v-model="form.code"
          autofocus
          autocomplete="one-time-code"
        />
      </div>

      <div v-else>
        <jet-label for="recovery_code" value="Recovery Code" />
        <jet-input
          ref="recovery_code"
          id="recovery_code"
          type="text"
          class="mt-1 block w-full"
          v-model="form.recovery_code"
          autocomplete="one-time-code"
        />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <button
          type="button"
          class="cursor-pointer text-sm text-gray-600 underline hover:text-gray-900"
          @click.prevent="toggleRecovery"
        >
          <template v-if="!recovery"> Use a recovery code </template>

          <template v-else> Use an authentication code </template>
        </button>

        <jet-button
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </jet-button>
      </div>
    </form>
  </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
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
    JetValidationErrors,
  },

  data() {
    return {
      recovery: false,
      form: this.$inertia.form({
        code: '',
        recovery_code: '',
      }),
    }
  },

  methods: {
    toggleRecovery() {
      this.recovery ^= true

      this.$nextTick(() => {
        if (this.recovery) {
          this.$refs.recovery_code.focus()
          this.form.code = ''
        } else {
          this.$refs.code.focus()
          this.form.recovery_code = ''
        }
      })
    },

    submit() {
      this.form.post(this.route('two-factor.login'))
    },
  },
})
</script>
