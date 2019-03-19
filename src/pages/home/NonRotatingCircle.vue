<template>
  <div id="non-rotating-circle">
    <div class="loader">
      <div class="face">
       
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'non-rotating-circle',
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
    border-radius: 100%;
    border-style: solid;
    height: 10px;

  }

  .loader .face:nth-child(1) {
    width: 100%;
    height: 100%;
    color: rgb(255, 255, 255);
    border: 5px solid red;
    border-color: currentColor;
    border-width: 0.2em;

  }


</style>
