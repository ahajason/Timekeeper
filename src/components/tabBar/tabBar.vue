<template>
  <div id="tab-bar">
    <ul class="list">
      <router-link class="item" tag="li" :to="{ name: item.pageName }" v-for="item in list" :key="item.id" exact>
        <i class="iconfont" :class="item.iconClass"></i>
        <div class="text">{{item.text}}</div>
      </router-link>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'tab-bar',
  data() {
    return {
      list: [{
          id: 1,
          pageName: "home",
          iconClass: "icon-home",
          text: "首页"
        },
        {
          id: 2,
          pageName: "timeline",
          iconClass: "icon-timeline",
          text: "时间轴"
        },
        {
          id: 3,
          pageName: "management",
          iconClass: "icon-chart",
          text: "管理"
        },
        {
          id: 4,
          pageName: "user",
          iconClass: "icon-user",
          text: "我的"
        },
      ]
    }
  },
}

</script>

<style scoped>
#tab-bar {
  right: 0;
  left: 0;
  bottom: 0;
  position: fixed;
  box-shadow: 0 2px 4px #000;
  width: 100%;
  z-index: 1000;
  background: #fff;
}

.list {
  display: flex;
}

.item {
  padding: 3px 0;
  text-align: center;
  flex: 1 1 auto;
  color: #ADADAD;
}

.item.active {
  color: #000;
}

.iconfont {
  font-size: 20px;
}


</style>
