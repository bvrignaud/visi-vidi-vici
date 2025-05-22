import AuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof AuthenticationCardLogo> = {
  title: 'Jetstream/AuthenticationCardLogo',
  component: AuthenticationCardLogo,
  tags: ['autodocs'],
  render: (args) => ({
    components: { AuthenticationCardLogo },
    setup() {
      return { args }
    },
    template: '<AuthenticationCardLogo v-bind="args" />',
  }),
  parameters: {
    // Add a light background to make the logo visible
    backgrounds: { default: 'light' },
  },
}
export default meta

type Story = StoryObj<typeof AuthenticationCardLogo>

export const Default: Story = {}
