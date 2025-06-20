import DialogModal from '@/jetstream/DialogModal.vue'
import Button from '@/jetstream/Button.vue'
import SecondaryButton from '@/jetstream/SecondaryButton.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof DialogModal> = {
  title: 'Jetstream/DialogModal',
  component: DialogModal,
  tags: ['autodocs'],
  render: (args) => ({
    components: { DialogModal, Button, SecondaryButton },
    setup() {
      return { args }
    },
    template: `
      <div class="p-6">
        <DialogModal v-bind="args">
          <template #title>
            Dialog Title
          </template>
          <template #content>
            <p>This is the content of the dialog modal. You can put any content here, including forms, text, or other components.</p>
            <p class="mt-4">Dialog modals are used for a variety of purposes in the application.</p>
          </template>
          <template #footer>
            <SecondaryButton @click="args.close">Cancel</SecondaryButton>
            <Button class="ml-2">Save</Button>
          </template>
        </DialogModal>
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
  parameters: {
    docs: {
      description: {
        component: 'A modal dialog component with title, content, and footer sections.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof DialogModal>

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
