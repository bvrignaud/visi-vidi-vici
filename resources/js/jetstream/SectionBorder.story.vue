<script setup lang="ts">
import SectionBorder from '@/jetstream/SectionBorder.vue'
import '../../css/app.css'
</script>

<template>
  <Story title="Jetstream/SectionBorder" :layout="{ type: 'grid', width: '300px' }">
    <Variant title="Default">
      <div class="bg-gray-500">
        <div class="bg-gray-100 p-6">
          <div class="rounded-md bg-white">Section Content Above</div>
          <SectionBorder />
          <div class="rounded-md bg-white">Section Content Below</div>
        </div>
      </div>
    </Variant>
  </Story>
</template>
