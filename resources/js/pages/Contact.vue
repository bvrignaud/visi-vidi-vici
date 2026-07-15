<template>
  <app-layout title="Contact">
    <template #header>
      <h2 class="text-xl leading-tight font-semibold text-gray-800">Contact</h2>
    </template>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
      <FormSection @submitted="submit">
        <template #title>Contact</template>
        <template #description>N'hésitez pas, contactez nous !</template>

        <template #form>
          <!-- Name -->
          <div class="col-span-6 sm:col-span-4">
            <Label for="name" value="Nom" />
            <Input
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              autocomplete="name"
              @change="form.validate('name')"
            />
            <InputError :message="form.errors.name" class="mt-2" />
          </div>

          <!-- Email -->
          <div class="col-span-6 sm:col-span-4">
            <Label for="email" value="Email" />
            <Input
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              required
              @change="form.validate('email')"
            />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>

          <!-- Subject -->
          <div class="col-span-6 sm:col-span-4">
            <Label for="subject" value="Objet" />
            <Input
              id="subject"
              type="text"
              class="mt-1 block w-full"
              v-model="form.subject"
              @change="form.validate('subject')"
            />
            <InputError :message="form.errors.subject" class="mt-2" />
          </div>

          <!-- Message -->
          <div class="col-span-6 sm:col-span-4">
            <Label for="content" value="Message" />
            <TextArea
              id="content"
              class="mt-1 block w-full"
              v-model="form.content"
              required
              @change="form.validate('content')"
            />
            <InputError :message="form.errors.content" class="mt-2" />
          </div>
        </template>
        <template #actions>
          <ActionMessage :on="form.recentlySuccessful" class="mr-3">Envoyé.</ActionMessage>
          <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Envoyer
          </Button>
        </template>
      </FormSection>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import TextArea from '@/components/features/TextArea.vue'
import Button from '@/components/ui/buttons/Button.vue'
import ActionMessage from '@/jetstream/ActionMessage.vue'
import FormSection from '@/jetstream/FormSection.vue'
import Input from '@/jetstream/Input.vue'
import InputError from '@/jetstream/InputError.vue'
import Label from '@/jetstream/Label.vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { send as contactSend } from '@/routes/contact'
import { useForm } from 'laravel-precognition-vue-inertia'

const form = useForm('post', contactSend().url, {
  name: '',
  email: '',
  subject: '',
  content: '',
})

const submit = () =>
  form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
</script>
