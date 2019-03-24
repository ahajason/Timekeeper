<template>
    <div class="content">
      <transition enter-active-class="animated slideInUp" leave-active-class="animated slideOutDown">
        <section class="todo" v-if="show">
          <div class="headr ">
            <h2>待办清单</h2>
          </div>
          <div class="body">
            <div class="plan flex-box" v-for="(item, index) in [1,2,3,4,5,6,7,8,9,10,11]" :key="index">
              <div class="l">
                <i v-if='true' class="fa fa-square-o" aria-hidden="true">
                </i>
                <i v-if='false' class="fa fa-check-square-o" aria-hidden="true">
                </i>

              </div>
              <div class="c">
                <h3 class="name-line">name{{item}}</h3>
                <h5 class="level-line">name{{item}}</h5>
                <h5 class="category-line">name{{item}}</h5>
              </div>
              <div class="r">
                <i class="fa fa-play" aria-hidden="true">
                </i>
              </div>
            </div>
          </div>
        </section>
      </transition>
      <section class="create-task">
        <div class="start-btn flex-box" @click="navToCreatePlan">
          <div class="slogan">
            制定一个计划
          </div>
          <div class="r">
            <i class="fa fa-paper-plane" aria-hidden="true">
            </i>
          </div>

        </div>
      </section>
    </div>
</template>
<script>
  import tabBar from '@/components/tabBar/tabBar'
  import TimingPanel from './TimingPanel'
  import TodoList from './TodoList'
  export default {
    name: 'home',
    components: {
      tabBar,
      TimingPanel,

    },
    data() {
      return {
        msg: 'Welcome to Your Vue.js App',
        show: true
      }
    },
    methods: {
      // showTodo(){

      // }
      navToCreatePlan() {
        this.$router.push({
          name: 'createPlan',
          params: {
            pSyncKey: '1'
          }
        })
      }
    },
  }

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang='less' scoped>
    .content {
      height: 100%;

      .create-task {
        left: 0;
        top: 0;
        width: 100%;
        position: absolute;

        .start-btn {
          margin: 15px;
          padding: 15px;
          border-radius: 50px;
          border: 2px solid #fff;
          color: #fff;
          line-height: 1;
          font-size: 18px;
          vertical-align: middle;

          .slogan {
            text-align: left;
            flex: 1 0 auto;
            line-height: 1;
            font-size: 18px;
            vertical-align: middle;
          }

          i {
            flex: 0 0 auto;
          }
        }
      }

      .todo {
        padding-top: 100px;
        padding-bottom: 60px;
        min-height: 100%;
        flex-direction: column;
        display: flex;

        .headr {
          background: #F5F5F5;
          flex: 0 0 auto;
          width: 100%;
          border-radius: 10px 10px 0 0;
          border-bottom: 1px dashed rgb(52, 52, 52, 0.2);

          h2 {
            line-height: 2;
            text-indent: 20px;
          }
        }

        .body {
          flex: 1 0 auto;
          background: #F5F5F5;

          .plan {
            text-align: center;
            padding: 5px 0;
            font-size: 25px;

            .l {
              padding: 10px;
            }

            .c {
              font-size: 16px;
              text-align: left;
            }

            .r {
              padding: 10px;
            }
          }
        }
      }
    }

</style>
