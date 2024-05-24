<script>
export default {
  name: "LogoutProc",
  created() {
    localStorage.removeItem("authInfo")
    this.$router.push('/')
  }
}
</script>
