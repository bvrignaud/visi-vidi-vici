<template>
  <div>
    <button
      type="submit"
      class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 transition hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden"
      v-if="as == 'button'"
    >
      <slot></slot>
    </button>

    <a
      :href="href"
      class="block px-4 py-2 text-sm leading-5 text-gray-700 transition hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden"
      v-else-if="as == 'a'"
    >
      <slot></slot>
    </a>

    <Link
      :href="href"
      class="block px-4 py-2 text-sm leading-5 text-gray-700 transition hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden"
      v-else
    >
      <slot></slot>
    </Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import { defineComponent } from 'vue'

export default defineComponent({
  components: {
    Link,
  },
  props: ['href', 'as'],
})
</script>
