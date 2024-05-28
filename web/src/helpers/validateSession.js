export function validateSession() {
  if (localStorage.getItem("authInfo")) return JSON.parse(localStorage.getItem("authInfo"))
  return false
}