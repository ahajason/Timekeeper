<template>
  <div class="page">
    <THeader style="border:none">
      <div slot="l">
        <div @click="goback">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
          <div class="text">返回</div>
        </div>
      </div>
      <div slot="c">1221</div>
      <div slot="r">
        <div @click="onNext" v-if="test">
          <i class="fa fa-fast-forward" aria-hidden="true"></i>
          <div class="text">快速完成</div>
        </div>
      </div>
    </THeader>
    <swiper ref="tswiper">
      <swiperSlide class="module" id="module1">
        <div class="content">
          <CircleGroup
            class="CircleGroup"
            v-bind="timeUnitArr"
            :maxHour="10"
            v-bind:maxMinute="maxMinute"
            anticlockwise
            :hasHour="false"
          >
            <DigitalClock
              :hasHour="false"
              class="DigitalClock"
              v-bind="timeDigitalArr"
            ></DigitalClock>
            <div class="tomatoCounter" @click="onNext">
              <img class="tomato" src="static/tomato.png" />
              <div class="text">x {{ tomatoNumber }}</div>
            </div>
          </CircleGroup>
          <section class="doing">
            <div class="plan flex-box" v-if="currentItemSyncKey && todoList">
              <div class="c">
                <i
                  :class="todoList[currentItemSyncKey].category.icon.icon_src"
                  aria-hidden="true"
                ></i>
                <div class="name-line">
                  {{ todoList[currentItemSyncKey].item_name }}
                </div>
              </div>
            </div>
          </section>
          <section class="todo" v-if="todoList">
            <div
              class="plan flex-box"
              v-for="item in tomatoTodoList"
              :key="item.item_sync_key"
              @click="activeItem(item.item_sync_key)"
            >
              <div class="c">
                <i :class="item.category.icon.icon_src" aria-hidden="true"></i>
                <div class="name-line">{{ item.item_name }}</div>
              </div>
              <div class="r">
                <i class="fa fa-angle-double-up" aria-hidden="true"></i>
              </div>
            </div>
          </section>
        </div>
      </swiperSlide>
      <swiperSlide class="module" id="module2">
        <div class="content">
          <CircleGroup class="CircleGroup" v-bind="timeUnitArr">
            <DigitalClock
              class="DigitalClock"
              v-bind="timeDigitalArr"
            ></DigitalClock>
          </CircleGroup>
          <section class="doing">
            <div class="plan flex-box">
              <div class="c">
                <div class="name-line">任务</div>
              </div>
              <div class="r">
                <i class="fa fa-angle-double-down" aria-hidden="true"></i>
              </div>
            </div>
          </section>
          <section class="todo">
            <div
              class="plan flex-box"
              v-for="(item, index) in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]"
              :key="index"
            >
              <div class="c">
                <div class="name-line">任务{{ item }}</div>
              </div>
              <div class="r">
                <i class="fa fa-angle-double-up" aria-hidden="true"></i>
              </div>
            </div>
          </section>
        </div>
      </swiperSlide>
      <swiperSlide class="module" id="module3">
        <div class="content">
          <CircleGroup class="CircleGroup" v-bind="timeUnitArr">
            <DigitalClock
              class="DigitalClock"
              v-bind="timeDigitalArr"
            ></DigitalClock>
          </CircleGroup>
          <section class="doing">
            <div class="plan flex-box">
              <div class="c">
                <div class="name-line">任务</div>
              </div>
              <div class="r">
                <i class="fa fa-angle-double-down" aria-hidden="true"></i>
              </div>
            </div>
          </section>
          <section class="todo">
            <div
              class="plan flex-box"
              v-for="(item, index) in [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]"
              :key="index"
            >
              <div class="c">
                <div class="name-line">任务{{ item }}</div>
              </div>
              <div class="r">
                <i class="fa fa-angle-double-up" aria-hidden="true"></i>
              </div>
            </div>
          </section>
        </div>
      </swiperSlide>
    </swiper>
    <TFooter>
      <div slot="l">
        <div @click="onParse">
          <i v-show="!pause" class="fa fa-coffee" aria-hidden="true"></i>
          <div v-show="!pause" class="text">休息</div>
        </div>
        <div v-if="tomatoNumber" @click="onAction">
          <i v-show="pause" class="fa fa-play-circle-o" aria-hidden="true"></i>
          <div v-show="pause" class="text">继续</div>
        </div>
        <div v-if="!tomatoNumber" @click="onAction">
          <i v-show="pause" class="fa fa-play-circle-o" aria-hidden="true"></i>
          <div v-show="pause" class="text">开始</div>
        </div>
      </div>
      <div slot="c"></div>
      <div slot="r">
        <div @click="onStop">
          <div class="text">结束</div>
          <i class="fa fa-stop-circle-o" aria-hidden="true"></i>
        </div>
      </div>
    </TFooter>
  </div>
