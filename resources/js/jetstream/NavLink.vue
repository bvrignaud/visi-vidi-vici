<template>
  <Link :href="href" class="no-underline" :class="classes">
    <slot />
  </Link>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    Link,
  },
  props: ['href', 'active'],

  computed: {
    classes() {
      return this.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-hidden focus:border-indigo-700 transition'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-hidden focus:text-gray-700 focus:border-gray-300 transition'
    },
  },
})
</script>
