<template>
  <div id="todo-list">
    <div class="todo-list-body">
      {{msg}}
    </div>
  </div>
</template>
<script>
export default {
  name: 'todo-list',
  data() {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.todo-list-body {
  height: 600px;
}

</style>
