import type { Meta, StoryObj } from '@storybook/vue3'
import Map from './Map.vue'
import MarkerType from '@/enums/MarkerType'

// More on how to set up stories at: https://storybook.js.org/docs/writing-stories
const meta: Meta<typeof Map> = {
  title: 'Components/Map',
  component: Map,
  // This component will have an automatically generated docsPage entry: https://storybook.js.org/docs/writing-docs/autodocs
  tags: ['autodocs'],
  argTypes: {
    linkOnMarker: {
      control: 'boolean',
      description: 'Enable navigation when clicking on markers',
      table: {
        type: { summary: 'boolean' },
        defaultValue: { summary: 'true' },
      },
    },
    markers: {
      control: 'object',
      description: 'Array of markers to display on the map',
      table: {
        type: { summary: 'array' },
        defaultValue: { summary: '[]' },
      },
    },
  },
  parameters: {
    // Disable the default padding to allow the map to fill the canvas
    layout: 'fullscreen',
  },
}

export default meta
type Story = StoryObj<typeof Map>

// Basic map with no markers
export const Empty: Story = {
  args: {
    markers: [],
  },
}

// Map with a single marker
export const SingleMarker: Story = {
  args: {
    markers: [
      {
        id: 1,
        coordinates: [46.47, -1.75],
        url: 'https://example.com',
        options: {},
      },
    ],
  },
}

// Map with multiple markers
export const MultipleMarkers: Story = {
  args: {
    markers: [
      {
        id: 1,
        coordinates: [46.47, -1.75],
        url: 'https://example.com/1',
        options: {},
      },
      {
        id: 2,
        type: MarkerType.Webcam,
        coordinates: [46.48, -1.76],
        url: 'https://example.com/2',
        options: {},
      },
      {
        id: 3,
        coordinates: [46.46, -1.74],
        url: 'https://example.com/3',
        options: {},
      },
    ],
  },
}

// Map with disabled links on markers
export const DisabledLinks: Story = {
  args: {
    linkOnMarker: false,
    markers: [
      {
        id: 1,
        coordinates: [46.47, -1.75],
        url: 'https://example.com',
        options: {},
      },
    ],
  },
}
