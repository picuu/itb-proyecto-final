export function validateSession() {
  if (localStorage.getItem("authInfo")) return true
  return false
}