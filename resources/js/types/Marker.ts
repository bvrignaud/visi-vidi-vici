import MarkerType from '../Enums/MarkerType'

interface Marker {
  id: number
  coordinates: Array<number>
  options: object
  url: string
  type: MarkerType
}

export default Marker
