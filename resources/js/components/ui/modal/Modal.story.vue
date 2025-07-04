<script setup lang="ts">
import Modal from '@/components/ui/modal/Modal.vue'
import { reactive } from 'vue'
import '../../../../css/app.css'

const state = reactive({
  show: true,
  maxWidth: '2xl',
  closeable: true,
})

function close() {
  state.show = false
  setTimeout(() => {
    state.show = true
  }, 1000)
}
</script>

<template>
  <Story title="Ui/modal/Modal">
    <Variant title="Default">
      <div class="p-4">
        <Modal
          :show="state.show"
          :max-width="state.maxWidth"
          :closeable="state.closeable"
          @close="close"
        >
          <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Default Modal</h2>
            <p class="mt-3 text-sm text-gray-600">
              This is the default modal configuration with standard width and closeable behavior.
            </p>
            <div class="mt-4 flex justify-end">
              <button
                type="button"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase shadow-sm transition hover:bg-gray-50 focus:outline-none"
                @click="close"
              >
                Close
              </button>
            </div>
          </div>
        </Modal>
      </div>
    </Variant>

    <Variant title="Small Width">
      <div class="p-4">
        <Modal :show="state.show" max-width="sm" :closeable="state.closeable" @close="close">
          <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Small Modal</h2>
            <p class="mt-3 text-sm text-gray-600">This modal uses the small width configuration.</p>
            <div class="mt-4 flex justify-end">
              <button
                type="button"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase shadow-sm transition hover:bg-gray-50 focus:outline-none"
                @click="close"
              >
                Close
              </button>
            </div>
          </div>
        </Modal>
      </div>
    </Variant>

    <Variant title="Not Closeable">
      <div class="p-4">
        <Modal :show="state.show" :max-width="state.maxWidth" :closeable="false" @close="close">
          <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">Non-Closeable Modal</h2>
            <p class="mt-3 text-sm text-gray-600">
              This modal cannot be closed by clicking outside or pressing Escape. You must use the
              close button.
            </p>
            <div class="mt-4 flex justify-end">
              <button
                type="button"
                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase shadow-sm transition hover:bg-gray-50 focus:outline-none"
                @click="close"
              >
                Close
              </button>
            </div>
          </div>
        </Modal>
      </div>
    </Variant>

    <template #controls>
      <HstCheckbox title="Show" v-model="state.show" />
      <HstSelect
        title="Max Width"
        v-model="state.maxWidth"
        :options="['sm', 'md', 'lg', 'xl', '2xl']"
      />
      <HstCheckbox title="Closeable" v-model="state.closeable" />
    </template>
  </Story>
</template>
