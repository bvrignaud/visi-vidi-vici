import type { Meta, StoryObj } from '@storybook/vue3'

import TextArea from './TextArea.vue'

// More on how to set up stories at: https://storybook.js.org/docs/writing-stories
const meta: Meta<typeof TextArea> = {
  title: 'Components/TextArea',
  component: TextArea,
  // This component will have an automatically generated docsPage entry: https://storybook.js.org/docs/writing-docs/autodocs
  tags: ['autodocs'],
}
export default meta

type Story = StoryObj<typeof TextArea>

export const Basic: Story = {}
