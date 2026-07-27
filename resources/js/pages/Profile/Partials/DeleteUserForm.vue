<template>
  <jet-action-section>
    <template #title>Supprimer le compte</template>

    <template #description>Supprimer définitivement ce compte.</template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Une fois que votre compte est supprimé, toutes vos données sont supprimées définitivement.
        Avant de supprimer votre compte, veuillez télécharger vos données.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmUserDeletion">Supprimer le compte</jet-danger-button>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <jet-dialog-modal :show="confirmingUserDeletion" @close="closeModal">
        <template #title>Supprimer le compte</template>

        <template #content>
          Êtes-vous sûr de vouloir supprimer votre compte ? Une fois que votre compte est supprimé,
          toutes les données associées seront supprimées définitivement. Pour confirmer que vous
          voulez supprimer définitivement votre compte, renseignez votre mot de passe.

          <div class="mt-4">
            <jet-input
              type="password"
              class="mt-1 block w-3/4"
              placeholder="Password"
              ref="passwordInput"
              v-model="form.password"
              @keyup.enter="deleteUser"
            />

            <jet-input-error :message="form.errors.password" class="mt-2" />
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="closeModal">Annuler</jet-secondary-button>

          <jet-danger-button
            class="ml-2"
            @click="deleteUser"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Supprimer le compte
          </jet-danger-button>
        </template>
      </jet-dialog-modal>
    </template>
  </jet-action-section>
</template>

<script setup lang="ts">
import JetDangerButton from '@/components/ui/buttons/DangerButton.vue'
import JetSecondaryButton from '@/components/ui/buttons/SecondaryButton.vue'
import JetDialogModal from '@/components/ui/modal/DialogModal.vue'
import JetActionSection from '@/jetstream/ActionSection.vue'
import JetInput from '@/jetstream/Input.vue'
import JetInputError from '@/jetstream/InputError.vue'
import { useForm } from '@inertiajs/vue3'
import { ref, useTemplateRef } from 'vue'

const confirmingUserDeletion = ref(false)
const passwordInput = useTemplateRef('passwordInput')
const form = useForm({
  password: '',
})
function confirmUserDeletion() {
  confirmingUserDeletion.value = true
  setTimeout(() => passwordInput.value?.focus(), 250)
}

function deleteUser() {
  form.submit('delete', '/user', {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => form.reset(),
  })
}

function closeModal() {
  confirmingUserDeletion.value = false
  form.reset()
}
</script>
