<script setup lang="ts">
import { ref, computed } from 'vue'

import JetApplicationMark from '@/jetstream/ApplicationMark.vue'
import JetBanner from '@/jetstream/Banner.vue'
import JetDropdown from '@/jetstream/Dropdown.vue'
import JetDropdownLink from '@/jetstream/DropdownLink.vue'
import JetNavLink from '@/jetstream/NavLink.vue'
import JetResponsiveNavLink from '@/jetstream/ResponsiveNavLink.vue'
import Footer from '@/layouts/partials/Footer.vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3'
import { trans } from 'laravel-vue-i18n'

defineProps({
  title: String,
})

const page = usePage()
const showingNavigationDropdown = ref(false)

const switchToTeam = (team) => {
  router.put(
    route('current-team.update'),
    {
      team_id: team.id,
    },
    {
      preserveState: false,
    },
  )
}

const logout = () => {
  router.post(route('logout'))
}

const baseNavLinks = [
  {
    label: trans('Home'),
    route: 'home',
  },
  {
    label: trans('Webcams'),
    route: 'webcams.index',
  },
  {
    label: 'Contact',
    route: 'contact',
  },
]

const navLinks = computed(() => {
  const links = [...baseNavLinks]

  // Add admin link if user is admin
  if (page.props.auth.user?.is_admin) {
    links.push({
      label: trans('Admin'),
      route: 'admin.users',
    })
  }

  return links
})
</script>

