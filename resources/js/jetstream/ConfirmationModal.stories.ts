import Button from '@/components/buttons/Button.vue'
import ConfirmationModal from '@/jetstream/ConfirmationModal.vue'
import SecondaryButton from '@/jetstream/SecondaryButton.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof ConfirmationModal> = {
  title: 'Jetstream/ConfirmationModal',
  component: ConfirmationModal,
  tags: ['autodocs'],
  render: (args) => ({
    components: { ConfirmationModal, Button, SecondaryButton },
    setup() {
      return { args }
    },
    template: `
      <div class="p-6">
        <ConfirmationModal v-bind="args">
          <template #title>
            Are you sure?
          </template>
          <template #content>
            This action cannot be undone. Are you sure you want to continue?
          </template>
          <template #footer>
            <SecondaryButton @click="args.close">Cancel</SecondaryButton>
            <Button class="ml-2">Confirm</Button>
          </template>
        </ConfirmationModal>
        <Button @click="args.show = true">Open Modal</Button>
      </div>
    `,
  }),
  argTypes: {
    show: {
      control: 'boolean',
      description: 'Whether the modal is visible',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: 'false' },
      },
    },
    maxWidth: {
      control: 'select',
      options: ['sm', 'md', 'lg', 'xl', '2xl'],
      description: 'The maximum width of the modal',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: '2xl' },
      },
    },
    closeable: {
      control: 'boolean',
      description: 'Whether the modal can be closed by clicking outside or pressing Escape',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: 'true' },
      },
    },
    close: {
      action: 'close',
      description: 'Event emitted when the modal is closed',
      table: {
        type: { summary: 'event' },
      },
    },
  },
  args: {
    show: true,
    maxWidth: '2xl',
    closeable: true,
    close: () => {},
  },
}
export default meta

type Story = StoryObj<typeof ConfirmationModal>

export const Default: Story = {}

export const NotCloseable: Story = {
  args: {
    closeable: false,
  },
}

export const SmallWidth: Story = {
  args: {
    maxWidth: 'sm',
  },
}
