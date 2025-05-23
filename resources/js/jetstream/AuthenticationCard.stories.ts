import AuthenticationCard from '@/jetstream/AuthenticationCard.vue'
import AuthenticationCardLogo from '@/jetstream/AuthenticationCardLogo.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof AuthenticationCard> = {
  title: 'Jetstream/AuthenticationCard',
  component: AuthenticationCard,
  tags: ['autodocs'],
  render: (args) => ({
    components: { AuthenticationCard, AuthenticationCardLogo },
    setup() {
      return { args }
    },
    template: `
      <AuthenticationCard v-bind="args">
        <template #logo>
          <AuthenticationCardLogo />
        </template>
        <div class="p-4">
          <h2 class="text-xl font-bold">Authentication Content</h2>
          <p class="mt-2">This is where the authentication form would go.</p>
        </div>
      </AuthenticationCard>
    `,
  }),
  parameters: {
    docs: {
      description: {
        component: 'A card component used for authentication forms with a slot for a logo and content.',
      },
    },
  },
}

export default meta

type Story = StoryObj<typeof AuthenticationCard>

export const Default: Story = {}

export const WithCustomContent: Story = {
  render: (args) => ({
    components: { AuthenticationCard, AuthenticationCardLogo },
    setup() {
      return { args }
    },
    template: `
      <AuthenticationCard v-bind="args">
        <template #logo>
          <AuthenticationCardLogo />
        </template>
        <div class="p-4">
          <h2 class="text-xl font-bold text-green-600">Custom Login Form</h2>
          <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
          </div>
          <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
          </div>
          <div class="mt-6">
            <button class="w-full rounded-md bg-indigo-600 px-4 py-2 text-white">Sign In</button>
          </div>
        </div>
      </AuthenticationCard>
    `,
  }),
}

export const WithoutLogo: Story = {
  render: (args) => ({
    components: { AuthenticationCard },
    setup() {
      return { args }
    },
    template: `
      <AuthenticationCard v-bind="args">
        <div class="p-4">
          <h2 class="text-xl font-bold">No Logo Example</h2>
          <p class="mt-2">This example doesn't use the logo slot.</p>
        </div>
      </AuthenticationCard>
    `,
  }),
}
