import Button from '@/components/buttons/Button.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof Button> = {
  title: 'Components/Button',
  component: Button,
  tags: ['autodocs'],
  render: (args) => ({
    components: { Button },
    setup() {
      return { args }
    },
    template: '<Button v-bind="args">Button</Button>',
  }),
  argTypes: {
    type: {
      control: 'select',
      options: ['submit', 'button', 'reset'],
      // type: { name: 'string', required: false },
      table: {
        // type: { summary: 'string' },
        defaultValue: { summary: 'submit' },
      },
    },
  },
  args: {
    type: 'submit',
  },
}
export default meta

type Story = StoryObj<typeof Button>

export const Default: Story = {}
