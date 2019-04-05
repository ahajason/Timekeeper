<template>
  <div class="page">
    <div class="header-panel flex-box">
      <div class="portrait l">
        <img src="https://avatars3.githubusercontent.com/u/39185373?s=460&v=4" alt="">
      </div>
      <div class="userName c">
        <div class="text">小鸭子！嘎嘎嘎~~~</div>
      </div>
      <div class="right-icon r">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </div>
    </div>
    <div class="settings-list">
      <div class="setting-item">
        <div class="title">
          <div class="text">小鸭子！</div>
        </div>
        <div class="value">
          <div class="text">嘎嘎嘎~~~</div>
        </div>
        <div class="right-icon">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </div>
      <div class="setting-item">
        <div class="title">
          <div class="text">小鸭子！</div>
        </div>
        <div class="value">
          <div class="text">嘎嘎嘎~~~</div>
        </div>
        <div class="right-icon">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
      </div>
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
  .page {
    .header-panel {
      padding: 40px 20px;
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
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        border-bottom: 2px solid #fff;

        .text {
          display: inline-block;
          padding: 0 10px 2px;
        }
      }

      .right-icon {
        font-size: 25px;
      }

    }

    .settings-list {
      padding: 0 20px 100px;
      width: 100%;
      color: #fff;

      .setting-item {
        display: flex;
        align-items: center;
        padding: 6px 8px;
        border-bottom: 1px solid #fff;
        margin: 10px 0;

        .title {
          flex: 1 1 auto;
          overflow: hidden;
          white-space: nowrap;
          text-overflow: ellipsis;
        }

        .value {
          padding: 0 8px;
          font-size: 16px;
          opacity: 0.8;
        }

        .right-icon {
          font-size: 25px;
        }
      }
    }

  }

</style>
