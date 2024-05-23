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
  height: 100%;
  width: 100%;
  background-color: rgb(10 10 10);
  background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(72, 89, 196, 0.3), rgba(255 255 255 / 0));
}
</style>
