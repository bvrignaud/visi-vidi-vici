import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { i18nVue } from 'laravel-vue-i18n'
import type { DefineComponent } from 'vue'
import { createApp, h } from 'vue'
import { ZiggyVue } from 'ziggy-js'
import { initMatomo, trackPageView } from './matomo'

const appName = import.meta.env.VITE_APP_NAME || 'Visi vidi vici'

createInertiaApp({
  title: (title) => `${title} 🐟 ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./pages/**/*.vue'),
    ),
  setup({ el, App, props, plugin }) {
    // Initialize Matomo
    initMatomo()

    const app = createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(i18nVue, {
        resolve: async (lang: string) => {
          const langs = import.meta.glob('../../lang/*.json')
          return await langs[`../../lang/${lang}.json`]()
        },
      })
      .use(ZiggyVue)

    app.mount(el)

    // Set up Inertia page change tracking for Matomo
    import('@inertiajs/vue3').then(({ router }) => {
      router.on('navigate', (event) => {
        trackPageView(event.detail.page.url)
      })
    })
  },
  progress: {
    color: '#4B5563',
  },
})