</template>
<script>
import THeader from "../../components/THeader";
import TFooter from "../../components/TFooter";
import CircleGroup from "@/components/common/CircleGroup";
import DigitalClock from "@/components/common/DigitalClock";
import { swiper, swiperSlide } from "vue-awesome-swiper";
import _ from "lodash";
const TOMATO_TIME = 25;

const REST_TIME = 5;

export default {
  name: "tomato",
  data() {
    return {
      pause: true,
      timeDigitalArr: {},
      timeUnitArr: {},
      timingArr: {},
      startingTime: {
        hour: 0,
        minute: 0,
        second: 0
      },
      finishTime: null,
      breaktime: null,
      tomatoNumber: 0,
      usedTomatoes: [],
      maxMinute: TOMATO_TIME,
      TotalTomatoes: {},
      currentItemSyncKey: null,
      todoList: {},
      test:false,
    };
  },
  components: {
    swiper,
    swiperSlide,
    CircleGroup,
    DigitalClock,
    THeader,
    TFooter
  },
  mounted() {
    this.getItemList();
    const that = this;
    window.test = this.opanTest;
    setInterval(function() {
      if (that.pause) {
        if (!that.breaktime) {
          return;
        }
        let time = (that.breaktime - new Date()) / 1000;

        if (time < 0) {
          that.onAction();
          return;
        }
        let second = parseInt(time % 60); //获取当前秒数(0-59)
        time /= 60;
        let minute = parseInt(time % 60); //获取当前分钟数(0-59)
        time /= 60;
        let hour = parseInt(time); //获取当前小时数(0-23)
        that.setTimeDigitalArr(hour, minute, second);
        that.setTimeUnitArr(hour, minute, second);
      } else {
        if (!that.finishTime) {
          return;
        }
        let time = (that.finishTime - new Date()) / 1000;
        if (time < 0) {
          that.onNext();
          return;
        }

        let second = parseInt(time % 60); //获取当前秒数(0-59)
        time /= 60;
        let minute = parseInt(time % 60); //获取当前分钟数(0-59)
        time /= 60;
        let hour = parseInt(time); //获取当前小时数(0-23)
        that.setTimeDigitalArr(hour, minute, second);
        that.setTimeUnitArr(hour, minute, second);
      }
    }, 1000);
  },
  methods: {
    onStop() {
      this.setTimeDigitalArr(0, 0, 0);
      this.setTimeUnitArr(0, 0, 0);
      this.finishTime = null;
      this.breaktime = null;
      this.pause = true;
      this.usedTomatoes = [];
    },
    onAction() {
      this.timeUnitArr.second = 60;
      this.timeUnitArr.minute = TOMATO_TIME;
      this.maxMinute = TOMATO_TIME;
      this.finishTime = new Date(
        new Date().getTime() + TOMATO_TIME * 60 * 1000
      );
      this.pause = false;
      this.breaktime = null;
      this.usedTomatoes = [];
      if (this.currentItemSyncKey) {
      }
    },
    onParse() {
      this.timeUnitArr.second = 60;
      this.timeUnitArr.minute = REST_TIME;
      this.maxMinute = REST_TIME;
      this.pause = true;
      this.breaktime = new Date(new Date().getTime() + REST_TIME * 60 * 1000);
      this.usedTomatoes = [];
    },
    onNext() {
      if (this.pause) {
        return;
      }
      let cisk = this.currentItemSyncKey;
      if (cisk) {
        let tomatoes = {};
        let lastItemTime = TOMATO_TIME * 60;
        this.usedTomatoes.forEach(({ item_sync_key, used_time }) => {
          if (tomatoes[item_sync_key]) {
            tomatoes[item_sync_key] += used_time;
          } else {
            tomatoes[item_sync_key] = used_time;
          }
          lastItemTime -= used_time;
        });
        if (tomatoes[cisk]) {
          tomatoes[cisk] += lastItemTime;
        } else {
          tomatoes[cisk] = lastItemTime;
        }
        let requestData = {
          tomatoes: JSON.stringify(tomatoes),
          ...this.$store.getters.tokenInfo
        };
        this.$startRequest(
          "/item/recordTomatoes",
          requestData,
          res => {
            this.todoList = res.data;
          },
          error => {
            if (error.msg) {
              this.$vux.toast.text(error.msg, "top");
            } else {
              this.$vux.toast.text("网络错误", "top");
            }
          }
        );
      }
      this.tomatoNumber = this.tomatoNumber + 1;
      this.onParse();
    },
    goback() {
      this.$router.back();
    },
    activeItem(syncKey) {
      let cisk = this.currentItemSyncKey;
      if (!this.finishTime) {
        return;
      }
      let usedTime = TOMATO_TIME * 60;
      let remainingTime = parseInt((this.finishTime - new Date()) / 1000);
      this.usedTomatoes.forEach(tomato => {
        usedTime -= tomato.used_time;
      });
      let currentItemUsedTime = usedTime - remainingTime;
      if (currentItemUsedTime > 0) {
        this.usedTomatoes.push({
          used_time: currentItemUsedTime,
          item_sync_key: cisk
        });
      }

      this.currentItemSyncKey = syncKey;
    },
    setTimeDigitalArr(hour, minute, second) {
      let column1 = parseInt(hour / 10);
      let column2 = hour % 10;
      let column3 = parseInt(minute / 10);
      let column4 = minute % 10;
      let column5 = parseInt(second / 10);
      let column6 = second % 10;
      this.timeDigitalArr = {
        column1,
        column2,
        column3,
        column4,
        column5,
        column6
      };
    },
    setTimeUnitArr(hour, minute, second) {
      this.timeUnitArr = {
        hour,
        minute,
        second
      };
    },
    getItemList() {
      let requestData = this.$store.getters.tokenInfo;
      this.$startRequest(
        "/item/getTodoList",
        requestData,
        res => {
          this.todoList = res.data;
          let first = _.map(res.data, item => item)[0];
          if (first) {
            this.currentItemSyncKey = first.item_sync_key;
          }
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
    opanTest(){
      this.test = true;
    }
  },
  computed: {
    tomatoTodoList() {
      return _.map(this.todoList, item => item).filter(
        item => item.item_sync_key != this.currentItemSyncKey
      );
    },
  }
};
</script>

<style scoped lang="less">
.page {
  background: #343434;
  .content {
    padding: 40px 0 80px;

    .DigitalClock {
      color: #fff;
    }

    .CircleGroup {
      width: 60%;
      margin: 50px auto;
      .tomatoCounter {
        margin-top: 20px;
        .tomato {
          width: 25px;
          display: inline-block;
          vertical-align: middle;
        }
        .text {
          margin-left: 5px;
          display: inline-block;
          vertical-align: middle;
        }
      }
    }

    .doing,
    .todo {
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;

      .plan {
        text-align: center;
        padding: 10px 0 3px;
        width: 60%;
        border-bottom: 1px dashed rgb(255, 255, 255);

        .r {
          padding: 0;
        }

        .c {
          text-align: center;

          .name-line {
            font-size: 18px;
            display: inline-block;
          }

          .level-line,
          .category-line {
            font-size: 16px;
            line-height: 1.1;
            color: rgba(52, 52, 52, 0.6);
          }
        }
      }
    }

    .todo {
      padding-top: 50px;
      .plan {
        opacity: 0.6;
      }
    }
  }
}
</style>
