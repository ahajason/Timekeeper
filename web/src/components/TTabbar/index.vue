<template>
  <div id="TTabbar">
    <ul class="list">
      <router-link :to="{ name: 'home' }" class="item" exact tag="li">
        <div class="nav-icon"><i class="iconfont icon-home"></i></div>
        <div class="nav-text">首页</div>
      </router-link>

      <router-link :to="{ name: 'management' }" class="item" exact tag="li">
        <div class="nav-icon"><i class="iconfont icon-chart"></i></div>
        <div class="nav-text">管理</div>
      </router-link>
      <router-link :to="{ name: 'tomato' }" class="item" exact tag="li">
        <div class="nav-icon"><img src="static/tomato.png"/></div>
        <div class="nav-text">番茄钟</div>
      </router-link>

      <router-link :to="{ name: 'timeline' }" class="item" exact tag="li">
        <div class="nav-icon"><i class="iconfont icon-timeline"></i></div>
        <div class="nav-text">时间轴</div>
      </router-link>

      <router-link :to="{ name: 'user' }" class="item" exact tag="li">
        <div class="nav-icon"><i class="iconfont icon-user"></i></div>
        <div class="nav-text">我的</div>
      </router-link>
    </ul>
  </div>
</template>
<script>
  export default {
    name: "TTabbar",
    data() {
      return {};
    }
  };
</script>

<style lang="less" scoped>
  #TTabbar {
    right: 0;
    left: 0;
    bottom: 0;
    position: fixed;
    box-shadow: 0 2px 4px #000;
    width: 100%;
    z-index: 500;
    background: #fff;

    .list {
      display: flex;
      align-items: center;

      .item {
        padding: 3px 0;
        text-align: center;

        flex: 1 1 auto;
        color: #adadad;

        &.active {
          color: #000;
        }

        .nav-icon {
          vertical-align: middle;
          align-items: center;

          .iconfont {
            font-size: 20px;
          }

          img {
            width: 25px;
            vertical-align: middle;
            align-items: center;
          }
        }
      }
    }
  }
</style>
