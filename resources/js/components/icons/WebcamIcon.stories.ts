import type { Meta, StoryObj } from '@storybook/vue3-vite'
import WebcamIcon from './WebcamIcon.vue'

const meta: Meta<typeof WebcamIcon> = {
  title: 'Components/Icons/WebcamIcon',
  component: WebcamIcon,
  tags: ['autodocs'],
  parameters: {
    // Optional parameter to center the component in the Canvas
    layout: 'centered',
  },
  // More on argTypes: https://storybook.js.org/docs/api/argtypes
  argTypes: {
    // The component doesn't have any props
  },
}

export default meta
type Story = StoryObj<typeof WebcamIcon>

// Basic example
export const Default: Story = {
  args: {},
}

// Example with different color
export const CustomColor: Story = {
  args: {},
  render: () => ({
    components: { WebcamIcon },
    template: '<div style="color: #3498db;"><WebcamIcon /></div>',
  }),
}

// Example with different size
export const CustomSize: Story = {
  args: {},
  render: () => ({
    components: { WebcamIcon },
    template: '<div style="width: 48px; height: 48px;"><WebcamIcon /></div>',
  }),
}
