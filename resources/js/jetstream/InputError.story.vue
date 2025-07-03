<script setup lang="ts">
import InputError from '@/jetstream/InputError.vue'
import '../../css/app.css'
</script>

<template>
  <Story title="Jetstream/InputError" :layout="{ type: 'grid', width: '300px' }">
    <Variant title="Default">
      <InputError message="This field is required." />
    </Variant>

    <Variant title="No Message">
      <InputError :message="null" />
    </Variant>
  </Story>
</template>
