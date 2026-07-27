<template>
  <jet-form-section @submitted="updateProfileInformation">
    <template #title>Information du profil</template>

    <template #description>
      Modifier le profil associé à votre compte ainsi que votre adresse e-mail.
    </template>

    <template #form>
      <!-- Profile Photo -->
      <div class="col-span-6 sm:col-span-4">
        <!-- Profile Photo File Input -->
        <input type="file" class="hidden" ref="photoInput" @change="updatePhotoPreview" />

        <jet-label for="photo" value="Photo" />

        <!-- Current Profile Photo -->
        <div class="mt-2" v-show="!photoPreview">
          <img
            :src="user.profile_photo_url"
            :alt="user.name"
            class="h-20 w-20 rounded-full object-cover"
          />
        </div>

        <!-- New Profile Photo Preview -->
        <div class="mt-2" v-show="photoPreview">
          <span
            class="block h-20 w-20 rounded-full bg-cover bg-center bg-no-repeat"
            :style="'background-image: url(\'' + photoPreview + '\');'"
          >
          </span>
        </div>

        <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
          Sélectionner une nouvelle image
        </jet-secondary-button>

        <jet-secondary-button
          type="button"
          class="mt-2"
          @click.prevent="deletePhoto"
          v-if="user.profile_photo_path"
        >
          Supprimer l'image
        </jet-secondary-button>

        <jet-input-error :message="form.errors.photo" class="mt-2" />
      </div>

      <!-- Name -->
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="name" value="Nom" />
        <jet-input
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          autocomplete="name"
        />
        <jet-input-error :message="form.errors.name" class="mt-2" />
      </div>

      <!-- Email -->
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="email" value="Email" />
        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
        <jet-input-error :message="form.errors.email" class="mt-2" />
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
import JetSecondaryButton from '@/components/ui/buttons/SecondaryButton.vue'
import JetActionMessage from '@/jetstream/ActionMessage.vue'
import JetFormSection from '@/jetstream/FormSection.vue'
import JetInput from '@/jetstream/Input.vue'
import JetInputError from '@/jetstream/InputError.vue'
import JetLabel from '@/jetstream/Label.vue'
import { destroy as deletePhotoRoute } from '@/routes/current-user-photo'
import { update as updateProfileInfo } from '@/routes/user-profile-information'
import { router, useForm, usePage } from '@inertiajs/vue3'
import { computed, ref, useTemplateRef } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth.user)

const form = useForm({
  _method: 'PUT',
  name: user.value.name,
  email: user.value.email,
  photo: null,
} as { _method: string; name: string; email: string; photo: null | File })
const photoPreview = ref<string | null>(null)
const photoInput = useTemplateRef('photoInput')

function updateProfileInformation() {
  if (photoInput.value) {
    form.photo = photoInput.value?.files ? photoInput.value?.files[0] : null
  }

  form.submit(updateProfileInfo(), {
    errorBag: 'updateProfileInformation',
    preserveScroll: true,
    onSuccess: () => clearPhotoFileInput(),
  })
}

function selectNewPhoto() {
  photoInput.value?.click()
}

function updatePhotoPreview() {
  const photo = photoInput.value?.files ? photoInput.value?.files[0] : null

  if (!photo) return

  const reader = new FileReader()

  reader.onload = (e) => {
    photoPreview.value = (e.target?.result as string) ?? ''
  }

  reader.readAsDataURL(photo)
}

function deletePhoto() {
  router.visit(deletePhotoRoute(), {
    preserveScroll: true,
    onSuccess: () => {
      photoPreview.value = null
      clearPhotoFileInput()
    },
  })
}

function clearPhotoFileInput() {
  if (photoInput.value?.value) {
    photoInput.value.value = ''
  }
}
</script>
