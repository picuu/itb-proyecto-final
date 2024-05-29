export function convertTimeToCoins(time) {
  const hours = parseInt(time.split(":")[0])
  const minutes = parseInt(time.split(":")[1])

  return (hours * 60) + minutes
}