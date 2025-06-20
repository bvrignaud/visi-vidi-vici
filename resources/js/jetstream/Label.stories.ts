import type { Meta, StoryObj } from '@storybook/vue3-vite'
import Label from './Label.vue'

const meta: Meta<typeof Label> = {
  title: 'Jetstream/Label',
  component: Label,
  tags: ['autodocs'],
  render: (args) => ({
    components: { Label },
    setup() {
      return { args }
    },
    template: '<Label v-bind="args">Default Slot Content</Label>',
  }),
  argTypes: {
    value: {
      control: 'text',
      description: 'The text to display in the label',
      table: {
        type: { summary: 'string' },
        defaultValue: { summary: 'undefined' },
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof Label>

// Example with value prop
export const WithValue: Story = {
  args: {
    value: 'Label Text via Value Prop',
  },
}

// Example with slot content
export const WithSlot: Story = {
  args: {
    value: undefined,
  },
}
