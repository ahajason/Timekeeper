<template>
  <div class="CircleGroup">
    <XCircle
      stroke-color="#fff"
      trail-color="#343434"
      anticlockwise
      class="sCircle"
      :percent="cptSecond"
    >
      <XCircle
        stroke-color="#fff"
        trail-color="#343434"
        anticlockwise
        class="mCircle"
        :percent="cptMinute"
      >
        <XCircle
          stroke-color="#fff"
          trail-color="#343434"
          anticlockwise
          class="hCircle"
          :percent="cptHour"
        >
          <slot></slot>
        </XCircle>
      </XCircle>
    </XCircle>
  </div>
</template>
<script>
import { XCircle } from "vux";
export default {
  name: "CircleGroup",
  data() {
    return {};
  },
  props: {
    hasHour: {
      type: Boolean,
      default: true
    },
    hour: {
      type: Number,
      default: 0,
      validator: value => value >= 0 && value <= 24
    },
    minute: {
      type: Number,
      default: 0,
      validator: value => value >= 0 && value <= 60
    },
    second: {
      type: Number,
      default: 0,
      validator: value => value >= 0 && value <= 60
    },
    maxHour: {
      type: Number,
      default: 24,
      validator: value => value != 0
    },
    maxMinute: {
      type: Number,
      default: 60,
      validator: value => value != 0
    },
    maxSecond: {
      type: Number,
      default: 60,
      validator: value => value != 0
    },
    anticlockwise: {
      type: Boolean,
      default: false
    }
  },
  components: {
    XCircle
  },
  mounted() {},
  computed: {
    // cptSecond: ()=>parseInt(this.second/60*100),
    cptSecond: function() {
      return this.anticlockwise
        ? parseInt((this.second / this.maxSecond) * 100)
        : parseInt(100 - (this.second / this.maxSecond) * 100);
    },
    cptMinute: function() {
      return this.anticlockwise
        ? parseInt((this.minute / this.maxMinute) * 100)
        : parseInt(100 - (this.minute / this.maxMinute) * 100);
    },
    cptHour: function() {
      if (this.hasHour)
        return this.anticlockwise
          ? parseInt((this.hour / this.maxHour) * 100)
          : parseInt(100 - (this.hour / this.maxHour) * 100);
      else
        return 0;
    }
  }
};
</script>

<style scoped lang="less">
.mCircle {
  padding: 6px;
}

.hCircle {
  padding: 12px;
}
</style>
