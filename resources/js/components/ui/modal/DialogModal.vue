<script setup lang="ts">
import Modal from './Modal.vue'

withDefaults(
  defineProps<{
    show?: boolean
    maxWidth?: string
    closeable?: boolean
  }>(),
  {
    show: false,
    maxWidth: '2xl',
    closeable: true,
  },
)

const emit = defineEmits<{
  (e: 'close'): void
}>()

const close = () => {
  emit('close')
}
</script>

<template>
  <Modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
    <div class="px-6 py-4">
      <div class="text-lg">
        <slot name="title" />
      </div>

      <div class="mt-4">
        <slot name="content" />
      </div>
    </div>

    <div class="bg-gray-100 px-6 py-4 text-right">
      <slot name="footer" />
    </div>
  </Modal>
</template>
