<template>
  <div class="page">

    <transition
      name="fade"
      mode="out-in"
    >
      <keep-alive>
        <router-view />
      </keep-alive>
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

<style scoped>
</style>
