<template>
  <div id="DigitalClock">
    <div v-if="hasHour" class="column" :class="column1 | columnClass">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
    </div>
    <div v-if="hasHour" class="column" :class="column2 | columnClass">
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
    <div v-if="hasHour" class="colon">:</div>
    <div class="column" :class="column3 | columnClass">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
      <div class="num num-3">3</div>
      <div class="num num-4">4</div>
      <div class="num num-5">5</div>
    </div>
    <div class="column" :class="column4 | columnClass">
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
    <div class="column" :class="column5 | columnClass">
      <div class="num num-0">0</div>
      <div class="num num-1">1</div>
      <div class="num num-2">2</div>
      <div class="num num-3">3</div>
      <div class="num num-4">4</div>
      <div class="num num-5">5</div>
    </div>
    <div class="column" :class="column6 | columnClass">
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
      return {};
    },
    props: {
      hasHour: {
        type: Boolean,
        default: true,
      },
      column1: {
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 2
        },
      },
      column2: {
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 9
        },
      },
      column3: {
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 5
        },
      },
      column4: {
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 9
        },
      },
      column5: {
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 5
        },
      },
      column6: {
        type: Number,
        default: 0,
        validator: function (value) {
          return value >= 0 && value <= 9
        },
      },
    },
    mounted() {
    },
    filters: {
      columnClass: (column) => 'column-' + column
    }
  }

</script>

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
