<script>
export default {
  name: 'BackgroundComponent'
}
</script>

<template>
  <div></div>
</template>

<style scoped>
div {
  position: absolute;
  top: 0;
  left: 0;
  z-index: -2;
  height: 100vh;
  width: 100%;
  background-color: rgb(20 20 20);
  background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(54, 77, 222, 0.5), rgba(255 255 255 / 0));
}
</style>
