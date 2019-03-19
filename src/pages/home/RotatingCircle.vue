<template>
  <div id="rotating-circle">
    <div class="loader">
      <div class="face">
        <div class="circle"></div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'rotating-circle',
    data() {
      return {
      }
    }
  }

</script>

<style scoped>
  .loader {
    width: 10em;
    height: 10em;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
  }

  .loader .face {
    position: absolute;
    border-radius: 50%;
    border-style: solid;
    animation: animate 10s linear infinite;
  }

  .loader .face:nth-child(1) {
    width: 100%;
    height: 100%;
    color: white;
    border-color: currentColor transparent transparent currentColor;
    border-width: 0.2em 0.2em 0 0;
    animation-direction: normal;
  }


  .loader .face .circle {
    position: absolute;
    width: 50%;
    height: 0.1em;
    top: 50%;
    left: 50%;
    background-color: transparent;
    transform: rotate(var(--deg));
    transform-origin: left;
  }

  .loader .face .circle::before {
    position: absolute;
    top: 0em;
    right: -0.4em;
    content: '';
    width: 0.5em;
    height: 0.5em;
    background-color: currentColor;
    border-radius: 50%;
    box-shadow: 0 0 1em,
      0 0 2em,
      0 0 3em,
      0 0 4em,
      0 0 5em,
      0 0 0 0.5em rgba(255, 255, 0, 0.1);
  }

  @keyframes animate {
    to {
      transform: rotate(1turn);
    }
  }

</style>
