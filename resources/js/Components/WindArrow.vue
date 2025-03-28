<template>
  <span :title="`${Math.round(windSpeed * 1.9438)}nd - ${Math.round(direction)}°`">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      x="0px"
      y="0px"
      width="20px"
      height="20px"
      viewBox="0 0 493.356 493.356"
      class="inline-block"
      :style="style"
      xml:space="preserve"
    >
      <path
        d="M442.627,185.388L265.083,7.844C260.019,2.78,253.263,0,245.915,0c-7.204,0-13.956,2.78-19.02,7.844L49.347,185.388
              c-10.488,10.492-10.488,27.568,0,38.052l16.12,16.128c5.064,5.06,11.82,7.844,19.028,7.844c7.204,0,14.192-2.784,19.252-7.844
              l103.808-103.584v329.084c0,14.832,11.616,26.932,26.448,26.932h22.8c14.832,0,27.624-12.1,27.624-26.932V134.816l104.396,104.752
              c5.06,5.06,11.636,7.844,18.844,7.844s13.864-2.784,18.932-7.844l16.072-16.128C453.163,212.952,453.123,195.88,442.627,185.388z"
      />
    </svg>
  </span>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  direction: Number,
  windSpeed: Number,
})

const style = {
  transform: `rotate(${props.direction + 180}deg)`,
  fill: numberToColor(props.windSpeed * 1.9438, 0, 20),
}

function numberToColor(i, min, max) {
  let R = 0
  let G = 0
  const B = 0

  const percentage = (i * 100) / (max - min)

  if (percentage > 50) {
    R = (255 * percentage) / 100
  } else if (percentage < 50) {
    G = 255 - (255 * percentage) / 100
  }
  return `rgb(${R},${G},${B})`
}
</script>
