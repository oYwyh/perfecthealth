<template>
  <main id="swup" class="transition-fade">
    <h1>Welcome</h1>
    <p>Lorem ipsum dolor sit amet.</p>
  </main>
</template>

<script>
import Swup from 'swup';

export default {
  mounted() {
    const swup = new Swup();
  }
}
</script>

<style>
main {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-color: red;
}

html.is-changing.transition-fade {
  transition: opacity 0.25s;
  opacity: 1;
}

html.is-animating.transition-fade {
  opacity: 0;
}
</style>
