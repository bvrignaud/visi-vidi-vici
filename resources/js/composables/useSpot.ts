import type { Forecast } from '@/types/Forecast'
import type { Spot } from '@/types/Spot'
import type { SunInfo } from '@/types/SunInfo'
import type { Tide } from '@/types/Tide'
import axios from 'axios'

interface SpotForecast {
  spot: Spot
  forecasts: Array<Forecast>
  tides: Array<Tide>
  sun_infos: Record<string, SunInfo>
}

export const useSpot = () => {
  async function fetchSpotForecast(id: string, start: Date | null = null): Promise<SpotForecast> {
    const response = await axios.get(`/api/spots/${id}/forecast`, {
      params: {
        start,
      },
      responseType: 'json',
    })

    return response.data
  }

  return {
    fetchSpotForecast,
  }
}
