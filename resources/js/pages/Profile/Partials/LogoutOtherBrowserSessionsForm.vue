<template>
  <JetActionSection>
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
      <div v-if="sessions.length > 0" class="mt-5 space-y-6">
        <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
          <div>
            <svg
              v-if="session.agent.is_desktop"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              viewBox="0 0 24 24"
              stroke="currentColor"
              class="h-8 w-8 text-gray-500"
            >
              <path
                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
              ></path>
            </svg>

            <svg
              v-else
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              stroke-width="2"
              stroke="currentColor"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="h-8 w-8 text-gray-500"
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

                <span v-if="session.is_current_device" class="font-semibold text-green-500">
                  Cet appareil
                </span>
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

        <JetActionMessage :on="form.recentlySuccessful" class="ml-3"> Terminé. </JetActionMessage>
      </div>

      <!-- Log Out Other Devices Confirmation Modal -->
      <JetDialogModal :show="confirmingLogout" @close="closeModal">
        <template #title> Déconnecter les sessions ouvertes sur d'autres navigateurs</template>

        <template #content>
          Veuillez entrer votre mot de passe pour confirmer que vous voulez déconnecter toutes les
          autres sessions navigateur sur l'ensemble de vos appareils.

          <div class="mt-4">
            <JetInput
              ref="passwordInput"
              v-model="form.password"
              type="password"
              class="mt-1 block w-3/4"
              placeholder="Password"
              @keyup.enter="logoutOtherBrowserSessions"
            />

            <JetInputError :message="form.errors.password" class="mt-2" />
          </div>
        </template>

        <template #footer>
          <JetSecondaryButton @click="closeModal"> Annuler</JetSecondaryButton>

          <Button
            class="ml-2"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="logoutOtherBrowserSessions"
          >
            Déconnecter les sessions ouvertes sur d'autres navigateurs
          </Button>
        </template>
      </JetDialogModal>
    </template>
  </JetActionSection>
</template>

<script setup lang="ts">
import Button from '@/components/ui/buttons/Button.vue'
import JetSecondaryButton from '@/components/ui/buttons/SecondaryButton.vue'
import JetDialogModal from '@/components/ui/modal/DialogModal.vue'
import JetActionMessage from '@/jetstream/ActionMessage.vue'
import JetActionSection from '@/jetstream/ActionSection.vue'
import JetInput from '@/jetstream/Input.vue'
import JetInputError from '@/jetstream/InputError.vue'
import { destroy as logoutOtherDevices } from '@/routes/other-browser-sessions'
import { useForm } from '@inertiajs/vue3'
import { ref, useTemplateRef } from 'vue'

defineProps<{
  sessions: any[]
}>()

const confirmingLogout = ref(false)
const passwordInput = useTemplateRef('passwordInput')

const form = useForm({
  password: '',
})

const confirmLogout = () => {
  confirmingLogout.value = true

  setTimeout(() => passwordInput.value?.focus(), 250)
}

const logoutOtherBrowserSessions = () => {
  form.submit(logoutOtherDevices(), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onError: () => passwordInput.value?.focus(),
    onFinish: () => form.reset(),
  })
}

const closeModal = () => {
  confirmingLogout.value = false

  form.reset()
}
</script>
