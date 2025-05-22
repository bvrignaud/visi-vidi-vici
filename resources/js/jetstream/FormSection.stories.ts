import FormSection from '@/jetstream/FormSection.vue'
import Button from '@/jetstream/Button.vue'
import Input from '@/jetstream/Input.vue'
import Label from '@/jetstream/Label.vue'
import InputError from '@/jetstream/InputError.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof FormSection> = {
  title: 'Jetstream/FormSection',
  component: FormSection,
  tags: ['autodocs'],
  render: (args) => ({
    components: { FormSection, Button, Input, Label, InputError },
    setup() {
      return { args }
    },
    template: `
      <FormSection v-bind="args" @submitted="args.submitted">
        <template #title>
          Profile Information
        </template>
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
    `,
  }),
  argTypes: {
    submitted: {
      action: 'submitted',
      description: 'Event emitted when the form is submitted',
      table: {
        type: { summary: 'event' },
      },
    },
  },
  args: {
    submitted: () => {},
  },
  parameters: {
    docs: {
      description: {
        component: 'A form section component with title, description, form fields, and action buttons.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof FormSection>

export const Default: Story = {}

export const WithoutActions: Story = {
  render: (args) => ({
    components: { FormSection, Input, Label, InputError },
    setup() {
      return { args }
    },
    template: `
      <FormSection v-bind="args" @submitted="args.submitted">
        <template #title>
          Profile Information
        </template>
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
    `,
  }),
}
