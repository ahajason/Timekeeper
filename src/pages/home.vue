<template>
  <div class="page">
    <div class="main-content">
      <div class="start-btn"><div class="slogan">
        开始你的任务
        </div><i class="fa fa-paper-plane" aria-hidden="true">

        </i></div>
    </div>
    <tab-bar></tab-bar>
  </div>
</template>
<script>
  import tabBar from '../components/tabBar/tabBar'
  import TimingPanel from './home/TimingPanel'
  import TodoList from '@/pages/home/TodoList'
  export default {
    name: 'home',
    components: {
      tabBar,
      TimingPanel,

    },
    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
  }

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .start-btn {
    display: flex;
    margin: 15px;
    height: 50px;
    padding: 15px;
    border-radius: 50px;
    border: 2px solid #fff;
    align-items: center;
  }
  .start-btn .slogan{
    color: #fff;
    flex: 1 0 50px;
    line-height: 1;
    font-size: 20px;
    vertical-align: middle;
  }
  .start-btn i{
    color: #fff;
    flex: 0 0 50px;
    line-height: 1;
    font-size: 20px;
    text-align: right;
    vertical-align: middle;
  }
  .main-content {
    background: #343434;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  

</style>
