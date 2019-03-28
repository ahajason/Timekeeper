<template>

  <div class="page">


    <section class="bottom flex-box">
      <div class="l" @click="goback">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
      </div>
      <div class="c">
        <input type="text" ref="input-name" placeholder="请输入计划名称…">
      </div>
      <div class="r">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </div>
    </section>

  </div>
         
</template>
<script>
  export default {
    name: 'HelloWorld',
    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
    mounted(){
      this.$refs['input-name'].focus()
    },
    methods:{
      goback(){
        this.$router.back()
      }
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
      .l,.r{
        padding: 10px;
        font-size: 30px;
      }
      .c{
        input{
          background: none;
          width: 100%;
          border-radius: 50px;
          border: 2px solid #fff;
          color: #fff;
          padding: 15px;
          font-size: 16px;
          line-height: 1;
          vertical-align: middle;
          &::placeholder{
            color: rgba(255, 255, 255, 0.5);
          }
          &:focus{
            outline: none;
          }
        }
      }
    }
  }

</style>
