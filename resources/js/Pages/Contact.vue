<template>
  <app-layout title="Contact">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Contact</h2>
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
            />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>

          <!-- Subject -->
          <div class="col-span-6 sm:col-span-4">
            <Label for="subject" value="Objet" />
            <Input id="subject" type="text" class="mt-1 block w-full" v-model="form.subject" />
            <InputError :message="form.errors.subject" class="mt-2" />
          </div>

          <!-- Message -->
          <div class="col-span-6 sm:col-span-4">
            <Label for="content" value="Message" />
            <TextArea id="content" class="mt-1 block w-full" v-model="form.content" required />
            <InputError :message="form.errors.content" class="mt-2" />
          </div>
        </template>
        <template #actions>
          <ActionMessage :on="form.recentlySuccessful" class="mr-3"> Envoyé. </ActionMessage>
          <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Envoyer
          </Button>
        </template>
      </FormSection>
    </div>
  </app-layout>
</template>

<script>
import TextArea from '@/Components/TextArea.vue'
import ActionMessage from '@/Jetstream/ActionMessage.vue'
import Button from '@/Jetstream/Button.vue'
import FormSection from '@/Jetstream/FormSection.vue'
import Input from '@/Jetstream/Input.vue'
import InputError from '@/Jetstream/InputError.vue'
import Label from '@/Jetstream/Label.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    Button,
    ActionMessage,
    TextArea,
    InputError,
    Input,
    Label,
    FormSection,
    AppLayout,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: '',
        email: '',
        subject: '',
        content: '',
      }),
    }
  },
  methods: {
    submit() {
      this.form.post(this.route('contact.send'), {
        onFinish: () => this.form.reset(),
      })
    },
  },
})
</script>
