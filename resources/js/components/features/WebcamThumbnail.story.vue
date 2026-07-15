<script setup lang="ts">
import WebcamThumbnail from '@/components/features/WebcamThumbnail.vue'
import '../../../css/app.css'

const webcam = {
  id: 1,
  title: 'Démo',
  url: 'https://pv.viewsurf.com/842/Bretignolles-sur-Mer-La-Sauzaie?i=NDM5NDo',
  lat: 1,
  lng: 1,
}
</script>

<template>
  <Story title="Features/WebcamThumbnail">
    <Variant title="Basic">
      <WebcamThumbnail :webcam="webcam" />
    </Variant>
  </Story>
</template>
