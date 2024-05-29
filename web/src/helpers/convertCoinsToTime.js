export function convertCoinsToTime(coins) {
  const hours = parseInt(coins / 60)
  const minutes = coins % 60

  return `${hours}:${minutes}`
}