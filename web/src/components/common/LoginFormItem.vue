<template>
  <div class="from-item">
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

<style lang='less' scoped>
  .from-item {
    padding: 10px 30px;

    input,
    button {
      width: 100%;
      font-size: 20px;
      padding: 12px 20px;
      border-radius: 50px;
      color: @white;
      background: none;
      border: 2px solid @white;
      font-family: inherit;

      &::placeholder {
        font-family: inherit;
        color: rgba(255, 255, 255, 0.6);
      }

      &:focus {
        outline: none;
      }

      &:active {
        background: #444;
      }
    }
  }
</style>
