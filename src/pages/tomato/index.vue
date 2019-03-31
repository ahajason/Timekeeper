  <template>
  <CircleGroup class="CircleGroup" v-bind="timeUnitArr">
    <DigitalClock class="DigitalClock" v-bind="timeDigitalArr"></DigitalClock>
    11
  </CircleGroup>


  </template>
  <script>
 import CircleGroup from '@/components/common/CircleGroup';
    import DigitalClock from '@/components/common/DigitalClock';
    export default {
      name: 'tomato',
      data() {
        return {
          timeDigitalArr: {

          },
          timeUnitArr: {
            hour: 0,
            minute: 0,
            second: 50,
          },
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
    .DigitalClock {
      color: #fff;
    }
    .CircleGroup{
      width: 60vw;
      margin: 50px auto;
    }

  </style>
