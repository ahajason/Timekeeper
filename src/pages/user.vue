<template>
  <tab-bar></tab-bar>
</template>
<script>
import tabBar from '@/components/tabBar/tabBar'
export default {
  name: 'user',
  components:{
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
<style scoped>

</style>
