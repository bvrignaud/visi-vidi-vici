<template>
  <Head :title="$t('Register')" />

  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    {{ $t('auth.failed') }}

    <jet-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <jet-label for="name" :value="$t('Name')" />
        <jet-input
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />
      </div>

      <div class="mt-4">
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
        />
      </div>

      <div class="mt-4">
        <jet-label for="password" value="Mot de passe" />
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

      <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
        <jet-label for="terms">
          <div class="flex items-center">
            <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

            <div class="ml-2">
              I agree to the
              <a
                target="_blank"
                :href="route('terms.show')"
                class="text-sm text-gray-600 underline hover:text-gray-900"
              >
                Terms of Service
              </a>
              and
              <a
                target="_blank"
                :href="route('policy.show')"
                class="text-sm text-gray-600 underline hover:text-gray-900"
              >
                Privacy Policy
              </a>
            </div>
          </div>
        </jet-label>
      </div>

      <div class="mt-4 flex items-center justify-end">
        <Link :href="route('login')" class="text-sm text-gray-600 underline hover:text-gray-900">
          {{ $t('Already registered?') }}
        </Link>

        <jet-button
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          {{ $t('Register') }}
        </jet-button>
      </div>
    </form>
  </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/jetstream/Button.vue'
import JetCheckbox from '@/jetstream/Checkbox.vue'
import JetInput from '@/jetstream/Input.vue'
import JetLabel from '@/jetstream/Label.vue'
import JetValidationErrors from '@/jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/vue3'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link
  },

  data() {
    return {
      form: this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false
      })
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation')
      })
    }
  }
})
</script>
