<template>
  <div id="timing-panel">
    <div class="timing-panel-body">
      <swiper>
        <swiper-slide class="module" id="module1">
          <timing-module></timing-module>
        </swiper-slide>
        <swiper-slide class="module" id="module2">2</swiper-slide>
        <swiper-slide class="module" id="module3">3</swiper-slide>
      </swiper>
    </div>
  </div>
</template>
<script>
  import TimingModule from '@/pages/home/TimingModule'
  import {
    swiper,
    swiperSlide
  } from "vue-awesome-swiper";
  export default {
    name: "timing-panel",
    components: {
      swiper,
      swiperSlide,
      TimingModule
    },
    data() {
      return {
        msg: "Welcome to Your Vue.js App"
      };
    },
    methods: {}
  };

</script>

<style scoped>
  .timing-panel-body {
    background: #343434;
    height: 400px;
    color: #ddd;
  }

  .timing-panel-body {
    position: relative;
  }

  .module-container {
    /* white-space: nowrap; */
    font-size: 0;
  }

  .module {
    /* display: inline-block; */
    width: 150px;
    height: 400px;
    font-size: 16px;
  }

</style>
