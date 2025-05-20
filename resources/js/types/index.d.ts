import type { PageProps } from '@inertiajs/core'
import type { Config } from 'ziggy-js'

export interface Auth {
  user: User
}

export interface SharedData extends PageProps {
  name: string
  quote: { message: string; author: string }
  auth: Auth
  ziggy: Config & { location: string }
  sidebarOpen: boolean
}

export interface User {
  id: number
  name: string
  email: string
  email_verified_at?: string
  is_admin?: boolean
  profile_photo_url?: string
  created_at?: string
  updated_at?: string
}

export interface PaginatedResponse<T> {
  data: T[]
  meta: {
    current_page: number
    from: number
    last_page: number
    links: {
      url: string | null
      label: string
      active: boolean
    }[]
    path: string
    per_page: number
    to: number
    total: number
  }
  links: {
    first: string | null
    last: string | null
    prev: string | null
    next: string | null
  }
}

export interface Response<T> {
  data: T[]
}
