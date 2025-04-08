import type { Forecast } from '@/types/Forecast'
import type { Spot } from '@/types/Spot'
import type { SunInfo } from '@/types/SunInfo'
import type { Tide } from '@/types/Tide'

interface SpotForecast {
  spot: Spot
  forecasts: Array<Forecast>
  tides: Array<Tide>
  sun_infos: Record<string, SunInfo>
}

export const useSpot = () => {
  async function fetchSpotForecast(id: string): Promise<SpotForecast> {
    const response = await fetch(`/api/spots/${id}/forecast`)

    return response.json()
  }

  return {
    fetchSpotForecast,
  }
}
