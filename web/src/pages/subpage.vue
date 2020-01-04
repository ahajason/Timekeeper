<template>
  <div class="page">
    <transition mode="out-in" name="fade">
      <router-view/>
    </transition>
  </div>
</template>
<script>
  export default {
    name: 'subpage',

    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    }
  }
</script>
<style scoped>
</style>
