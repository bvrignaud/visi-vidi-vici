<script setup lang="ts">
import Button from '@/components/buttons/Button.vue'
import ConfirmationModal from '@/components/ui/modal/ConfirmationModal.vue'
import SecondaryButton from '@/jetstream/SecondaryButton.vue'
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
  <Story title="Ui/modal/ConfirmationModal">
    <Variant title="Default">
      <div class="p-6">
        <ConfirmationModal
          :show="state.show"
          :max-width="state.maxWidth"
          :closeable="state.closeable"
          @close="closeModal"
        >
          <template #title> Are you sure?</template>
          <template #content>
            This action cannot be undone. Are you sure you want to continue?
          </template>
          <template #footer>
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <Button class="ml-2">Confirm</Button>
          </template>
        </ConfirmationModal>
        <Button @click="openModal">Open Modal</Button>
      </div>
    </Variant>

    <Variant title="Not Closeable">
      <div class="p-6">
        <ConfirmationModal
          :show="state.show"
          :max-width="state.maxWidth"
          :closeable="false"
          @close="closeModal"
        >
          <template #title> Not Closeable Modal</template>
          <template #content>
            This modal cannot be closed by clicking outside or pressing Escape.
          </template>
          <template #footer>
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <Button class="ml-2">Confirm</Button>
          </template>
        </ConfirmationModal>
        <Button @click="openModal">Open Not Closeable Modal</Button>
      </div>
    </Variant>

    <Variant title="Small Width">
      <div class="p-6">
        <ConfirmationModal
          :show="state.show"
          max-width="sm"
          :closeable="state.closeable"
          @close="closeModal"
        >
          <template #title> Small Modal</template>
          <template #content> This is a small modal with a width of 'sm'.</template>
          <template #footer>
            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
            <Button class="ml-2">Confirm</Button>
          </template>
        </ConfirmationModal>
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
