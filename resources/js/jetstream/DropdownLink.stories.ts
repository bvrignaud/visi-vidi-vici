import DropdownLink from '@/jetstream/DropdownLink.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof DropdownLink> = {
  title: 'Jetstream/DropdownLink',
  component: DropdownLink,
  tags: ['autodocs'],
  render: (args) => ({
    components: { DropdownLink },
    setup() {
      return { args }
    },
    template: `
      <div class="p-6 bg-white rounded-lg shadow">
        <DropdownLink v-bind="args">{{ args.children || 'Dropdown Link' }}</DropdownLink>
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
    as: {
      control: 'select',
      options: [undefined, 'button', 'a'],
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
    href: '/example',
    children: 'Dropdown Link',
  },
  parameters: {
    docs: {
      description: {
        component: 'A link component designed to be used within a Dropdown component.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof DropdownLink>

export const Default: Story = {}

export const AsButton: Story = {
  args: {
    as: 'button',
    children: 'Button Link',
  },
}

export const AsAnchor: Story = {
  args: {
    as: 'a',
    children: 'Anchor Link',
  },
}
