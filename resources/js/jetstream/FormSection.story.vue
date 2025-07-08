<script setup lang="ts">
import { Button } from '@/components/ui/buttons'
import FormSection from '@/jetstream/FormSection.vue'
import Input from '@/jetstream/Input.vue'
import InputError from '@/jetstream/InputError.vue'
import Label from '@/jetstream/Label.vue'
import '../../css/app.css'

function submitted() {
  console.log('Form submitted')
}
</script>

<template>
  <Story title="Jetstream/FormSection">
    <Variant title="Default">
      <FormSection @submitted="submitted">
        <template #title> Profile Information </template>
        <template #description>
          Update your account's profile information and email address.
        </template>
        <template #form>
          <div class="col-span-6 sm:col-span-4">
            <Label for="name">Name</Label>
            <Input id="name" type="text" class="mt-1 block w-full" value="John Doe" />
            <InputError message="" class="mt-2" />
          </div>
          <div class="col-span-6 sm:col-span-4">
            <Label for="email">Email</Label>
            <Input id="email" type="email" class="mt-1 block w-full" value="john@example.com" />
            <InputError message="" class="mt-2" />
          </div>
        </template>
        <template #actions>
          <Button>Save</Button>
        </template>
      </FormSection>
    </Variant>

    <Variant title="Without Actions">
      <FormSection @submitted="submitted">
        <template #title> Profile Information </template>
        <template #description>
          Update your account's profile information and email address.
        </template>
        <template #form>
          <div class="col-span-6 sm:col-span-4">
            <Label for="name">Name</Label>
            <Input id="name" type="text" class="mt-1 block w-full" value="John Doe" />
            <InputError message="" class="mt-2" />
          </div>
          <div class="col-span-6 sm:col-span-4">
            <Label for="email">Email</Label>
            <Input id="email" type="email" class="mt-1 block w-full" value="john@example.com" />
            <InputError message="" class="mt-2" />
          </div>
        </template>
      </FormSection>
    </Variant>
  </Story>
</template>
