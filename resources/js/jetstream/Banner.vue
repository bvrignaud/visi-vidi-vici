<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'

const page = usePage()
const show = ref(true)

const style = computed(() => {
  return page.props.jetstream.flash?.bannerStyle || 'success'
})

const message = computed(() => {
  return page.props.jetstream.flash?.banner || ''
})
</script>

<template>
  <div>
    <div
      :class="{ 'bg-indigo-500': style == 'success', 'bg-red-700': style == 'danger' }"
      v-if="show && message"
    >
      <div class="mx-auto max-w-(--breakpoint-xl) px-3 py-2 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between">
          <div class="flex w-0 min-w-0 flex-1 items-center">
            <span
              class="flex rounded-lg p-2"
              :class="{ 'bg-indigo-600': style == 'success', 'bg-red-600': style == 'danger' }"
            >
              <svg
                class="h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                v-if="style == 'success'"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>

              <svg
                class="h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                v-if="style == 'danger'"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                />
              </svg>
            </span>

            <p class="ml-3 truncate text-sm font-medium text-white">
              {{ message }}
            </p>
          </div>

          <div class="shrink-0 sm:ml-3">
            <button
              type="button"
              class="-mr-1 flex rounded-md p-2 transition focus:outline-hidden sm:-mr-2"
              :class="{
                'hover:bg-indigo-600 focus:bg-indigo-600': style == 'success',
                'hover:bg-red-600 focus:bg-red-600': style == 'danger',
              }"
              aria-label="Dismiss"
              @click.prevent="show = false"
            >
              <svg
                class="h-5 w-5 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
