<template>
  <div id="app">
    <transition name="fade">
      <router-view/>
    </transition>
  </div>
</template>
<script>
  export default {
    name: 'App',
    components: {},
  }

</script>
<style lang="less">
  @import '~vux/src/styles/reset.less';
  @import 'style/main.less';
</style>
