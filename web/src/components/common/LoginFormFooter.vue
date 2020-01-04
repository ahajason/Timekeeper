<template>
  <div class="from-footer">
    <slot></slot>
  </div>
</template>
<script>
  export default {
    name: "FromItem",
    data() {
      return {};
    },
    methods: {}
  };

</script>

<style scoped lang='less'>
  .from-footer {
    font-size: 16px;
    align-items: center;
    justify-content: center;
    display: flex;

    .item {
      padding: 5px;
    }
  }
</style>
