<template>
  <div id="timing-module">
    <div class="wrapper">
      <div class="circle-wrapper">
        <non-rotating-circle class="circle"></non-rotating-circle>
      </div>
      <div class="center-wrapper">
        <div class="center">
          <span v-on:click="onStart" class="fa fa-play"></span>
          <div class="task"> 开始任务</div>
        </div>

      </div>
    </div>
  </div>
</template>
<script>
  import RotatingCircle from '@/pages/home/RotatingCircle'
  import NonRotatingCircle from '@/pages/home/NonRotatingCircle'
  export default {
    name: 'timing-module',
    components: {
      RotatingCircle,
      NonRotatingCircle
    },
    data() {
      return {
        isTiming: false
      }
    },
    mounted() {
      window.vue = this
    },
    methods: {
      onStart: function () {
        this.isTiming = !this.isTiming;

      }
    }
  }

</script>

<style scoped>
  .timing-module-container {
    background: #000;
    height: 400px;
    width: 100%;
  }

  .wrapper {
    width: 100%;
    height: 100%;
  }

  .center-wrapper {
    position: absolute;
    font-size: 0;
    top: 0;
    width: 100%;
    height: 100%;
  }
  .center {
    margin: 0 auto;
  }

  .center .fa {
    font-size: 40px;
  }

  .task {
    font-size: 20px;
    vertical-align: top;
    width: 0;
  }

</style>
