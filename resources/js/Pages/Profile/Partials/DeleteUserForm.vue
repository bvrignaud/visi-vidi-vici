<template>
  <jet-action-section>
    <template #title> Supprimer le compte </template>

    <template #description> Supprimer définitivement ce compte. </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Une fois que votre compte est supprimé, toutes vos données sont supprimées définitivement.
        Avant de supprimer votre compte, veuillez télécharger vos données.
      </div>

      <div class="mt-5">
        <jet-danger-button @click="confirmUserDeletion"> Supprimer le compte </jet-danger-button>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <jet-dialog-modal :show="confirmingUserDeletion" @close="closeModal">
        <template #title> Supprimer le compte </template>

        <template #content>
          Êtes-vous sûr de vouloir supprimer votre compte ? Une fois que votre compte est supprimé,
          toutes les données associées seront supprimées définitivement. Pour confirmer que vous
          voulez supprimer définitivement votre compte, renseignez votre mot de passe.

          <div class="mt-4">
            <jet-input
              type="password"
              class="mt-1 block w-3/4"
              placeholder="Password"
              ref="password"
              v-model="form.password"
              @keyup.enter="deleteUser"
            />

            <jet-input-error :message="form.errors.password" class="mt-2" />
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="closeModal"> Annuler </jet-secondary-button>

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

<script>
import JetActionSection from '@/Jetstream/ActionSection.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    JetActionSection,
    JetDangerButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingUserDeletion: false,

      form: this.$inertia.form({
        password: '',
      }),
    }
  },

  methods: {
    confirmUserDeletion() {
      this.confirmingUserDeletion = true

      setTimeout(() => this.$refs.password.focus(), 250)
    },

    deleteUser() {
      this.form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onError: () => this.$refs.password.focus(),
        onFinish: () => this.form.reset(),
      })
    },

    closeModal() {
      this.confirmingUserDeletion = false

      this.form.reset()
    },
  },
})
</script>
