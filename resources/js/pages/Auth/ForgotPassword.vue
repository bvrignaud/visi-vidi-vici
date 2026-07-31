<template>
  <Head title="Forgot Password" />

  <JetAuthenticationCard>
    <template #logo>
      <JetAuthenticationCardLogo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      Mot de passe oublié ? Pas de soucis. Veuillez nous indiquer votre adresse e-mail et nous vous
      enverrons un lien de réinitialisation du mot de passe.
    </div>

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
      {{ status }}
    </div>

    <ValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="email" value="Email" />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>

      <div class="mt-4 flex items-center justify-end">
        <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Lien de réinitialisation du mot de passe
        </Button>
      </div>
    </form>
  </JetAuthenticationCard>
</template>

<script setup lang="ts">
import ValidationErrors from '@/components/features/ValidationErrors.vue'
import Button from '@/components/ui/buttons/Button.vue'
import JetAuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import JetInput from '@/jetstream/Input.vue'
import JetLabel from '@/jetstream/Label.vue'
import { email as sendResetLink } from '@/routes/password'
import { Head, useForm } from '@inertiajs/vue3'

defineProps<{
  status?: string
}>()

const form = useForm({
  email: '',
})

const submit = () => {
  form.submit(sendResetLink())
}
</script>
