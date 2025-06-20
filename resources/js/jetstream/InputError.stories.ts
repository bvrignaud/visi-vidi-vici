import InputError from '@/jetstream/InputError.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof InputError> = {
  title: 'Jetstream/InputError',
  component: InputError,
  tags: ['autodocs'],
  render: (args) => ({
    components: { InputError },
    setup() {
      return { args }
    },
    template: '<InputError v-bind="args" />',
  }),
  argTypes: {
    message: {
      control: 'text',
      description: 'The error message to display',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: '' },
      },
    },
  },
  args: {
    message: 'This field is required.',
  },
  parameters: {
    docs: {
      description: {
        component: 'A component for displaying form input error messages.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof InputError>

export const WithMessage: Story = {}

export const WithLongMessage: Story = {
  args: {
    message: 'This is a longer error message that explains what went wrong with this form field and how to fix it.',
  },
}

export const WithoutMessage: Story = {
  args: {
    message: '',
  },
}
