<template>
  <div class="form">
    <div
      class="form-header"
      v-text="title"
    ></div>
    <slot></slot>
  </div>
</template>
<script>
  export default {
    name: "Form",
    data() {
      return {};
    },
    props: {
      title: {
        type: String,
        default: "",
      }
    },
    methods: {}
  };

</script>

<style scoped lang='less'>
  .page {
    .form {
      width: 100%;
      padding: 30px 0 100px;
      color: #fff;

      .form-header {
        text-align: center;
        font-size: 50px;
        padding: 20px 0;
        line-height: 150%;
      }
    }
  }
</style>
