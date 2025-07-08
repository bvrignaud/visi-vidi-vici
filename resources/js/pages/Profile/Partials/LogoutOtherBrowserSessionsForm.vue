<template>
  <jet-action-section>
    <template #title> Sessions de navigateur</template>

    <template #description>
      Gérer et déconnecter vos sessions actives sur les autres navigateurs et appareils.
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600">
        Si nécessaire, vous pouvez vous déconnecter de toutes vos sessions de navigateur de tous vos
        appareils. Certaines de vos sessions sont listées plus bas ; pourtant, cette liste peut ne
        pas être exhaustive. Si vous sentez que votre compte a été compromis, vous pouvez aussi
        mettre à jour votre mot de passe.
      </div>

      <!-- Other Browser Sessions -->
      <div class="mt-5 space-y-6" v-if="sessions.length > 0">
        <div class="flex items-center" v-for="(session, i) in sessions" :key="i">
          <div>
            <svg
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor"
              class="h-8 w-8 text-gray-500"
              v-if="session.agent.is_desktop"
            >
              <path
                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
              ></path>
            </svg>

            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="h-8 w-8 text-gray-500"
              v-else
            >
              <path d="M0 0h24v24H0z" stroke="none"></path>
              <rect x="7" y="4" width="10" height="16" rx="1"></rect>
              <path d="M11 5h2M12 17v.01"></path>
            </svg>
          </div>

          <div class="ml-3">
            <div class="text-sm text-gray-600">
              {{ session.agent.platform }} - {{ session.agent.browser }}
            </div>

            <div>
              <div class="text-xs text-gray-500">
                {{ session.ip_address }},

                <span class="font-semibold text-green-500" v-if="session.is_current_device"
                  >Cet appareil</span
                >
                <span v-else>Last active {{ session.last_active }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5 flex items-center">
        <Button @click="confirmLogout">
          Déconnecter les sessions ouvertes sur d'autres navigateurs
        </Button>

        <jet-action-message :on="form.recentlySuccessful" class="ml-3">
          Terminé.
        </jet-action-message>
      </div>

      <!-- Log Out Other Devices Confirmation Modal -->
      <jet-dialog-modal :show="confirmingLogout" @close="closeModal">
        <template #title> Déconnecter les sessions ouvertes sur d'autres navigateurs</template>

        <template #content>
          Veuillez entrer votre mot de passe pour confirmer que vous voulez déconnecter toutes les
          autres sessions navigateur sur l'ensemble de vos appareils.

          <div class="mt-4">
            <jet-input
              type="password"
              class="mt-1 block w-3/4"
              placeholder="Password"
              ref="password"
              v-model="form.password"
              @keyup.enter="logoutOtherBrowserSessions"
            />

            <jet-input-error :message="form.errors.password" class="mt-2" />
          </div>
        </template>

        <template #footer>
          <jet-secondary-button @click="closeModal"> Annuler</jet-secondary-button>

          <Button
            class="ml-2"
            @click="logoutOtherBrowserSessions"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Déconnecter les sessions ouvertes sur d'autres navigateurs
          </Button>
        </template>
      </jet-dialog-modal>
    </template>
  </jet-action-section>
</template>

<script>
import Button from '@/components/ui/buttons/Button.vue'
import JetSecondaryButton from '@/components/ui/buttons/SecondaryButton.vue'
import JetDialogModal from '@/components/ui/modal/DialogModal.vue'
import JetActionMessage from '@/jetstream/ActionMessage.vue'
import JetActionSection from '@/jetstream/ActionSection.vue'
import JetInput from '@/jetstream/Input.vue'
import JetInputError from '@/jetstream/InputError.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  props: ['sessions'],

  components: {
    JetActionMessage,
    JetActionSection,
    Button,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
  },

  data() {
    return {
      confirmingLogout: false,

      form: this.$inertia.form({
        password: '',
      }),
    }
  },

  methods: {
    confirmLogout() {
      this.confirmingLogout = true

      setTimeout(() => this.$refs.password.focus(), 250)
    },

    logoutOtherBrowserSessions() {
      this.form.delete(route('other-browser-sessions.destroy'), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onError: () => this.$refs.password.focus(),
        onFinish: () => this.form.reset(),
      })
    },

    closeModal() {
      this.confirmingLogout = false

      this.form.reset()
    },
  },
})
</script>
