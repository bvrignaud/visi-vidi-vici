<template>
  <iframe
    :src="src"
    title="YouTube video player"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
    allowfullscreen
  />
</template>

<script setup lang="ts">
import {computed} from "vue";
import Webcam from "../Types/Webcam";

const props = defineProps<{
  webcam: Webcam,
}>();

const src = computed<string>(() => {
  const url = new URL(props.webcam.url);
  if (url.hostname === 'youtu.be') {
    return `https://www.youtube.com/embed/${url.pathname}`;
  }
  return props.webcam.url;
});
</script>

<style scoped>
iframe {
  width: 100vw;
  height: calc(100vw * 315/560);
  max-width: 560px;
  max-height: 315px;
}
</style>
