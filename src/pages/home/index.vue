<template>
  <div class="content">
    <transition
      enter-active-class="animated slideInUp"
      leave-active-class="animated slideOutDown"
    >
      <section
        class="todo"
        v-if="show"
      >
        <div class="headr">
          <div class="title">待办清单</div>
        </div>
        <div class="body">
          <div
            class="plan flex-box"
            v-for="(item, index) in [1,2,3,4,5,6,7,8,9,10,11]"
            :key="index"
          >
            <div class="l">
              <i
                v-if='true'
                class="fa fa-square-o"
                aria-hidden="true"
              >
              </i>
              <i
                v-if='false'
                class="fa fa-check-square-o"
                aria-hidden="true"
              >
              </i>

            </div>
            <div class="c">
              <div class="name-line">事务{{item}}</div>
              <div class="level-line">事务{{item}}</div>
              <div class="category-line">事务{{item}}</div>
            </div>
            <div class="r">
              <i
                class="fa fa-play"
                aria-hidden="true"
              >
              </i>
            </div>
          </div>
        </div>
      </section>
    </transition>
    <section class="create-task">
      <router-link
        class="start-btn flex-box"
        tag="div"
        :to="{ name: 'createPlan' }"
        exact
      >
        <div class="slogan">
          开始一个事务
        </div>
        <div class="r">
          <i
            class="fa fa-paper-plane"
            aria-hidden="true"
          >
          </i>
        </div>
      </router-link>
    </section>
  </div>
</template>
<script>
import { mapGetters, mapMutations } from 'vuex'
import { startRequest } from '../../api'
import Label from '../../components/common/Label.vue'
import tabBar from '../../components/tabBar/tabBar'
export default {
  name: 'home',
  components: {
    tabBar,
  },
  data() {
    return {
      msg: 'Welcome to Your Vue.js App',
      show: true
    }
  },
  methods: {
    Label,
  },
  computed: {
    ...mapGetters([
      'tokenInfo',
      'todayTodoList',
    ])
  },
  mounted() {
    this.getItemList()
  },
  methods: {
    getItemList() {
      let requestData = this.tokenInfo;
      startRequest('/item/getTodoList', requestData, (res) => {
        this.addItemList(res.data)
      }, () => {
        if (error.msg) {
          this.$vux.toast.text(error.msg, 'top')
        } else {
          this.$vux.toast.text('网络错误', 'top')
        }
      });
    },
    ...mapMutations([
      'addItemList',
    ])
  }

}

</script>

<style lang='less' scoped>
.content {
  height: 100%;

  .create-task {
    left: 0;
    top: 0;
    width: 100%;
    position: absolute;

    .start-btn {
      margin: 30px 15px 15px;
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
    padding-top: 120px;
    padding-bottom: 60px;
    min-height: 100%;
    flex-direction: column;
    display: flex;

    .headr {
      background: #f5f5f5;
      flex: 0 0 auto;
      width: 100%;
      border-radius: 10px 10px 0 0;
      border-bottom: 1px dashed rgba(52, 52, 52, 0.2);

      .title {
        line-height: 2;
        font-size: 22px;
        text-indent: 20px;
      }
    }

    .body {
      flex: 1 0 auto;
      background: #f5f5f5;

      .plan {
        text-align: center;
        padding: 6px 0;
        font-size: 25px;

        .l {
          padding: 10px;
        }

        .c {
          text-align: left;
          .name-line {
            font-size: 18px;
          }
          .level-line,
          .category-line {
            font-size: 16px;
            line-height: 1.1;
            color: rgba(52, 52, 52, 0.6);
          }
        }

        .r {
          padding: 10px;
        }
      }
    }
  }
}
</style>
