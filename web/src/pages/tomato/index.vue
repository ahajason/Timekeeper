<template>
  <div class="page">
    <THeader class="header" style="border:none">
      <div slot="l">
        <div @click="goback">
          <i aria-hidden="true" class="fa fa-angle-left"></i>
          <div class="text">返回</div>
        </div>
      </div>
      <div slot="c"></div>
      <div slot="r">
        <div @click="onNext" v-if="test">
          <i aria-hidden="true" class="fa fa-fast-forward"></i>
          <div class="text">快速完成</div>
        </div>
      </div>
    </THeader>
    <div class="container">
      <div class="tabbar">
        <div
            :class="swiper.realIndex == 0 ? 'active' : ''"
            @click="swiperTo('0')"
        >
          番茄钟
        </div>
        |
        <div
            :class="swiper.realIndex == 1 ? 'active' : ''"
            @click="swiperTo('1')"
        >
          计时模式
        </div>
        |
        <div
            :class="swiper.realIndex == 2 ? 'active' : ''"
            @click="swiperTo('2')"
        >
          倒计时
        </div>
      </div>
      <swiper ref="tswiper">
        <swiperSlide class="module" id="tomato">
          <div class="content">
            <CircleGroup
                :hasHour="false"
                :maxHour="10"
                anticlockwise
                class="CircleGroup"
                v-bind="timeUnitArr0"
                v-bind:maxMinute="tomatoMaxMinute"
            >
              <DigitalClock
                  :hasHour="false"
                  class="DigitalClock"
                  v-bind="timeDigitalArr0"
              ></DigitalClock>
              <div @click="onNext0" class="tomatoCounter">
                <img class="tomato" src="static/tomato.png"/>
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
                  :key="item.item_sync_key"
                  @click="activeItem(item.item_sync_key)"
                  class="plan flex-box"
                  v-for="item in tomatoTodoList"
              >
                <div class="c">
                  <i
                      :class="item.category.icon.icon_src"
                      aria-hidden="true"
                  ></i>
                  <div class="name-line">{{ item.item_name }}</div>
                </div>
                <div class="r">
                  <i aria-hidden="true" class="fa fa-angle-double-up"></i>
                </div>
              </div>
            </section>
          </div>
        </swiperSlide>
        <swiperSlide class="module" id="timer">
          <div class="content">
            <CircleGroup class="CircleGroup" v-bind="timeUnitArr1">
              <DigitalClock
                  class="DigitalClock"
                  v-bind="timeDigitalArr1"
              ></DigitalClock>
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
                  :key="item.item_sync_key"
                  @click="activeItem(item.item_sync_key)"
                  class="plan flex-box"
                  v-for="item in tomatoTodoList"
              >
                <div class="c">
                  <i
                      :class="item.category.icon.icon_src"
                      aria-hidden="true"
                  ></i>
                  <div class="name-line">{{ item.item_name }}</div>
                </div>
                <div class="r">
                  <i aria-hidden="true" class="fa fa-angle-double-up"></i>
                </div>
              </div>
            </section>
          </div>
        </swiperSlide>
        <swiperSlide class="module" id="countdown">
          <div class="content">
            <div class="clock-wrapper" v-if="countdownFinishTime">
              <CircleGroup
                  V-bind:hasHour="countdownHasHour"
                  class="CircleGroup"
                  v-bind="timeUnitArr2"
                  v-bind:maxHour="countdownMaxHour"
                  v-bind:maxMinute="countdownMaxMinute"
              >
                <DigitalClock
                    class="DigitalClock"
                    v-bind="timeDigitalArr2"
                ></DigitalClock>
              </CircleGroup>
              <section class="doing">
                <div class="plan flex-box" v-if="countdownSyncKey && todoList">
                  <div class="c">
                    <i
                        :class="todoList[countdownSyncKey].category.icon.icon_src"
                        aria-hidden="true"
                    ></i>
                    <div class="name-line">
                      {{ todoList[countdownSyncKey].item_name }}
                    </div>
                  </div>
                </div>
              </section>
              <section class="button-wrapper">
                <button @click="onParse2" v-if="!pause2">暂停</button>
                <button @click="onContinue2" v-if="pause2">继续</button>
                <button @click="onStop2">完成</button>
              </section>
            </div>

            <div class="setting-wrapper" v-if="!countdownFinishTime">
              <section class="input-wrapper">
                <span>倒计时</span
                ><input placeholder="25" v-model="countdownMaxTime"/><span
              >分钟</span
              >
              </section>
              <section class="button-wrapper">
                <button @click="onAction2">开始</button>
              </section>

              <section class="selectedTodo" v-if="todoList">
                <div
                    :key="item.item_sync_key"
                    @click="activeCountdownItem(item.item_sync_key)"
                    class="plan flex-box"
                    v-for="item in todoList"
                >
                  <div class="c">
                    <i
                        :class="item.category.icon.icon_src"
                        aria-hidden="true"
                    ></i>
                    <div class="name-line">{{ item.item_name }}</div>
                  </div>
                  <div class="r" v-if="item.item_sync_key == countdownSyncKey">
                    <i aria-hidden="true" class="fa fa-check"></i>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </swiperSlide>
      </swiper>
    </div>
    <TFooter v-if="swiper.realIndex == 0">
      <div slot="l">
        <div @click="onParse0" v-show="!pause0">
          <i aria-hidden="true" class="fa fa-coffee"></i>
          <div class="text">休息</div>
        </div>
        <div @click="onAction0" v-if="tomatoNumber" v-show="pause0">
          <i aria-hidden="true" class="fa fa-play-circle-o"></i>
          <div class="text">继续</div>
        </div>
        <div @click="onAction0" v-if="!tomatoNumber" v-show="pause0">
          <i aria-hidden="true" class="fa fa-play-circle-o"></i>
          <div class="text">开始</div>
        </div>
      </div>
      <div slot="c"></div>
      <div slot="r">
        <div @click="onStop0">
          <div class="text">结束</div>
          <i aria-hidden="true" class="fa fa-stop-circle-o"></i>
        </div>
      </div>
    </TFooter>
    <TFooter v-if="swiper.realIndex == 1">
      <div slot="l">
        <div @click="onParse1" v-show="!pause1">
          <i aria-hidden="true" class="fa fa-coffee"></i>
          <div class="text">暂停</div>
        </div>
        <div @click="onAction1" v-if="startTime" v-show="pause1">
          <i aria-hidden="true" class="fa fa-play-circle-o"></i>
          <div class="text">继续</div>
        </div>
        <div @click="onAction1" v-if="!startTime" v-show="pause1">
          <i aria-hidden="true" class="fa fa-play-circle-o"></i>
          <div class="text">开始</div>
        </div>
      </div>
      <div slot="c"></div>
      <div slot="r">
        <div @click="onStop1">
          <div class="text">结束</div>
          <i aria-hidden="true" class="fa fa-stop-circle-o"></i>
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
  import {swiper, swiperSlide} from "vue-awesome-swiper";
  import _ from "lodash";

  const TOMATO_TIME = 25;

  const REST_TIME = 5;

  export default {
    name: "tomato",
    data() {
      return {
        pause0: true,
        pause1: true,
        pause2: true,
        timeDigitalArr0: {},
        timeUnitArr0: {},
        timeDigitalArr1: {},
        timeUnitArr1: {},
        timeDigitalArr2: {},
        timeUnitArr2: {},
        swiper: {},
        test: false,
        todoList: {},

        currentItemSyncKey: null,
        //番茄钟变量
        finishTime: null,
        breaktime: null,
        tomatoNumber: 0,
        usedTomatoes: [],
        tomatoMaxMinute: TOMATO_TIME,
        TotalTomatoes: {},
        //计时模式
        startTime: null,
        usedTimer: [],
        pauseAt: null,
        pauseTime: 0,
        //倒计时
        countdownMaxTime: null,
        countdownFinishTime: null,
        countdownSyncKey: null,
        countdownPauseTime: 0,
        countdownpauseAt: null,
        countdownMaxMinute: 60,
        countdownMaxHour: 24,
        countdownHasHour: true,
        countdownStartedAt: 0
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
      this.swiper = this.$refs.tswiper.swiper;
      setInterval(function () {
        if (that.pause0) {
          if (that.breaktime) {
            let time = (that.breaktime - new Date()) / 1000;
            if (time < 0) {
              that.onAction0();
            } else {
              let second = parseInt(time % 60); //获取当前秒数(0-59)
              time /= 60;
              let minute = parseInt(time % 60); //获取当前分钟数(0-59)
              time /= 60;
              let hour = parseInt(time); //获取当前小时数(0-23)
              that.setTimeDigitalArr0(hour, minute, second);
              that.setTimeUnitArr0(hour, minute, second);
            }
          }
        } else {
          if (that.finishTime) {
            let time = (that.finishTime - new Date()) / 1000;
            if (time < 0) {
              that.onNext0();
            } else {
              let second = parseInt(time % 60); //获取当前秒数(0-59)
              time /= 60;
              let minute = parseInt(time % 60); //获取当前分钟数(0-59)
              time /= 60;
              let hour = parseInt(time); //获取当前小时数(0-23)
              that.setTimeDigitalArr0(hour, minute, second);
              that.setTimeUnitArr0(hour, minute, second);
            }
          }
        }
        if (!that.pause1) {
          if (that.startTime) {
            let time =
              parseInt((new Date() - that.startTime) / 1000) - that.pauseTime;

            let second = parseInt(time % 60); //获取当前秒数(0-59)
            time /= 60;
            let minute = parseInt(time % 60); //获取当前分钟数(0-59)
            time /= 60;
            let hour = parseInt(time); //获取当前小时数(0-23)
            that.setTimeDigitalArr1(hour, minute, second);
            that.setTimeUnitArr1(hour, minute, second);
          }
        }
        if (that.pause2) {
        } else {
          if (that.countdownFinishTime) {
            let time =
              parseInt((that.countdownFinishTime - new Date()) / 1000) +
              that.countdownPauseTime;
            if (time <= 0) {
              that.onStop2();
            } else {
              let second = parseInt(time % 60); //获取当前秒数(0-59)
              time /= 60;
              let minute = parseInt(time % 60); //获取当前分钟数(0-59)
              time /= 60;
              let hour = parseInt(time); //获取当前小时数(0-23)
              that.setTimeDigitalArr2(hour, minute, second);
              that.setTimeUnitArr2(hour, minute, second);
            }
          }
        }
      }, 1000);
    },
    methods: {
      swiperTo(index) {
        this.swiper.slideTo(index, 500, true);
      },
      onStop0() {
        this.setTimeDigitalArr0(0, 0, 0);
        this.setTimeUnitArr0(0, 0, 0);
        this.finishTime = null;
        this.breaktime = null;
        this.pause0 = true;
        this.usedTomatoes = [];
      },
      onAction0() {
        this.timeUnitArr0.second = 60;
        this.timeUnitArr0.minute = TOMATO_TIME;
        this.tomatoMaxMinute = TOMATO_TIME;
        this.finishTime = new Date(
          new Date().getTime() + TOMATO_TIME * 60 * 1000
        );
        this.pause0 = false;
        this.breaktime = null;
        this.usedTomatoes = [];
        if (this.currentItemSyncKey) {
        }
      },
      onParse0() {
        this.timeUnitArr0.second = 60;
        this.timeUnitArr0.minute = REST_TIME;
        this.tomatoMaxMinute = REST_TIME;
        this.pause0 = true;
        this.breaktime = new Date(new Date().getTime() + REST_TIME * 60 * 1000);
        this.usedTomatoes = [];
      },
      onNext0() {
        if (this.pause0) {
          return;
        }
        let cisk = this.currentItemSyncKey;
        if (cisk) {
          let tomatoes = {};
          let lastItemTime = TOMATO_TIME * 60;
          this.usedTomatoes.forEach(({item_sync_key, used_time}) => {
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
        this.onParse0();
      },
      onStop1() {
        let cisk = this.currentItemSyncKey;

        if (cisk) {
          //统计最后一次用时
          let usedTime = 0;
          this.usedTimer.forEach(tomato => {
            usedTime += tomato.used_time;
          });
          let totalTime = parseInt((new Date() - this.startTime) / 1000);
          let currentItemUsedTime = totalTime - usedTime - this.pauseTime;
          if (currentItemUsedTime > 0) {
            this.usedTimer.push({
              used_time: currentItemUsedTime,
              item_sync_key: cisk
            });
          }
          //统计每一项用时
          let tomatoes = {};
          this.usedTimer.forEach(({item_sync_key, used_time}) => {
            if (tomatoes[item_sync_key]) {
              tomatoes[item_sync_key] += used_time;
            } else {
              tomatoes[item_sync_key] = used_time;
            }
          });

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
        this.setTimeDigitalArr1(0, 0, 0);
        this.setTimeUnitArr1(0, 0, 0);
        this.pause1 = true;
        this.startTime = null;
        this.usedTimer = [];
        this.pauseAt = null;
        this.pauseTime = 0;
      },
      onAction1() {
        if (!this.startTime) {
          this.startTime = new Date();
        } else {
          this.pauseTime += parseInt((new Date() - this.pauseAt) / 1000);
        }

        this.pause1 = false;
      },
      onParse1() {
        this.pauseAt = new Date();
        this.pause1 = true;
      },
      onStop2() {
        let cdsk = this.countdownSyncKey;
        if (cdsk) {
          let finishTime = parseInt(
            this.countdownFinishTime / 1000 + this.countdownPauseTime
          );
          let effectiveTime =
            parseInt(new Date().getTime() / 1000) -
            this.countdownStartedAt +
            this.countdownPauseTime;
          //统计每一项用时
          let tomatoes = {};
          this.usedTimer.forEach(({item_sync_key, used_time}) => {
            if (tomatoes[item_sync_key]) {
              tomatoes[item_sync_key] += used_time;
            } else {
              tomatoes[item_sync_key] = used_time;
            }
          });

          let requestData = {
            item_sync_key: cdsk,
            item_forecast_time: this.countdownMaxTime,
            item_started_at: this.countdownStartedAt,
            item_closed_at: finishTime,
            effective_time: effectiveTime,
            ...this.$store.getters.tokenInfo
          };
          this.$startRequest(
            "/item/completeItemByCountdown",
            requestData,
            res => {
              this.todoList = res.data;
              let first = _.map(res.data, item => item)[0];
              if (first) {
                this.countdownSyncKey = first.item_sync_key;
                this.activeItem(first.item_sync_key);
              } else {
                this.countdownSyncKey = null;
                this.currentItemSyncKey = null;
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
        }

        this.setTimeDigitalArr2(0, 0, 0);
        this.setTimeUnitArr2(0, 0, 0);

        this.pause2 = true;
        this.countdownMaxTime = null;
        this.countdownFinishTime = null;
        this.countdownSyncKey = null;
        this.countdownStartedAt = 0;
        this.countdownPauseTime = 0;
        this.countdownpauseAt = null;
        this.countdownMaxMinute = 60;
        this.countdownMaxHour = 24;
        this.countdownHasHour = true;
      },
      onAction2() {
        let maxTime = parseInt(this.countdownMaxTime);

        if (!/^[1-9]\d*$/.test(maxTime)) {
          this.countdownMaxTime = '25';
          maxTime = parseInt(this.countdownMaxTime);
        }

        this.countdownMaxMinute = maxTime > 60 ? 60 : maxTime;
        this.countdownMaxHour = maxTime > 60 ? parseInt(maxTime / 60) : 1;
        this.countdownHasHour = maxTime > 60;
        this.timeUnitArr2.second = 60;
        this.timeUnitArr2.minute = this.countdownMaxMinute;
        this.timeUnitArr2.hour = this.countdownMaxHour;
        this.countdownStartedAt = parseInt(new Date().getTime() / 1000);
        this.countdownFinishTime = new Date(
          new Date().getTime() + maxTime * 60 * 1000
        );
        this.pause2 = false;
      },
      onParse2() {
        this.countdownPauseAt = new Date();
        this.pause2 = true;
      },
      onContinue2() {
        this.countdownPauseTime += parseInt(
          (new Date() - this.countdownPauseAt) / 1000
        );
        this.pause2 = false;
      },
      goback() {
        this.$router.back();
      },
      activeItem(syncKey) {
        let cisk = this.currentItemSyncKey;
        if (this.finishTime) {
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
        }
        if (this.startTime) {
          let usedTime = 0;
          this.usedTimer.forEach(tomato => {
            usedTime += tomato.used_time;
          });
          let totalTime =
            parseInt((new Date() - this.startTime) / 1000) - this.pauseTime;
          let currentItemUsedTime = totalTime - usedTime;
          if (currentItemUsedTime > 0) {
            this.usedTimer.push({
              used_time: currentItemUsedTime,
              item_sync_key: cisk
            });
          }
        }
        this.currentItemSyncKey = syncKey;
      },
      activeCountdownItem(syncKey) {
        this.countdownSyncKey = syncKey;
      },
      setTimeDigitalArr0(hour, minute, second) {
        let column1 = parseInt(hour / 10);
        let column2 = hour % 10;
        let column3 = parseInt(minute / 10);
        let column4 = minute % 10;
        let column5 = parseInt(second / 10);
        let column6 = second % 10;
        this.timeDigitalArr0 = {
          column1,
          column2,
          column3,
          column4,
          column5,
          column6
        };
      },
      setTimeUnitArr0(hour, minute, second) {
        this.timeUnitArr0 = {
          hour,
          minute,
          second
        };
      },
      setTimeDigitalArr1(hour, minute, second) {
        let column1 = parseInt(hour / 10);
        let column2 = hour % 10;
        let column3 = parseInt(minute / 10);
        let column4 = minute % 10;
        let column5 = parseInt(second / 10);
        let column6 = second % 10;
        this.timeDigitalArr1 = {
          column1,
          column2,
          column3,
          column4,
          column5,
          column6
        };
      },
      setTimeUnitArr1(hour, minute, second) {
        this.timeUnitArr1 = {
          hour,
          minute,
          second
        };
      },
      setTimeDigitalArr2(hour, minute, second) {
        let column1 = parseInt(hour / 10);
        let column2 = hour % 10;
        let column3 = parseInt(minute / 10);
        let column4 = minute % 10;
        let column5 = parseInt(second / 10);
        let column6 = second % 10;
        this.timeDigitalArr2 = {
          column1,
          column2,
          column3,
          column4,
          column5,
          column6
        };
      },
      setTimeUnitArr2(hour, minute, second) {
        this.timeUnitArr2 = {
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
              this.countdownSyncKey = first.item_sync_key;
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
      opanTest() {
        this.test = true;
      }
    },
    computed: {
      tomatoTodoList() {
        return _.map(this.todoList, item => item).filter(
          item => item.item_sync_key != this.currentItemSyncKey
        );
      }
    }
  };
</script>

<style lang="less" scoped>
  .page {
    background: #343434;

    .container {
      padding: 50px 0 80px;

      .tabbar {
        display: flex;
        justify-content: center;

        .active {
          text-shadow: 0 0 1px #f95428, 0 0 2px #f95428, 0 0 3px #f95428,
          0 0 4px #f95428, 0 0 5px #f95428, 0 0 6px #f95428;
        }
      }

      .content {
        .DigitalClock {
          color: #fff;
        }

        .CircleGroup {
          width: 60%;
          margin: 30px auto;

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

        .selectedTodo,
        .doing,
        .todo {
          color: #fff;
          display: flex;
          flex-direction: column;
          align-items: center;

          .plan {
            text-align: center;
            padding: 10px 0 3px;
            width: 70%;
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

        .selectedTodo {
          padding-top: 50px;
        }

        .button-wrapper {
          padding-top: 30px;
          width: 100%;
          font-size: 20px;
          text-align: center;

          button {
            display: inline-block;
            font-size: inherit;
            color: #fff;
            background: none;
            font-family: inherit;
            border: 1px solid #fff;
            text-align: right;
            padding: 6px 20px;
            border-radius: 50px;

            &::placeholder {
              font-family: inherit;
              color: rgba(255, 255, 255, 0.6);
            }

            &:focus {
              outline: none;
            }

            &:active {
              background: #444;
            }
          }
        }

        .input-wrapper {
          padding-top: 80px;
          width: 100%;
          font-size: 30px;
          text-align: center;

          input {
            display: inline-block;
            font-size: inherit;
            color: #fff;
            background: none;
            font-family: inherit;
            border-bottom: 2px solid #fff;
            text-align: center;
            width: 60px;

            &::placeholder {
              font-family: inherit;
              color: rgba(255, 255, 255, 0.6);
            }

            &:focus {
              outline: none;
            }

            &:active {
              background: #444;
            }
          }
        }
      }

      #countdown {
        .doing {
          .plan {
            border: none;
          }
        }
      }
    }
  }
</style>
