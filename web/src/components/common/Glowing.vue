<template>
  <div
      :style="{
      color: color,
      textShadow:
        '0 0 1px ' +
        textShadow +
        ', 0 0 2px ' +
        textShadow +
        ', 0 0 3px ' +
        textShadow +
        ', 0 0 4px ' +
        textShadow +
        ', 0 0 5px ' +
        textShadow +
        ', 0 0 6px ' +
        textShadow
    }"
      class="wrapper"
  >
    <slot></slot>
  </div>
</template>
<script>
  export default {
    name: "Glowing",
    data() {
      return {};
    },
    props: {
      color: {
        type: String,
        default: "#fff"
      },
      textShadow: {
        type: String,
        default: "#fff"
      }
    },
    mounted() {
    },
    methods: {}
  };
</script>

<style lang="less" scoped></style>
