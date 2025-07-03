<script setup lang="ts">
import { reactive } from 'vue'
import '../../css/app.css'
import TextArea from './TextArea.vue'

const state = reactive({
  // Add reactive state if needed
})
</script>

<template>
  <Story title="TextArea">
    <Variant title="Basic">
      <TextArea />
    </Variant>
  </Story>
</template>
