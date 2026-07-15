import MarkerType from '@/enums/MarkerType'
import { PointTuple } from 'leaflet'

interface Marker {
  id: number
  coordinates: PointTuple
  options: object
  url: string
  type: MarkerType
}

export default Marker
