import SectionTitle from '@/jetstream/SectionTitle.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof SectionTitle> = {
  title: 'Jetstream/SectionTitle',
  component: SectionTitle,
  tags: ['autodocs'],
  render: (args) => ({
    components: { SectionTitle },
    setup() {
      return { args }
    },
    template: `
      <SectionTitle v-bind="args">
        <template #title>
          {{ args.title || 'Profile Information' }}
        </template>
        <template #description>
          {{ args.description || "Update your account's profile information and email address." }}
        </template>
        <template #aside v-if="args.aside">
          {{ args.aside }}
        </template>
      </SectionTitle>
    `,
  }),
  argTypes: {
    title: {
      control: 'text',
      description: 'The title of the section',
    },
    description: {
      control: 'text',
      description: 'The description of the section',
    },
    aside: {
      control: 'text',
      description: 'Content to display in the aside slot',
    },
  },
  args: {
    title: 'Profile Information',
    description: "Update your account's profile information and email address.",
    aside: '',
  },
  parameters: {
    docs: {
      description: {
        component: 'A component for displaying a section title with description and optional aside content.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof SectionTitle>

export const Default: Story = {}

export const WithAside: Story = {
  args: {
    aside: 'Last updated: 2 days ago',
  },
}

export const CustomContent: Story = {
  args: {
    title: 'Security Settings',
    description: 'Manage your account security settings and two-factor authentication.',
  },
}
