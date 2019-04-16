<template>
  <div class="content">
    <transition
      enter-active-class="animated slideInUp"
      leave-active-class="animated slideOutDown"
    >
      <section class="todo" v-if="show">
        <div class="headr">
          <div class="title">今日待办</div>
        </div>
        <div class="body">
          <swipeout>
            <div v-for="(item, index) in todayTodoList" :key="index">
              <swipeout-item transition-mode="follow">
                <div slot="right-menu">
                  <swipeout-button background-color="">Fav</swipeout-button>
                  <swipeout-button>Delete</swipeout-button>
                </div>
                <div slot="content" class="item flex-box">
                  <div
                    class="l"
                    v-if="item.item_state == 0"
                    @click="completeItem(index)"
                  >
                    <i class="fa fa-square-o" aria-hidden="true"> </i>
                  </div>
                  <div
                    class="l"
                    v-if="item.item_state != 0"
                    @click="restartItem(index)"
                  >
                    <i class="fa fa-check-square-o" aria-hidden="true"> </i>
                  </div>
                  <div class="c" @click="goDetails(index)">
                    <div class="name-line">{{ item.item_name }}</div>
                    <div class="level-line">
                      <div class="category-name">
                        #{{ item.category.category_name }}
                      </div>
                      <Label
                        v-bind:active="item.item_emergency_level >= 5"
                        textActive="重要"
                        text="不重要"
                        backgroundActive="#ff3333"
                        size="sm"
                      ></Label>
                      <Label
                        v-bind:active="item.item_importance_level >= 5"
                        textActive="紧急"
                        size="sm"
                      ></Label>
                    </div>
                  </div>
                  <div class="r">
                    <i class="fa fa-angle-double-left" aria-hidden="true"> </i>
                  </div>
                </div>
              </swipeout-item>
            </div>
          </swipeout>
        </div>
      </section>
    </transition>
    <section class="create-task">
      <router-link
        class="start-btn flex-box"
        tag="div"
        :to="{ name: 'createItem' }"
        exact
      >
        <div class="slogan">
          开始一个事务
        </div>
        <div class="r">
          <i class="fa fa-paper-plane" aria-hidden="true"> </i>
        </div>
      </router-link>
    </section>
  </div>
</template>
<script>
import { mapGetters, mapMutations } from "vuex";
import Label from "../../components/common/Label.vue";
import { Swipeout, SwipeoutItem, SwipeoutButton } from "vux";
export default {
  name: "home",
  components: {
    Label,
    Swipeout,
    SwipeoutItem,
    SwipeoutButton
  },
  data() {
    return {
      msg: "Welcome to Your Vue.js App",
      show: true
    };
  },
  methods: {},
  computed: {
    ...mapGetters(["tokenInfo", "todayTodoList"])
  },
  mounted() {
    this.getItemList();
  },
  methods: {
    goDetails(index) {
      this.$router.push({
        name: "itemDetails",
        params: {
          synckey: index
        }
      });
    },
    completeItem(item_sync_key) {
      let item = this.todayTodoList[item_sync_key];
      let requestData = { item_sync_key, ...this.tokenInfo };
      this.$startRequest(
        "/item/completeItem",
        requestData,
        res => {
          this.addItemList(res.data);
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    restartItem(item_sync_key) {
      let item = this.todayTodoList[item_sync_key];
      let requestData = { item_sync_key, ...this.tokenInfo };
      this.$startRequest(
        "/item/restartItem",
        requestData,
        res => {
          this.addItemList(res.data);
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    getItemList() {
      let requestData = this.tokenInfo;
      this.$startRequest(
        "/item/getTodoList",
        requestData,
        res => {
          this.addItemList(res.data);
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    ...mapMutations(["addItemList"])
  }
};
</script>

<style lang="less" scoped>
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
      // background: #f5f5f5;
      color: #fff;
      flex: 0 0 auto;
      width: 100%;
      border-radius: 10px 10px 0 0;
      margin-bottom: 20px;

      .title {
        display: inline-block;
        // line-height: 2;
        padding: 0 20px;
        font-size: 22px;
        text-indent: 20px;
        border-bottom: 1px dashed #fff;
      }
    }

    .body {
      flex: 1 0 auto;

      .item {
        // margin-left: 20px;
        background: #343434;
        text-align: center;
        padding: 6px 0;
        font-size: 25px;
        // border-radius: 40px 0 0 40px;
        // box-shadow: 0 0 5px 4px #f5f5f5;
        color: #fff;

        .l {
          padding: 10px 20px;
        }

        .c {
          text-align: left;
          .name-line {
            font-size: 18px;
            line-height: 2;
          }
          .level-line {
            font-size: 16px;
            line-height: 1.2;
            color: #fff;
            display: flex;
            .category-name {
              font-style: italic;
              opacity: 0.6;
            }
            & > div {
              margin-right: 15px;
            }
          }
        }

        .r {
          padding-right: 15px;
          opacity: 0.6;
        }
      }
    }
  }
}
</style>
