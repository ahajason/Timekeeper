<template>
  <div>
    <div class="main-content">
      <timing-panel></timing-panel>
      <todo-list></todo-list>
    </div>
    <tab-bar></tab-bar>
  </div>
</template>
<script>
import tabBar from '@/components/tabBar/tabBar'
import TimingPanel from '@/pages/home/TimingPanel'
import TodoList from '@/pages/home/TodoList'
export default {
  name: 'home',
  components: {
    tabBar,
    TimingPanel,
    TodoList
  },
  data() {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>


</style>
