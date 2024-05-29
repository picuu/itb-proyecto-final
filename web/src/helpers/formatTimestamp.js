import { formatTime } from "./formatTime"

export function formatTimestamp(timestamp) {
  if (!timestamp || isNaN(timestamp)) return ''

  const date = new Date(parseInt(timestamp))

  const day = date.getDate()
  const month = date.getMonth() + 1
  const year = date.getFullYear()
  const time = formatTime(`${date.getHours()}:${date.getMinutes()}`)

  return `${day}/${month}/${year} at ${time}`
}