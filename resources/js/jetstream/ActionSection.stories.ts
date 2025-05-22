import ActionSection from '@/jetstream/ActionSection.vue'
import Button from '@/jetstream/Button.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof ActionSection> = {
  title: 'Jetstream/ActionSection',
  component: ActionSection,
  tags: ['autodocs'],
  render: (args) => ({
    components: { ActionSection, Button },
    setup() {
      return { args }
    },
    template: `
      <ActionSection v-bind="args">
        <template #title>
          {{ args.title || 'Browser Sessions' }}
        </template>
        <template #description>
          {{ args.description || "Manage and log out your active sessions on other browsers and devices." }}
        </template>
        <template #content>
          <div class="max-w-xl text-sm text-gray-600">
            <p>
              If necessary, you may log out of all of your other browser sessions across all of your devices.
              Some of your recent sessions are listed below; however, this list may not be exhaustive.
              If you feel your account has been compromised, you should also update your password.
            </p>
          </div>

          <div class="mt-5">
            <Button>Log Out Other Browser Sessions</Button>
          </div>
        </template>
      </ActionSection>
    `,
  }),
  argTypes: {
    title: {
      control: 'text',
      description: 'The title of the section',
    },
    description: {
      control: 'text',
      description: 'The description of the section',
    },
  },
  args: {
    title: 'Browser Sessions',
    description: "Manage and log out your active sessions on other browsers and devices.",
  },
  parameters: {
    docs: {
      description: {
        component: 'A component for displaying a section with a title, description, and content area.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof ActionSection>

export const Default: Story = {}

export const CustomContent: Story = {
  args: {
    title: 'Delete Account',
    description: 'Permanently delete your account.',
  },
  render: (args) => ({
    components: { ActionSection, Button },
    setup() {
      return { args }
    },
    template: `
      <ActionSection v-bind="args">
        <template #title>
          {{ args.title }}
        </template>
        <template #description>
          {{ args.description }}
        </template>
        <template #content>
          <div class="max-w-xl text-sm text-gray-600">
            <p>
              Once your account is deleted, all of its resources and data will be permanently deleted.
              Before deleting your account, please download any data or information that you wish to retain.
            </p>
          </div>

          <div class="mt-5">
            <Button class="bg-red-600 hover:bg-red-700">Delete Account</Button>
          </div>
        </template>
      </ActionSection>
    `,
  }),
}
