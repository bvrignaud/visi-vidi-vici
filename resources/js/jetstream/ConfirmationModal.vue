<template>
  <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
      <div class="sm:flex sm:items-start">
        <div
          class="mx-auto flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
        >
          <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
            />
          </svg>
        </div>

        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
          <h3 class="text-lg">
            <slot name="title"></slot>
          </h3>

          <div class="mt-2">
            <slot name="content"></slot>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-gray-100 px-6 py-4 text-right">
      <slot name="footer"> </slot>
    </div>
  </modal>
</template>

<script>
import { defineComponent } from 'vue'
import Modal from './Modal.vue'

export default defineComponent({
  emits: ['close'],

  components: {
    Modal,
  },

  props: {
    show: {
      default: false,
    },
    maxWidth: {
      default: '2xl',
    },
    closeable: {
      default: true,
    },
  },

  methods: {
    close() {
      this.$emit('close')
    },
  },
})
</script>
