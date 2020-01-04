<template>
  <div
    id='THeader'
    class="flex-box"
  >
    <div class="l">
      <slot name='l'></slot>
    </div>
    <div class="c">
      <slot name='c'></slot>
      <slot></slot>
    </div>
    <div class="r">
      <slot name='r'></slot>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'THeader',
    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    }
  }

</script>

<style lang='less' scoped>
  #THeader {
    position: fixed;
    background: #343434;
    top: 0;
    right: 0;
    left: 0;
    display: flex;
    border-bottom: 1px solid rgba(255, 255, 255);
    // box-shadow: 0px 0px 1px 1px rgba(255, 255, 255);

    padding: 10px;
    z-index: 100;

    .text {
      display: inline-block;
    }

    .c {
      text-align: center;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      font-size: 20px;
    }

    .l {
      text-align: left;
    }

    .r {
      text-align: right;
    }

    .l,
    .r {
      flex: 1 0 20px;
    }
  }
</style>
