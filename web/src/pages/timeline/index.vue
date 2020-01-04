<template>
  <div class="page">
    <div class="list">
      <div :key="year" v-for="(yearList, year) in timeLine">
        <div :key="day" v-for="(dayList, day) in yearList">
          <div class="day">{{ day }}</div>
          <div :key="time" v-for="(key, time) in dayList">
            <div class="item flex-box">
              <div class="time">{{ time }}</div>
              <div class="dialog">
                <div class="line"></div>
                <div class="icon">
                  <i
                      :class="itemList[key].category.icon.icon_src"
                      aria-hidden="true"
                  ></i>
                </div>
                <div class="triangle"></div>
                <div class="box">
                  <div @click="goDetails(key)" class="name">{{ itemList[key].item_name }}</div>
                  <div class="content" v-if="itemList[key].item_description">
                    {{ itemList[key].item_description }}
                  </div>
                </div>
              </div>
              <!-- dialog -->
            </div>
            <!-- item -->
          </div>
          <!-- time -->
        </div>
        <!-- month + day -->
        <div class="year">{{ year }} 年</div>
      </div>
      <!-- year -->
    </div>
  </div>
</template>
<script>
  export default {
    name: "timeline",
    components: {},
    data() {
      return {
        timeLine: {},
        itemList: {}
      };
    },
    mounted() {
      this.getTimeLine();
    },
    methods: {
      goDetails(index) {
        this.$router.push({
          name: "itemDetails",
          params: {
            syncKey: index
          }
        });
      },
      getTimeLine() {
        let requestData = this.$store.getters.tokenInfo;
        this.$startRequest(
          "/item/getTimeLine",
          requestData,
          res => {
            this.timeLine = res.data.timeLine;
            this.itemList = res.data.itemList;
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
    }
  };
</script>

<style lang="less" scoped>
  .list {
    color: @white;
    padding: 0 0 100px;

    .item {
      align-items: flex-start;
      padding: 10px 10px;

      .time {
        flex: 0 0 auto;
        font-size: 14px;
        line-height: 30px;
        padding: 3px 10px 0 0;
      }

      .dialog {
        position: relative;
        flex: 1 1 auto;

        .line {
          position: absolute;
          content: "";
          top: -100px;
          left: 15px;
          bottom: -100px;
          width: 4px;
          background: @white;
        }

        .icon {
          position: absolute;
          top: 3px;
          left: 0;
          width: 35px;
          height: 35px;
          line-height: 35px;
          display: table;
          background: #4026b4;
          border: 3px solid @white;
          border-radius: 50%;
          z-index: 1;

          i {
            font-size: 16px;
            vertical-align: middle;
            text-align: center;
            display: table-cell;
          }
        }

        .triangle {
          position: absolute;
          content: "";
          width: 0;
          height: 0;
          border-width: 15px 20px 20px 0;
          border-style: solid;
          border-color: transparent #f5f5f5 transparent transparent;
          top: 4px;
          left: 40px;
        }

        .box {
          padding: 10px;
          margin-left: 50px;
          color: @dark-gray;
          background: #f5f5f5;
          border-radius: 6px;

          .name {
            color: @black;
            font-weight: bold;
          }

          .content {
            margin-top: 10px;
          }
        }
      }
    }

    .day,
    .year {
      padding: 10px 10px 0;
    }

    .year {
      border-bottom: 2px solid @white;
    }
  }
</style>
