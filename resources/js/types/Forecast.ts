export interface Forecast {
  time: string
  note: number
  airTemperature: number
  cloudCover: number
  swellHeight: number
  swellPeriod: number
  waterTemperature: number
  windDirection: number
  windSpeed: number
}

export interface ForecastAvg extends Omit<Forecast, 'time'> {}
