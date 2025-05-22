import ResponsiveNavLink from '@/jetstream/ResponsiveNavLink.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof ResponsiveNavLink> = {
  title: 'Jetstream/ResponsiveNavLink',
  component: ResponsiveNavLink,
  tags: ['autodocs'],
  render: (args) => ({
    components: { ResponsiveNavLink },
    setup() {
      return { args }
    },
    template: `
      <div class="w-64 bg-white p-4">
        <ResponsiveNavLink v-bind="args">{{ args.children || 'Dashboard' }}</ResponsiveNavLink>
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
    as: {
      control: 'select',
      options: [undefined, 'button'],
      description: 'The element type to render the link as',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'undefined (renders as Inertia Link)' },
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
        component: 'A responsive navigation link component for mobile menus.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof ResponsiveNavLink>

export const Default: Story = {}

export const Active: Story = {
  args: {
    active: true,
  },
}

export const AsButton: Story = {
  args: {
    as: 'button',
    children: 'Logout',
  },
}

export const MultipleLinks: Story = {
  render: (args) => ({
    components: { ResponsiveNavLink },
    setup() {
      return { args }
    },
    template: `
      <div class="w-64 bg-white p-4 space-y-1">
        <ResponsiveNavLink href="/dashboard" :active="true">Dashboard</ResponsiveNavLink>
        <ResponsiveNavLink href="/team">Team</ResponsiveNavLink>
        <ResponsiveNavLink href="/projects">Projects</ResponsiveNavLink>
        <ResponsiveNavLink href="/reports">Reports</ResponsiveNavLink>
        <ResponsiveNavLink as="button">Logout</ResponsiveNavLink>
      </div>
    `,
  }),
}
