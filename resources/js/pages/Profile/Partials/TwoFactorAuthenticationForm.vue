<template>
  <jet-action-section>
    <template #title>Double authentification</template>

    <template #description>
      Ajouter une sécurité supplémentaire à votre compte en utilisant l'authentification à deux
      facteurs.
    </template>

    <template #content>
      <h3 class="text-lg font-medium text-gray-900" v-if="twoFactorEnabled">
        Vous avez activé la double authentification.
      </h3>

      <h3 class="text-lg font-medium text-gray-900" v-else>
        Vous n'avez pas activé la double authentification.
      </h3>

      <div class="mt-3 max-w-xl text-sm text-gray-600">
        <p>
          Lorsque l'authentification à deux facteurs est activée, vous serez invité à saisir un
          jeton aléatoire sécurisé lors de l'authentification. Vous pouvez récupérer ce jeton depuis
          l'application Google Authenticator de votre téléphone.
        </p>
      </div>

      <div v-if="twoFactorEnabled">
        <div v-if="qrCode">
          <div class="mt-4 max-w-xl text-sm text-gray-600">
            <p class="font-semibold">
              L'authentification à deux facteurs est maintenant activée. Enregistrez ce QR code dans
              votre application d'authentification.
            </p>
          </div>

          <div class="mt-4" v-html="qrCode"></div>
        </div>

        <div v-if="recoveryCodes.length > 0">
          <div class="mt-4 max-w-xl text-sm text-gray-600">
            <p class="font-semibold">
              Store these recovery codes in a secure password manager. They can be used to recover
              access to your account if your two factor authentication device is lost.
            </p>
          </div>

          <div class="mt-4 grid max-w-xl gap-1 rounded-lg bg-gray-100 px-4 py-4 font-mono text-sm">
            <div v-for="code in recoveryCodes" :key="code">
              {{ code }}
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <div v-if="!twoFactorEnabled">
          <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
            <Button type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
              Activer
            </Button>
          </jet-confirms-password>
        </div>

        <div v-else>
          <jet-confirms-password @confirmed="regenerateRecoveryCodes">
            <jet-secondary-button class="mr-3" v-if="recoveryCodes.length > 0">
              Régénérer les codes de récupération
            </jet-secondary-button>
          </jet-confirms-password>

          <jet-confirms-password @confirmed="showRecoveryCodes">
            <jet-secondary-button class="mr-3" v-if="recoveryCodes.length === 0">
              Show Recovery Codes
            </jet-secondary-button>
          </jet-confirms-password>

          <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
            <jet-danger-button :class="{ 'opacity-25': disabling }" :disabled="disabling">
              Disable
            </jet-danger-button>
          </jet-confirms-password>
        </div>
      </div>
    </template>
  </jet-action-section>
</template>

<script lang="ts">
import Button from '@/components/ui/buttons/Button.vue'
import JetDangerButton from '@/components/ui/buttons/DangerButton.vue'
import JetSecondaryButton from '@/components/ui/buttons/SecondaryButton.vue'
import JetActionSection from '@/jetstream/ActionSection.vue'
import JetConfirmsPassword from '@/jetstream/ConfirmsPassword.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    JetActionSection,
    Button,
    JetConfirmsPassword,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      enabling: false,
      disabling: false,

      qrCode: null,
      recoveryCodes: [],
    }
  },

  methods: {
    enableTwoFactorAuthentication() {
      this.enabling = true

      this.$inertia.post(
        '/user/two-factor-authentication',
        {},
        {
          preserveScroll: true,
          onSuccess: () => Promise.all([this.showQrCode(), this.showRecoveryCodes()]),
          onFinish: () => (this.enabling = false),
        },
      )
    },

    showQrCode() {
      return axios.get('/user/two-factor-qr-code').then((response) => {
        this.qrCode = response.data.svg
      })
    },

    showRecoveryCodes() {
      return axios.get('/user/two-factor-recovery-codes').then((response) => {
        this.recoveryCodes = response.data
      })
    },

    regenerateRecoveryCodes() {
      axios.post('/user/two-factor-recovery-codes').then(() => {
        this.showRecoveryCodes()
      })
    },

    disableTwoFactorAuthentication() {
      this.disabling = true

      this.$inertia.delete('/user/two-factor-authentication', {
        preserveScroll: true,
        onSuccess: () => (this.disabling = false),
      })
    },
  },

  computed: {
    twoFactorEnabled() {
      return !this.enabling && this.$page.props.auth.user.two_factor_enabled
    },
  },
})
</script>
