<template>
  <div id="DigitalClock">
    <div class="column" :class="'column-' + column1">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
    </div>
    <div class="column" :class="'column-' + column2">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
      <div class="num num-3">3</div>
      <div class="num num-4">4</div>
      <div class="num num-5">5</div>
      <div class="num num-6">6</div>
      <div class="num num-7">7</div>
      <div class="num num-8">8</div>
      <div class="num num-9">9</div>
    </div>
    <div class="colon">:</div>
    <div class="column" :class="'column-' + column3">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
      <div class="num num-3">3</div>
      <div class="num num-4">4</div>
      <div class="num num-5">5</div>
    </div>
    <div class="column" :class="'column-' + column4">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
      <div class="num num-3">3</div>
      <div class="num num-4">4</div>
      <div class="num num-5">5</div>
      <div class="num num-6">6</div>
      <div class="num num-7">7</div>
      <div class="num num-8">8</div>
      <div class="num num-9">9</div>
    </div>
    <div class="colon">:</div>
    <div class="column" :class="'column-' + column5">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
      <div class="num num-3">3</div>
      <div class="num num-4">4</div>
      <div class="num num-5">5</div>
    </div>
    <div class="column" :class="'column-' + column6">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
      <div class="num num-3">3</div>
      <div class="num num-4">4</div>
      <div class="num num-5">5</div>
      <div class="num num-6">6</div>
      <div class="num num-7">7</div>
      <div class="num num-8">8</div>
      <div class="num num-9">9</div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'DigitalClock',
    data() {
      return {
        column1: 0,
        column2: 0,
        column3: 0,
        column4: 0,
        column5: 0,
        column6: 0,
      }
    },
    mounted() {
      const that = this;
      setInterval(function () {
        let time = new Date();
        let Hour = time.getHours(); //获取当前小时数(0-23)
        let Minute = time.getMinutes(); //获取当前分钟数(0-59)
        let Second = time.getSeconds(); //获取当前秒数(0-59)
        that.column1 = parseInt(Hour / 10);
        that.column2 = Hour % 10;
        that.column3 = parseInt(Minute / 10);
        that.column4 = Minute % 10;
        that.column5 = parseInt(Second / 10);
        that.column6 = Second % 10;
      }, 1000)
    },
  }

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang='less'>
  #DigitalClock {
    text-align: center;
    // background-color: #0e141b;
    // color: rgba(224, 230, 235, 0.89);
    font-family: 'Roboto Condensed', sans-serif;
    font-weight: 300;
    overflow: hidden;
    vertical-align: top;
    width: 100%;
    line-height: 1;
    height: 40px;
    font-size: 0;

    .colon {
      vertical-align: top;
      font-size: 40px;
    }

    .column,
    .colon {
      display: inline-block;
      vertical-align: top;
      -webkit-transition: -webkit-transform 800ms;
      transition: -webkit-transform 800ms;
      transition: transform 800ms;
      transition: transform 800ms, -webkit-transform 800ms;
    }

    .column {
      .num {
        height: 40px;
        font-size: 40px;
        -webkit-transition: opacity 1000ms, text-shadow 1000ms;
        transition: opacity 1000ms, text-shadow 1000ms;
        opacity: 0;
      }
    }

    .columns(@counter) when (@counter >=0) {
      .columns((@counter - 1)); // next iteration

      .column-@{counter} {
        transform: translateY(@counter * -40px);

        .num-@{counter} {
          opacity: 1.0;
          text-shadow: 1px 1px 0px #336699;
        }
      }
    }

    .columns(9); // launch the loop
  }

</style>
