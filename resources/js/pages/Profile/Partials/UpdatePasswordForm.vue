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
          ref="currentPasswordInput"
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
          ref="passwordInput"
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

<script setup lang="ts">
import Button from '@/components/ui/buttons/Button.vue'
import JetActionMessage from '@/jetstream/ActionMessage.vue'
import JetFormSection from '@/jetstream/FormSection.vue'
import JetInput from '@/jetstream/Input.vue'
import JetInputError from '@/jetstream/InputError.vue'
import JetLabel from '@/jetstream/Label.vue'
import { update as updateUserPassword } from '@/routes/user-password'
import { useForm } from '@inertiajs/vue3'
import { useTemplateRef } from 'vue'

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})
const currentPasswordInput = useTemplateRef('currentPasswordInput')
const passwordInput = useTemplateRef('passwordInput')

function updatePassword() {
  form.submit(updateUserPassword(), {
    errorBag: 'updatePassword',
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation')
        passwordInput.value?.focus()
      }

      if (form.errors.current_password) {
        form.reset('current_password')
        currentPasswordInput.value?.focus()
      }
    },
  })
}
</script>
