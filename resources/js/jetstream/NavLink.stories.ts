import NavLink from '@/jetstream/NavLink.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof NavLink> = {
  title: 'Jetstream/NavLink',
  component: NavLink,
  tags: ['autodocs'],
  render: (args) => ({
    components: { NavLink },
    setup() {
      return { args }
    },
    template: `
      <div class="flex space-x-8 bg-white p-6">
        <NavLink v-bind="args">{{ args.children || 'Dashboard' }}</NavLink>
      </div>
    `,
  }),
  argTypes: {
    href: {
      control: 'text',
      description: 'The URL that the link points to',
      table: {
        type: { summary: 'string' },
      },
    },
    active: {
      control: 'boolean',
      description: 'Whether the link is active',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: 'false' },
      },
    },
    children: {
      control: 'text',
      description: 'The content of the link',
    },
  },
  args: {
    href: '/dashboard',
    active: false,
    children: 'Dashboard',
  },
  parameters: {
    docs: {
      description: {
        component: 'A navigation link component with active state styling.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof NavLink>

export const Default: Story = {}

export const Active: Story = {
  args: {
    active: true,
  },
}

export const CustomText: Story = {
  args: {
    children: 'Settings',
    href: '/settings',
  },
}

export const MultipleLinks: Story = {
  render: (args) => ({
    components: { NavLink },
    setup() {
      return { args }
    },
    template: `
      <div class="flex space-x-8 bg-white p-6">
        <NavLink href="/dashboard" :active="true">Dashboard</NavLink>
        <NavLink href="/team" :active="false">Team</NavLink>
        <NavLink href="/projects" :active="false">Projects</NavLink>
        <NavLink href="/reports" :active="false">Reports</NavLink>
      </div>
    `,
  }),
}
