<template>
  <span>
    <span @click="startConfirmingPassword">
      <slot />
    </span>

    <JetDialogModal :show="confirmingPassword" @close="closeModal">
      <template #title>
        {{ title }}
      </template>

      <template #content>
        {{ content }}

        <div class="mt-4">
          <JetInput
            ref="passwordInput"
            v-model="form.password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="Password"
            @keyup.enter="confirmPassword"
          />

          <JetInputError :message="form.errors.password" class="mt-2" />
        </div>
      </template>

      <template #footer>
        <JetSecondaryButton @click="closeModal"> Cancel </JetSecondaryButton>

        <Button
          class="ml-2"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
          @click="confirmPassword"
        >
          {{ button }}
        </Button>
      </template>
    </JetDialogModal>
  </span>
</template>

<script setup lang="ts">
import Button from '@/components/ui/buttons/Button.vue'
import { confirmation as passwordConfirmation } from '@/routes/password'
import { store as passwordConfirmStore } from '@/routes/password/confirm'
import { useHttp } from '@inertiajs/vue3'
import { nextTick, ref } from 'vue'
import JetSecondaryButton from '../components/ui/buttons/SecondaryButton.vue'
import JetDialogModal from '../components/ui/modal/DialogModal.vue'
import JetInput from './Input.vue'
import JetInputError from './InputError.vue'

defineProps<{
  title?: string
  content?: string
  button?: string
}>()

const emit = defineEmits<{
  (e: 'confirmed'): void
}>()

const confirmingPassword = ref(false)
const passwordInput = ref<any>(null)

const form = useHttp({
  password: '',
})

const startConfirmingPassword = () => {
  form.get(passwordConfirmation().url, {
    onSuccess: (response: any) => {
      if (response.confirmed) {
        emit('confirmed')
      } else {
        confirmingPassword.value = true

        setTimeout(() => passwordInput.value?.focus(), 250)
      }
    },
  })
}

const confirmPassword = () => {
  form.post(passwordConfirmStore().url, {
    onSuccess: () => {
      closeModal()
      nextTick(() => emit('confirmed'))
    },
    onError: () => {
      passwordInput.value?.focus()
    },
  })
}

const closeModal = () => {
  confirmingPassword.value = false
  form.reset()
  form.clearErrors()
}
</script>
