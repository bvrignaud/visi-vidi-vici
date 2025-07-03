<script setup lang="ts">
import Label from '@/jetstream/Label.vue'
import '../../css/app.css'
</script>

<template>
  <Story title="Jetstream/Label" :layout="{ type: 'grid', width: '300px' }">
    <Variant title="With Value Prop">
      <Label value="Email" />
    </Variant>

    <Variant title="With Slot Content">
      <Label>Password</Label>
    </Variant>
  </Story>
</template>
