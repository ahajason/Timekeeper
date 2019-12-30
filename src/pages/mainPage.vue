<template>
  <div class="page">
    <transition name="fade" mode="out-in">
      <keep-alive>
        <router-view v-if="$route.meta.keepAlive"></router-view>
      </keep-alive>
    </transition>
    <transition name="fade" mode="out-in">
      <router-view v-if="!$route.meta.keepAlive"></router-view>
    </transition>
    <TTabbar></TTabbar>
  </div>
</template>
<script>
import TTabbar from "@/components/TTabbar";
export default {
  name: "mainPage",
  components: {
    TTabbar
  },
  data() {
    return {};
  }
};
</script>

<style scoped></style>
