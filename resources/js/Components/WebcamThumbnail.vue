<template>
  <iframe
    width="560"
    height="315"
    :src="src"
    title="YouTube video player"
    frameborder="0"
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

</style>
