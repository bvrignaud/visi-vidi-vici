import WebcamThumbnail from '@/components/WebcamThumbnail.vue'
import type { Meta, StoryObj } from '@storybook/vue3'

// More on how to set up stories at: https://storybook.js.org/docs/writing-stories
const meta: Meta<typeof WebcamThumbnail> = {
  title: 'Components/WebcamThumbnail',
  component: WebcamThumbnail,
  // This component will have an automatically generated docsPage entry: https://storybook.js.org/docs/writing-docs/autodocs
  tags: ['autodocs'],
  render: (args) => ({
    components: { WebcamThumbnail },
    setup() {
      return { args }
    },
    template: `
      <webcam-thumbnail
        :webcam="{id: 1, title: 'Démo', url: 'https://pv.viewsurf.com/842/Bretignolles-sur-Mer-La-Sauzaie?i=NDM5NDo', lat: 1, lng: 1}" />`,
  }),
  argTypes: {
    // webcam: {
    //   // control: 'object'
    //   // type: { required: true },
    // },
  },
}
export default meta

type Story = StoryObj<typeof WebcamThumbnail>

export const Basic: Story = {}
