  <template>
    <div class="page">
      <div class="content">
        <CircleGroup class="CircleGroup" v-bind="timeUnitArr">
          <DigitalClock class="DigitalClock" v-bind="timeDigitalArr"></DigitalClock>
        </CircleGroup>
        <section class="doing">
          <div class="plan flex-box">
            <div class="c">
              <div class="name-line">任务{{item}}</div>
            </div>
            <div class="r">
              <i class="fa fa-angle-double-down" aria-hidden="true"></i>
            </div>
          </div>
        </section>
        <section class="todo">
          <div class="plan flex-box" v-for="(item, index) in [1,2,3,4,5,6,7,8,9,10,11]" :key="index">
            <!-- <div class="l">
              <i v-if='true' class="fa fa-square-o" aria-hidden="true">
              </i>
              <i v-if='false' class="fa fa-check-square-o" aria-hidden="true">
              </i>
            </div> -->
            <div class="c">
              <div class="name-line">任务{{item}}</div>
            </div>
            <div class="r">
              <i class="fa fa-angle-double-up" aria-hidden="true"></i>
            </div>
          </div>
        </section>
      </div>
      <section class="bottom flex-box">
        <div class="l">
          <i v-show="pause" class="fa fa-pause-circle-o" aria-hidden="true"></i>
          <div v-show="pause" class="text">休息</div>
          <i v-show="!pause" class="fa fa-play-circle-o" aria-hidden="true"></i>
          <div v-show="!pause" class="text">继续</div>
        </div>
        <div class="c">
        </div>
        <div class="r">
          <div class="text">结束</div>
          <i class="fa fa-stop-circle-o" aria-hidden="true"></i>
        </div>
      </section>
    </div>
  </template>
  <script>
    import CircleGroup from '@/components/common/CircleGroup';
    import DigitalClock from '@/components/common/DigitalClock';
    export default {
      name: 'tomato',
      data() {
        return {
          pause: true,
          timeDigitalArr: {},
          timeUnitArr: {},
        }
      },
      components: {
        CircleGroup,
        DigitalClock
      },
      mounted() {
        const that = this;
        setInterval(function () {
          let time = new Date();
          let hour = time.getHours(); //获取当前小时数(0-23)
          let minute = time.getMinutes(); //获取当前分钟数(0-59)
          let second = time.getSeconds(); //获取当前秒数(0-59)
          that.setTimeDigitalArr(hour, minute, second);
          that.setTimeUnitArr(hour, minute, second);
        }, 1000)
      },
      methods: {
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
          }
        },
        setTimeUnitArr(hour, minute, second) {
          this.timeUnitArr = {
            hour,
            minute,
            second,
          }
        }
      },
    }

  </script>
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped lang='less'>
    .page {
      background: #343434;

      .content {
        padding-bottom: 100px;

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

      .bottom {
        position: fixed;
        bottom: 0;
        right: 0;
        left: 0;
        display: flex;
        color: #fff;
        // border-top: 1px dashed rgba(255, 255, 255, 0.2);
        box-shadow: 0px 0px 1px 1px rgba(255, 255, 255, 0.2);
        font-size: 18px;
        padding: 10px 20px;
        z-index: 100;
        background: #343434;

        .text {
          display: inline-block;
        }

        .l,
        .r {
          font-size: 20px;
        }
      }
    }

  </style>
