import Dropdown from '@/jetstream/Dropdown.vue'
import DropdownLink from '@/jetstream/DropdownLink.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof Dropdown> = {
  title: 'Jetstream/Dropdown',
  component: Dropdown,
  tags: ['autodocs'],
  render: (args) => ({
    components: { Dropdown, DropdownLink },
    setup() {
      return { args }
    },
    template: `
      <div class="p-6">
        <Dropdown v-bind="args">
          <template #trigger>
            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-hidden">
              <span>Options</span>
              <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </button>
          </template>
          <template #content>
            <DropdownLink href="/profile">Profile</DropdownLink>
            <DropdownLink href="/settings">Settings</DropdownLink>
            <DropdownLink href="/logout" as="button">Logout</DropdownLink>
          </template>
        </Dropdown>
      </div>
    `,
  }),
  argTypes: {
    align: {
      control: 'select',
      options: ['left', 'right'],
      description: 'The alignment of the dropdown',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'right' },
      },
    },
    width: {
      control: 'text',
      description: 'The width of the dropdown',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: '48' },
      },
    },
    contentClasses: {
      control: 'array',
      description: 'Additional classes for the dropdown content',
      table: {
        type: { summary: 'array' },
        defaultValue: { summary: "['py-1', 'bg-white']" },
      },
    },
  },
  args: {
    align: 'right',
    width: '48',
    contentClasses: ['py-1', 'bg-white'],
  },
  parameters: {
    docs: {
      description: {
        component: 'A dropdown menu component with customizable trigger and content.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof Dropdown>

export const Default: Story = {}

export const LeftAligned: Story = {
  args: {
    align: 'left',
  },
}

export const CustomClasses: Story = {
  args: {
    contentClasses: ['py-2', 'bg-gray-100', 'rounded-lg'],
  },
}
