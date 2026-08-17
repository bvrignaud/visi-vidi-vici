import type { Forecast } from '@/types/Forecast'
import type { Spot } from '@/types/Spot'
import type { SunInfo } from '@/types/SunInfo'
import type { Tide } from '@/types/Tide'
import { useHttp } from '@inertiajs/vue3'

interface SpotForecast {
  spot: Spot
  forecasts: Array<Forecast>
  tides: Array<Tide>
  sun_infos: Record<string, SunInfo>
}

export const useSpot = () => {
  const http = useHttp()

  async function fetchSpotForecast(routeKey: string, start: Date | null = null) {
    const response = await http.get(`/api/spots/${routeKey}/forecast`, {
      headers: { params: { query: { start } } },
    })

    return response as SpotForecast
  }

  return {
    fetchSpotForecast,
  }
}
