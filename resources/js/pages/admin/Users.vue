<template>
  <app-layout title="Admin - Users">
    <template #header>
      <h2 class="text-xl leading-tight font-semibold text-gray-800">
        {{ $t('Admin') }} - {{ $t('Users') }}
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
          <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900">{{ $t('Users List') }}</h3>

            <div class="mt-4 overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                    >
                      {{ $t('Name') }}
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                    >
                      {{ $t('Email') }}
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                    >
                      {{ $t('Admin') }}
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase"
                    >
                      {{ $t('Created At') }}
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="user in users" :key="user.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="h-10 w-10 flex-shrink-0">
                          <img
                            class="h-10 w-10 rounded-full"
                            :src="user.profile_photo_url"
                            alt=""
                          />
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">{{ user.email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        v-if="user.is_admin"
                        class="inline-flex rounded-full bg-green-100 px-2 text-xs leading-5 font-semibold text-green-800"
                      >
                        {{ $t('Yes') }}
                      </span>
                      <span
                        v-else
                        class="inline-flex rounded-full bg-gray-100 px-2 text-xs leading-5 font-semibold text-gray-800"
                      >
                        {{ $t('No') }}
                      </span>
                    </td>
                    <td class="px-6 py-4 text-sm whitespace-nowrap text-gray-500">
                      {{ user.created_at ? new Date(user.created_at).toLocaleDateString() : null }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { User } from '@/types'

defineProps<{
  users: User[]
}>()
</script>
