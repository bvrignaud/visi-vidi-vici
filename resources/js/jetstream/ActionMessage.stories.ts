import ActionMessage from '@/jetstream/ActionMessage.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof ActionMessage> = {
  title: 'Jetstream/ActionMessage',
  component: ActionMessage,
  tags: ['autodocs'],
  render: (args) => ({
    components: { ActionMessage },
    setup() {
      return { args }
    },
    template: '<ActionMessage v-bind="args">Action was successful</ActionMessage>',
  }),
  argTypes: {
    on: {
      control: 'boolean',
      description: 'Controls the visibility of the message',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: 'false' },
      },
    },
  },
  args: {
    on: false,
  },
}
export default meta

type Story = StoryObj<typeof ActionMessage>

export const Visible: Story = {
  args: {
    on: true,
  },
}

export const Hidden: Story = {}
