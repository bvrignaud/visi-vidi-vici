import { ApiResponse } from '@/types'
import Webcam from '@/types/Webcam'

const getAll = async (params: any = {}) => {
  return fetch(`/api/webcams?` + new URLSearchParams(params).toString())
    .then((response) => response.json())
    .then((data: ApiResponse<Webcam>) => {
      return data.data
    })
}

export const webcamsService = {
  getAll,
}
