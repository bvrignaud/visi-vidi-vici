import SecondaryButton from '@/jetstream/SecondaryButton.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof SecondaryButton> = {
  title: 'Jetstream/SecondaryButton',
  component: SecondaryButton,
  tags: ['autodocs'],
  render: (args) => ({
    components: { SecondaryButton },
    setup() {
      return { args }
    },
    template: '<SecondaryButton v-bind="args">{{ args.children || "Cancel" }}</SecondaryButton>',
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
    children: {
      control: 'text',
      description: 'The content of the button',
    },
  },
  args: {
    type: 'button',
    children: 'Cancel',
  },
  parameters: {
    docs: {
      description: {
        component: 'A secondary button component with a subtle style, typically used for cancel actions.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof SecondaryButton>

export const Default: Story = {}

export const AsSubmit: Story = {
  args: {
    type: 'submit',
    children: 'Submit',
  },
}

export const CustomText: Story = {
  args: {
    children: 'Go Back',
  },
}
