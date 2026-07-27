<template>
  <app-layout title="Profil">
    <template #header>
      <h2 class="text-xl leading-tight font-semibold text-gray-800">Profil</h2>
    </template>

    <div>
      <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        <div>
          <update-profile-information-form :user="$page.props.auth.user" />

          <jet-section-border />
        </div>

        <div>
          <update-password-form class="mt-10 sm:mt-0" />

          <jet-section-border />
        </div>

        <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

        <div>
          <jet-section-border />
          <delete-user-form class="mt-10 sm:mt-0" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script lang="ts">
import JetSectionBorder from '@/jetstream/SectionBorder.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import DeleteUserForm from '@/pages/Profile/Partials/DeleteUserForm.vue'
import LogoutOtherBrowserSessionsForm from '@/pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import UpdatePasswordForm from '@/pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/pages/Profile/Partials/UpdateProfileInformationForm.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  props: ['sessions'],

  components: {
    AppLayout,
    DeleteUserForm,
    JetSectionBorder,
    LogoutOtherBrowserSessionsForm,
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  },
})
</script>
