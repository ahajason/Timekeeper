<template>
  <div class="list">
    <div  v-for="(yearList, year) in timeLine" :key="year">
      
      <div class="time">{{ year }} 年</div>
      <div v-for="(monthList, month) in yearList" :key="month">
        
        <div class="time">{{ month }} 月</div>
        <div v-for="(dayList, day) in monthList" :key="day">
          
          <div class="time">{{ day }} 日</div>
          <div v-for="(timeList, time) in dayList" :key="time">
            <div class="item flex-box">
              <div class="time">{{ time }}</div>
              <div class="dialog">
                <div class="line"></div>
                <div class="icon">
                  <i class="fa fa-address-book" aria-hidden="true"></i>
                </div>
                <div class="triangle"></div>
                <div class="box">
                  <div class="name">我是中文乱码熬枯受淡</div>
                  <div class="content">
                    我是中文乱码熬枯受淡就卡到卡上打瞌睡的教科书的哈卡收到货拉三等奖安徽的卡是极好的开始接电话
                  </div>
                </div>
              </div>
              <!-- dialog -->
            </div>
            <!-- item -->
          </div>
          <!-- time -->

        </div>
        <!-- day -->

      </div>
      <!-- month -->
    </div>
    <!-- year -->
  </div>
</template>
<script>
import { dateFormat } from "vux";
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
    time() {
      return dateFormat(new Date(), "MM/DD HH:mm");
    },
    getTimeLine() {
      let requestData = this.$store.getters.tokenInfo;
      this.$startRequest(
        "/item/getTimeLine",
        requestData,
        res => {
          this.timeLine = res.data.timeLine;
          console.log(this.timeLine);
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

<style scoped lang="less">
.list {
  color: #fff;
  padding: 0 10px 100px;
  .item {
    align-items: flex-start;
    padding: 10px 0;

    .time {
      flex: 0 0 auto;
      font-size: 12px;
      line-height: 30px;
      padding: 3px 10px 0 0;
    }

    .dialog {
      position: relative;
      flex: 1 1 auto;

      .line {
        position: absolute;
        content: "";
        top: -10px;
        left: 15px;
        bottom: -100px;
        width: 4px;
        background: #fff;
      }

      .icon {
        position: absolute;
        top: 3px;
        left: 0;
        width: 35px;
        height: 35px;
        display: table;
        background: #4026b4;
        border: 3px solid #fff;
        border-radius: 50%;
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
        color: #343434;
        background: #f5f5f5;
        border-radius: 6px;
        .name {
          color: #000;
          margin-bottom: 10px;
          font-weight: bold;
        }
      }
    }
  }
}
</style>
