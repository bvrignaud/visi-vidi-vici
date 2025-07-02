import Button from '@/components/buttons/Button.vue'
import Modal from '@/jetstream/Modal.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof Modal> = {
  title: 'Jetstream/Modal',
  component: Modal,
  tags: ['autodocs'],
  render: (args) => ({
    components: { Modal, Button },
    setup() {
      return { args }
    },
    template: `
      <div class="p-6">
        <Modal v-bind="args">
          <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Modal Content</h2>
            <p class="mt-3 text-sm text-gray-600">
              This is the content of the modal. The Modal component is a base component used by DialogModal and ConfirmationModal.
            </p>
            <div class="mt-4 flex justify-end">
              <Button @click="args.close">Close Modal</Button>
            </div>
          </div>
        </Modal>
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
        component: 'A base modal component with customizable width and close behavior.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof Modal>

export const Default: Story = {}

export const SmallWidth: Story = {
  args: {
    maxWidth: 'sm',
  },
}

export const MediumWidth: Story = {
  args: {
    maxWidth: 'md',
  },
}

export const LargeWidth: Story = {
  args: {
    maxWidth: 'lg',
  },
}

export const NotCloseable: Story = {
  args: {
    closeable: false,
  },
}
