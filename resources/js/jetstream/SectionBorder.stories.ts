import SectionBorder from '@/jetstream/SectionBorder.vue'
import type { Meta, StoryObj } from '@storybook/vue3-vite'

const meta: Meta<typeof SectionBorder> = {
  title: 'Jetstream/SectionBorder',
  component: SectionBorder,
  tags: ['autodocs'],
  render: (args) => ({
    components: { SectionBorder },
    setup() {
      return { args }
    },
    template: `
      <div class="p-6 bg-gray-100">
        <div class="bg-white p-4 rounded-md">Section Content Above</div>
        <SectionBorder v-bind="args" />
        <div class="bg-white p-4 rounded-md">Section Content Below</div>
      </div>
    `,
  }),
  parameters: {
    docs: {
      description: {
        component: 'A simple horizontal border component used to separate sections in a form or page.',
      },
    },
  },
}
export default meta

type Story = StoryObj<typeof SectionBorder>

export const Default: Story = {}
