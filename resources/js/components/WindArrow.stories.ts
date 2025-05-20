import type { Meta, StoryObj } from '@storybook/vue3'
import WindArrow from './WindArrow.vue'

const meta: Meta<typeof WindArrow> = {
  title: 'Components/WindArrow',
  component: WindArrow,
  tags: ['autodocs'],
  parameters: {
    layout: 'centered',
  },
  argTypes: {
    direction: {
      control: { type: 'range', min: 0, max: 359, step: 1 },
      description: 'Wind direction in degrees (0-359)',
      table: {
        type: { summary: 'number' },
        defaultValue: { summary: 'undefined' },
      },
    },
    windSpeed: {
      control: { type: 'range', min: 0, max: 20, step: 0.1 },
      description: 'Wind speed in m/s (converted to knots in the component)',
      table: {
        type: { summary: 'number' },
        defaultValue: { summary: 'undefined' },
      },
    },
  },
}

export default meta
type Story = StoryObj<typeof WindArrow>

// Light wind from the north
export const LightNorth: Story = {
  args: {
    direction: 0,
    windSpeed: 2,
  },
}

// Moderate wind from the east
export const ModerateEast: Story = {
  args: {
    direction: 90,
    windSpeed: 5,
  },
}

// Strong wind from the south
export const StrongSouth: Story = {
  args: {
    direction: 180,
    windSpeed: 10,
  },
}

// Very strong wind from the west
export const VeryStrongWest: Story = {
  args: {
    direction: 270,
    windSpeed: 15,
  },
}

// Multiple arrows with different directions and speeds
export const MultipleArrows: Story = {
  render: () => ({
    components: { WindArrow },
    template: `
      <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <div>
          <p>North - Light</p>
          <WindArrow :direction="0" :windSpeed="2" />
        </div>
        <div>
          <p>East - Moderate</p>
          <WindArrow :direction="90" :windSpeed="5" />
        </div>
        <div>
          <p>South - Strong</p>
          <WindArrow :direction="180" :windSpeed="10" />
        </div>
        <div>
          <p>West - Very Strong</p>
          <WindArrow :direction="270" :windSpeed="15" />
        </div>
      </div>
    `,
  }),
}
