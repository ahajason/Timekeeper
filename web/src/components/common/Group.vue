<template>
  <div class="group">
    <slot></slot>
  </div>
</template>
<script>
  export default {
    name: "Group",
    data() {
      return {};
    },
    props: {},
    methods: {}
  };
</script>

<style lang="less" scoped>
  .group {
    width: 100%;
  }
</style>
