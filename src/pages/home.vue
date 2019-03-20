<template>
  <div class="page">
    <div class="main-content">
      <section class="create-task">
        <div class="start-btn">
          <div class="slogan">
            开始你的任务
          </div><i class="fa fa-paper-plane" aria-hidden="true">
          </i>
        </div>
      </section>
      <transition class="todo">
        <div class="headr">
          2
        </div>
        <div class="body">
          1
        </div>
      </transition>
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
  .main-content {
    overflow-y: auto;
    height: 100%;
  }

  .create-task {
    background: #343434;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: absolute;
  }

  .start-btn {
    display: flex;
    margin: 15px;
    height: 50px;
    padding: 15px;
    border-radius: 50px;
    border: 2px solid #fff;
    align-items: center;
  }

  .start-btn .slogan {
    color: #fff;
    flex: 1 0 50px;
    line-height: 1;
    font-size: 20px;
    vertical-align: middle;
  }

  .start-btn i {
    color: #fff;
    flex: 0 0 50px;
    line-height: 1;
    font-size: 20px;
    text-align: right;
    vertical-align: middle;
  }

  .todo {
    padding-top: 100px;
    min-height: 100%;
    flex-direction: column;
    display: flex;
  }

  .warpper {
    height: 100%;
  }

  .headr {
    background: #F5F5F5;
    height: 40px;
    flex: 0 0 40px;
    width: 100%;
    border-radius: 10px 10px 0 0;
    border-bottom: 1px dashed rgb(52, 52, 52, 0.2);
  }

  .body {
    flex: 1 0 auto;
    background: #F5F5F5
  }

</style>
