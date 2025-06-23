<template>
  <jet-form-section @submitted="updatePassword">
    <template #title>Mettre à jour le mot de passe</template>

    <template #description>
      Assurez-vous d'utiliser un mot de passe long et aléatoire pour sécuriser votre compte.
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="current_password" value="Mot de passe actuel" />
        <jet-input
          id="current_password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.current_password"
          ref="current_password"
          autocomplete="current-password"
        />
        <jet-input-error :message="form.errors.current_password" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-4">
        <jet-label for="password" value="Nouveau mot de passe" />
        <jet-input
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          ref="password"
          autocomplete="new-password"
        />
        <jet-input-error :message="form.errors.password" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-4">
        <jet-label for="password_confirmation" value="Confirmez votre mot de passe" />
        <jet-input
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          autocomplete="new-password"
        />
        <jet-input-error :message="form.errors.password_confirmation" class="mt-2" />
      </div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Sauvegardé.
      </jet-action-message>

      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Sauvegarder
      </Button>
    </template>
  </jet-form-section>
</template>

<script lang="ts">
import Button from '@/components/Button.vue'
import JetActionMessage from '@/jetstream/ActionMessage.vue'
import JetFormSection from '@/jetstream/FormSection.vue'
import JetInput from '@/jetstream/Input.vue'
import JetInputError from '@/jetstream/InputError.vue'
import JetLabel from '@/jetstream/Label.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    JetActionMessage,
    Button,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },

  data() {
    return {
      form: this.$inertia.form({
        current_password: '',
        password: '',
        password_confirmation: '',
      }),
    }
  },

  methods: {
    updatePassword() {
      this.form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => this.form.reset(),
        onError: () => {
          if (this.form.errors.password) {
            this.form.reset('password', 'password_confirmation')
            this.$refs.password.focus()
          }

          if (this.form.errors.current_password) {
            this.form.reset('current_password')
            this.$refs.current_password.focus()
          }
        },
      })
    },
  },
})
</script>
