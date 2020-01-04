<template>
  <div class="page">
    <transition mode="out-in" name="fade">
      <keep-alive>
        <router-view v-if="$route.meta.keepAlive"/>
      </keep-alive>
    </transition>
    <transition mode="out-in" name="fade">
      <router-view v-if="!$route.meta.keepAlive"/>
    </transition>
    <TTabbar/>
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
