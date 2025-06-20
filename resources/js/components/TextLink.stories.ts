import type { Meta, StoryObj } from '@storybook/vue3-vite'
import TextLink from './TextLink.vue'

const meta: Meta<typeof TextLink> = {
  title: 'Components/TextLink',
  component: TextLink,
  tags: ['autodocs'],
  render: (args) => ({
    components: { TextLink },
    template: `
      <text-link v-bind="args">Text link</text-link>`,
  }),
}

export default meta
type Story = StoryObj<typeof TextLink>
export const Basic: Story = {
  args: {
    href: '/link',
  },
}
