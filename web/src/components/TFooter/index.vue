<template>
  <div id="TFooter" class="flex-box">
    <div class="l">
      <slot name="l"></slot>
    </div>
    <div class="c">
      <slot name="c"></slot>
      <slot></slot>
    </div>
    <div class="r">
      <slot name="r"></slot>
    </div>
  </div>
</template>
<script>
  export default {
    name: "TFooter",
    data() {
      return {
        msg: "Welcome to Your Vue.js App"
      };
    }
  };
</script>

<style lang="less" scoped>
  #TFooter {
    position: fixed;
    bottom: 0;
    right: 0;
    left: 0;
    display: flex;
    color: #fff;
    background: #343434;
    border-top: 1px dashed rgba(255, 255, 255);
    font-size: 18px;
    padding: 10px;
    z-index: 1;

    .text {
      display: inline-block;
    }

    .c {
      text-align: center;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      font-size: 20px;
      padding: 0 10px;

      input {
        background: none;
        width: 100%;
        border-radius: 50px;
        border: 2px solid #fff;
        color: #fff;
        padding: 10px 15px;
        font-size: 16px;
        line-height: 1.2;
        vertical-align: middle;

        &::placeholder {
          color: rgba(255, 255, 255, 0.5);
        }

        &:focus {
          outline: none;
        }
      }
    }

    .l {
      text-align: left;
    }

    .r {
      text-align: right;
    }

    .l,
    .r {
      flex: 0 0 auto;
    }
  }
</style>
