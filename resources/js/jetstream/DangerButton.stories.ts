import DangerButton from '@/jetstream/DangerButton.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof DangerButton> = {
  title: 'Jetstream/DangerButton',
  component: DangerButton,
  tags: ['autodocs'],
  render: (args) => ({
    components: { DangerButton },
    setup() {
      return { args }
    },
    template: '<DangerButton v-bind="args">Delete Account</DangerButton>',
  }),
  argTypes: {
    type: {
      control: 'select',
      options: ['submit', 'button', 'reset'],
      description: 'The type of the button',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'button' },
      },
    },
  },
  args: {
    type: 'button',
  },
  parameters: {
    docs: {
      description: {
        component: 'A button with a danger style, typically used for destructive actions.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof DangerButton>

export const Default: Story = {}

export const AsSubmit: Story = {
  args: {
    type: 'submit',
  },
}
