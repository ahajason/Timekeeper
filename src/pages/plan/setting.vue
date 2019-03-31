<template>
  <div class="page">
    <Label v-bind:active="false" textActive="紧急"></Label>
    <Label size='sm' text="重要"></Label>
    <Label text="小鸭子"></Label>
  </div>
</template>
<script>
  import Label from '@/components/common/Label.vue'
  export default {
    name: 'HelloWorld',
    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
    components: {
      Label
    },
    mounted() {

    },
  }

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang='less' scoped>
  .page {
    background: #343434;

    .bottom {
      position: fixed;
      bottom: 0;
      right: 0;
      left: 0;
      display: flex;
      color: #fff;
      border-top: 1px dashed rgb(255, 255, 255, 0.2);
      font-size: 18px;
      padding: 10px 0;

      .l {
        padding: 15px;
      }

      .c {
        input {
          background: none;
          width: 100%;
          border-radius: 50px;
          border: 2px solid #fff;
          color: #fff;
          padding: 15px;
          font-size: 18px;
          line-height: 1;
          vertical-align: middle;

          &::placeholder {
            color: rgba(255, 255, 255, 0.5);
          }

          &:focus {
            outline: none;
          }
        }
      }

      .r {
        padding: 15px;
      }
    }
  }

</style>
