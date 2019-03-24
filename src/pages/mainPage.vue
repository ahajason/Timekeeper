<template>
  <div class="page">
    <transition name="fade" mode="out-in">
      <router-view />
    </transition>
    <tab-bar></tab-bar>
  </div>
</template>
<script>
  import tabBar from '@/components/tabBar/tabBar'
  export default {
    name: 'mainPage',
    components: {
      tabBar
    },
    data() {
      return {
      }
    }
  }

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
