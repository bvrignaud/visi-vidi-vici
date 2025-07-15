import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { i18nVue } from 'laravel-vue-i18n'
import type { DefineComponent } from 'vue'
import { createApp, h } from 'vue'
import { ZiggyVue } from 'ziggy-js'

const appName = import.meta.env.VITE_APP_NAME || 'Visi vidi vici'

createInertiaApp({
  title: (title) => `${title} 🐟 ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./pages/${name}.vue`,
      import.meta.glob<DefineComponent>('./pages/**/*.vue'),
    ),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(i18nVue, {
        resolve: async (lang: string) => {
          const langs = import.meta.glob('../../lang/*.json')
          return await langs[`../../lang/${lang}.json`]()
        },
      })
      .use(ZiggyVue)
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
