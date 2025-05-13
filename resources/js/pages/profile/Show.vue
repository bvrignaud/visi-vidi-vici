<template>
  <app-layout title="Profil">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Profil</h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
          <update-profile-information-form :user="$page.props.auth.user" />

          <jet-section-border />
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
          <update-password-form class="mt-10 sm:mt-0" />

          <jet-section-border />
        </div>

        <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
          <two-factor-authentication-form class="mt-10 sm:mt-0" />

          <jet-section-border />
        </div>

        <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

        <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
          <jet-section-border />

          <delete-user-form class="mt-10 sm:mt-0" />
        </template>
      </div>
    </div>
  </app-layout>
</template>

<script lang="ts">
import JetSectionBorder from '@/jetstream/SectionBorder.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import DeleteUserForm from '@/pages/profile/Partials/DeleteUserForm.vue'
import LogoutOtherBrowserSessionsForm from '@/pages/profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import TwoFactorAuthenticationForm from '@/pages/profile/Partials/TwoFactorAuthenticationForm.vue'
import UpdatePasswordForm from '@/pages/profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/pages/profile/Partials/UpdateProfileInformationForm.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  props: ['sessions'],

  components: {
    AppLayout,
    DeleteUserForm,
    JetSectionBorder,
    LogoutOtherBrowserSessionsForm,
    TwoFactorAuthenticationForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  },
})
</script>
