<template>
  <div class="header-panel flex-box">
    <div class="portrait l">
      <img src="https://avatars3.githubusercontent.com/u/39185373?s=460&v=4" alt="">
    </div>
    <div class="userName c"><div class="text">小鸭子！嘎嘎嘎~~~</div>
    </div>
    <div class="right-icon r">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
    </div>
  </div>
</template>
<script>
  import tabBar from '@/components/tabBar/tabBar'
  export default {
    name: 'user',
    components: {
      tabBar
    },
    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    }
  }

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang='less'>
  .header-panel {
    padding: 20px;
    width: 100%;
    color: #fff;
    .portrait {
      width: 80px;
      height: 80px;
      overflow: hidden;
      box-sizing: border-box;
      z-index: 1;
      flex: 0 0 auto;
      border-radius: 50%;
      border: 4px solid #fff;
      img {
        width: 100%;
        height: 100%;

      }
    }

    .userName {
      flex: 1 1 auto;
      margin: 0 10px 0;
      overflow:hidden;
      white-space: nowrap;
      text-overflow:ellipsis;
      border-bottom: 2px solid #fff;

      .text {
        display: inline-block;
        padding: 0 10px 2px;
      }
    }
    .right-icon{
      font-size: 25px;
    }

  }

</style>
