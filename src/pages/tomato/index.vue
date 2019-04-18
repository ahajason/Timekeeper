<template>
  <div class="page">
    <THeader style="border:none">
      <div slot="l" @click="goback">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <div class="text">返回</div>
      </div>
      <div slot="c"></div>
      <div class="r"></div>
    </THeader>
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
    <TFooter>
      <div slot="l">
        <i v-show="pause" class="fa fa-pause-circle-o" aria-hidden="true"></i>
        <div v-show="pause" class="text">休息</div>
        <i v-show="!pause" class="fa fa-play-circle-o" aria-hidden="true"></i>
        <div v-show="!pause" class="text">继续</div>
      </div>
      <div slot="c"></div>
      <div slot="r">
        <div class="text">结束</div>
        <i class="fa fa-stop-circle-o" aria-hidden="true"></i>
      </div>
    </TFooter>
  </div>
</template>
<script>
import THeader from "../../components/THeader";
import TFooter from "../../components/TFooter";
import CircleGroup from "@/components/common/CircleGroup";
import DigitalClock from "@/components/common/DigitalClock";
export default {
  name: "tomato",
  data() {
    return {
      pause: true,
      timeDigitalArr: {},
      timeUnitArr: {}
    };
  },
  components: {
    CircleGroup,
    DigitalClock,
    THeader,
    TFooter
  },
  mounted() {
    const that = this;
    setInterval(function() {
      let time = new Date();
      let hour = time.getHours(); //获取当前小时数(0-23)
      let minute = time.getMinutes(); //获取当前分钟数(0-59)
      let second = time.getSeconds(); //获取当前秒数(0-59)
      that.setTimeDigitalArr(hour, minute, second);
      that.setTimeUnitArr(hour, minute, second);
    }, 1000);
  },
  methods: {
    goback() {
      this.$router.back();
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
    }
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
