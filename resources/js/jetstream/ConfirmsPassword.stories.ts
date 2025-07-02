import Button from '@/components/buttons/Button.vue'
import ConfirmsPassword from '@/jetstream/ConfirmsPassword.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof ConfirmsPassword> = {
  title: 'Jetstream/ConfirmsPassword',
  component: ConfirmsPassword,
  tags: ['autodocs'],
  render: (args) => ({
    components: { ConfirmsPassword, Button },
    setup() {
      // Mock the axios and route functions that ConfirmsPassword uses
      window.axios = {
        get: () => Promise.resolve({ data: { confirmed: false } }),
        post: () => Promise.resolve({}),
      }
      window.route = (name) => {
        return name === 'password.confirmation' ? '/password/confirm' : '/password/confirm'
      }

      return { args }
    },
    template: `
      <ConfirmsPassword v-bind="args" @confirmed="args.confirmed">
        <Button>Confirm Password</Button>
      </ConfirmsPassword>
    `,
  }),
  argTypes: {
    title: {
      control: 'text',
      description: 'The title of the confirmation modal',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'Confirmez votre mot de passe' },
      },
    },
    content: {
      control: 'text',
      description: 'The content of the confirmation modal',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'For your security, please confirm your password to continue.' },
      },
    },
    button: {
      control: 'text',
      description: 'The text of the confirm button',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'Confirm' },
      },
    },
    confirmed: {
      action: 'confirmed',
      description: 'Event emitted when the password is confirmed',
      table: {
        type: { summary: 'event' },
      },
    },
  },
  args: {
    title: 'Confirmez votre mot de passe',
    content: 'For your security, please confirm your password to continue.',
    button: 'Confirm',
    confirmed: () => {},
  },
  parameters: {
    docs: {
      description: {
        component: 'A component that requires password confirmation before proceeding with an action.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof ConfirmsPassword>

export const Default: Story = {}

export const CustomText: Story = {
  args: {
    title: 'Custom Title',
    content: 'Custom content message for the confirmation modal.',
    button: 'Submit',
  },
}
