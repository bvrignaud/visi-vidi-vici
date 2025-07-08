<script setup lang="ts">
import { Button, SecondaryButton } from '@/components/ui/buttons'
import DialogModal from '@/components/ui/modal/DialogModal.vue'
import { reactive } from 'vue'
import '../../../../css/app.css'

const state = reactive({
  show: false,
  maxWidth: '2xl',
  closeable: true,
})

function closeModal() {
  state.show = false
}

function openModal() {
  state.show = true
}
</script>

<template>
  <Story title="Ui/Modals/DialogModal">
    <Variant title="Default">
      <div class="p-6">
        <DialogModal
          :show="state.show"
          :max-width="state.maxWidth"
          :closeable="state.closeable"
          @close="closeModal"
        >
          <template #title> Dialog Title</template>
          <template #content>
            <p>
              This is the content of the dialog modal. You can put any content here, including
              forms, text, or other components.
            </p>
            <p class="mt-4">Dialog modals are used for a variety of purposes in the application.</p>
          </template>
          <template #footer>
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <Button class="ml-2">Save</Button>
          </template>
        </DialogModal>
        <Button @click="openModal">Open Modal</Button>
      </div>
    </Variant>

    <Variant title="Not Closeable">
      <div class="p-6">
        <DialogModal
          :show="state.show"
          :max-width="state.maxWidth"
          :closeable="false"
          @close="closeModal"
        >
          <template #title> Not Closeable Dialog</template>
          <template #content>
            <p>This dialog cannot be closed by clicking outside or pressing Escape.</p>
            <p class="mt-4">You must use one of the buttons in the footer to close it.</p>
          </template>
          <template #footer>
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <Button class="ml-2">Save</Button>
          </template>
        </DialogModal>
        <Button @click="openModal">Open Not Closeable Modal</Button>
      </div>
    </Variant>

    <Variant title="Small Width">
      <div class="p-6">
        <DialogModal
          :show="state.show"
          max-width="sm"
          :closeable="state.closeable"
          @close="closeModal"
        >
          <template #title> Small Dialog</template>
          <template #content>
            <p>This is a small dialog with a width of 'sm'.</p>
          </template>
          <template #footer>
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <Button class="ml-2">Save</Button>
          </template>
        </DialogModal>
        <Button @click="openModal">Open Small Modal</Button>
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
