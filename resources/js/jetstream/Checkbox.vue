<template>
  <input
    type="checkbox"
    :value="value"
    v-model="proxyChecked"
    class="rounded-xs border-gray-300 text-indigo-600 shadow-xs focus:border-indigo-300 focus:ring-3 focus:ring-black/50 focus:ring-indigo-200"
  />
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  emits: ['update:checked'],

  props: {
    checked: {
      type: [Array, Boolean],
      default: false,
    },
    value: {
      default: null,
    },
  },

  computed: {
    proxyChecked: {
      get() {
        return this.checked
      },

      set(val) {
        this.$emit('update:checked', val)
      },
    },
  },
})
</script>
