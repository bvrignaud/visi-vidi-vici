import Checkbox from '@/jetstream/Checkbox.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

const meta: Meta<typeof Checkbox> = {
  title: 'Jetstream/Checkbox',
  component: Checkbox,
  tags: ['autodocs'],
  render: (args) => ({
    components: { Checkbox },
    setup() {
      return { args }
    },
    template: '<Checkbox v-bind="args" />',
  }),
  argTypes: {
    checked: {
      control: 'boolean',
      description: 'Whether the checkbox is checked',
      table: {
        type: { summary: 'boolean | array' },
        defaultValue: { summary: 'false' },
      },
    },
    value: {
      control: 'text',
      description: 'The value of the checkbox when used in a group',
      table: {
        type: { summary: 'any' },
        defaultValue: { summary: 'null' },
      },
    },
    'update:checked': {
      action: 'update:checked',
      description: 'Event emitted when the checkbox state changes',
      table: {
        type: { summary: 'event' },
      },
    },
  },
  args: {
    checked: false,
    value: null,
  },
}
export default meta

type Story = StoryObj<typeof Checkbox>

export const Unchecked: Story = {}

export const Checked: Story = {
  args: {
    checked: true,
  },
}

export const WithValue: Story = {
  args: {
    checked: ['option1'],
    value: 'option1',
  },
}