<template>
  <div>
    <Head :title="title" />

    <jet-banner />

    <div class="min-h-screen bg-gray-100">
      <nav class="border-b border-gray-100 bg-white">
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 justify-between">
            <div class="flex">
              <!-- Logo -->
              <div class="flex shrink-0 items-center">
                <Link href="/">
                  <jet-application-mark class="block h-9 w-auto" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <!--                                <jet-nav-link v-if="$page.props.auth.user" :href="route('dashboard')" :active="route().current('dashboard')">-->
                <!--                                    Dashboard-->
                <!--                                </jet-nav-link>-->
                <jet-nav-link
                  v-for="(navLink, key) in navLinks"
                  :key="key"
                  :href="route(navLink.route)"
                  :active="route().current(navLink.route)"
                >
                  {{ navLink.label }}
                </jet-nav-link>
                <template v-if="!$page.props.auth.user">
                  <jet-nav-link :href="route('login')" :active="route().current('login')">
                    {{ $t('Log in') }}
                  </jet-nav-link>
                  <jet-nav-link :href="route('register')" :active="route().current('register')">
                    {{ $t('Register') }}
                  </jet-nav-link>
                </template>
              </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">
              <div class="relative ml-3">
                <!-- Teams Dropdown -->
                <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm leading-4 font-medium text-gray-500 transition hover:bg-gray-50 hover:text-gray-700 focus:bg-gray-50 focus:outline-hidden active:bg-gray-50"
                      >
                        {{ $page.props.auth.user.current_team.name }}

                        <svg
                          class="-mr-0.5 ml-2 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <div class="w-60">
                      <!-- Team Management -->
                      <template v-if="$page.props.jetstream.hasTeamFeatures">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                          {{ $t('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <jet-dropdown-link
                          :href="route('teams.show', $page.props.auth.user.current_team)"
                        >
                          {{ $t('Team Settings') }}
                        </jet-dropdown-link>

                        <jet-dropdown-link
                          :href="route('teams.create')"
                          v-if="$page.props.jetstream.canCreateTeams"
                        >
                          {{ $t('Create New Team') }}
                        </jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                          {{ $t('Switch Teams') }}
                        </div>

                        <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                          <form @submit.prevent="switchToTeam(team)">
                            <JetDropdownLink as="button">
                              <div class="flex items-center">
                                <svg
                                  v-if="team.id == $page.props.auth.user.current_team_id"
                                  class="me-2 h-5 w-5 text-green-400"
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke-width="1.5"
                                  stroke="currentColor"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                  />
                                </svg>

                                <div>{{ team.name }}</div>
                              </div>
                            </JetDropdownLink>
                          </form>
                        </template>
                      </template>
                    </div>
                  </template>
                </jet-dropdown>
              </div>

              <!-- Settings Dropdown -->
              <div class="relative ml-3" v-if="$page.props.auth.user">
                <jet-dropdown align="right" width="48">
                  <template #trigger>
                    <button
                      v-if="$page.props.jetstream.managesProfilePhotos"
                      class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-hidden"
                    >
                      <img
                        class="h-8 w-8 rounded-full object-cover"
                        :src="$page.props.auth.user.profile_photo_url"
                        :alt="$page.props.auth.user.name"
                      />
                    </button>

                    <span v-else class="inline-flex rounded-md">
                      <button
                        type="button"
                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm leading-4 font-medium text-gray-500 transition hover:text-gray-700 focus:outline-hidden"
                      >
                        {{ $page.props.auth.user.name }}

                        <svg
                          class="-mr-0.5 ml-2 h-4 w-4"
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ $t('Manage Account') }}
                    </div>

                    <jet-dropdown-link :href="route('profile.show')"> Profil</jet-dropdown-link>

                    <jet-dropdown-link
                      :href="route('api-tokens.index')"
                      v-if="$page.props.jetstream.hasApiFeatures"
                    >
                      API Tokens
                    </jet-dropdown-link>

                    <div class="border-t border-gray-100"></div>

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <jet-dropdown-link as="button">
                        {{ $t('Log Out') }}
                      </jet-dropdown-link>
                    </form>
                  </template>
                </jet-dropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-hidden"
              >
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
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

        <!-- Responsive Navigation Menu -->
        <div
          :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
          class="sm:hidden"
        >
          <div class="space-y-1 pt-2 pb-3">
            <!--                        <jet-responsive-nav-link v-if="$page.props.auth.user" :href="route('dashboard')" :active="route().current('dashboard')">-->
            <!--                            Dashboard-->
            <!--                        </jet-responsive-nav-link>-->
            <jet-responsive-nav-link
              v-for="(navLink, key) in navLinks"
              :key="key"
              :href="route(navLink.route)"
              :active="route().current(navLink.route)"
            >
              {{ navLink.label }}
            </jet-responsive-nav-link>
            <template v-if="!$page.props.auth.user">
              <jet-responsive-nav-link :href="route('login')" :active="route().current('login')">
                {{ $t('Log in') }}
              </jet-responsive-nav-link>
              <jet-responsive-nav-link
                :href="route('register')"
                :active="route().current('register')"
              >
                {{ $t('Register') }}
              </jet-responsive-nav-link>
            </template>
          </div>

          <!-- Responsive Settings Options -->
          <div v-if="$page.props.auth.user" class="border-t border-gray-200 pt-4 pb-1">
            <div class="flex items-center px-4">
              <div v-if="$page.props.jetstream.managesProfilePhotos" class="mr-3 shrink-0">
                <img
                  class="h-10 w-10 rounded-full object-cover"
                  :src="$page.props.auth.user.profile_photo_url"
                  :alt="$page.props.auth.user.name"
                />
              </div>

              <div>
                <div class="text-base font-medium text-gray-800">
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="text-sm font-medium text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>
            </div>

            <div v-if="$page.props.auth.user" class="mt-3 space-y-1">
              <jet-responsive-nav-link
                :href="route('profile.show')"
                :active="route().current('profile.show')"
              >
                Profil
              </jet-responsive-nav-link>

              <jet-responsive-nav-link
                :href="route('api-tokens.index')"
                :active="route().current('api-tokens.index')"
                v-if="$page.props.jetstream.hasApiFeatures"
              >
                API Tokens
              </jet-responsive-nav-link>

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <jet-responsive-nav-link as="button">
                  {{ $t('Log Out') }}
                </jet-responsive-nav-link>
              </form>

              <!-- Team Management -->
              <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                  {{ $t('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <jet-responsive-nav-link
                  :href="route('teams.show', $page.props.auth.user.current_team)"
                  :active="route().current('teams.show')"
                >
                  {{ $t('Team Settings') }}
                </jet-responsive-nav-link>

                <jet-responsive-nav-link
                  :href="route('teams.create')"
                  :active="route().current('teams.create')"
                  v-if="$page.props.jetstream.canCreateTeams"
                >
                  {{ $t('Create New Team') }}
                </jet-responsive-nav-link>

                <div class="border-t border-gray-200"></div>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                  {{ $t('Switch Teams') }}
                </div>

                <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                  <form @submit.prevent="switchToTeam(team)">
                    <jet-responsive-nav-link as="button">
                      <div class="flex items-center">
                        <svg
                          v-if="team.id == $page.props.auth.user.current_team_id"
                          class="mr-2 h-5 w-5 text-green-400"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>{{ team.name }}</div>
                      </div>
                    </jet-responsive-nav-link>
                  </form>
                </template>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header class="bg-white shadow-xs" v-if="$slots.header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot></slot>
      </main>

      <Footer />
    </div>
  </div>
</template>
