export function formatTime(time) {
  let hour = time.split(":")[0]
  let minutes = time.split(":")[1]

  if (hour.length == 1) hour = '0' + hour
  if (minutes.length == 1) minutes = '0' + minutes

  return `${hour}:${minutes}`
}