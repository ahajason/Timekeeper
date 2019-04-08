<template>
  <div class="CircleGroup">
    <XCircle stroke-color="#fff" trail-color="#343434" anticlockwise class="sCircle" :percent="cptSecond">
      <XCircle stroke-color="#fff" trail-color="#343434" anticlockwise class="mCircle" :percent="cptMinute">
        <XCircle stroke-color="#fff" trail-color="#343434" anticlockwise class="hCircle" :percent="cptHour">
          <slot></slot>
        </XCircle>
      </XCircle>
    </XCircle>
  </div>
</template>
<script>
  import {
    XCircle
  } from 'vux';
  export default {
    name: 'CircleGroup',
    data() {
      return {};
    },
    props: {
        hasHour: {
        type: Boolean,
        default: true,
        },
      hour:{
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 24
        },
      },
      minute:{
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 60
        },
      },
      second:{
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 60
        },
      },
    },
    components: {
      XCircle
    },
    mounted() {

    },
    computed: {
      // cptSecond: ()=>parseInt(this.second/60*100),
      cptSecond: function () {
        return parseInt(100 - this.second / 60 * 100)
      },
      cptMinute: function () {
        return parseInt(100 - this.minute / 60 * 100)
      },
      cptHour: function () {
        return parseInt(100 - this.hour / 12 * 100)
      },
    },
  }

</script>

<style scoped lang='less'>
  .mCircle {
    padding: 6px;
  }

  .hCircle {
    padding: 12px;
  }

</style>
