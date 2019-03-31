<template>
  <div class="wrapper">
    <div class="Label" :class="size" v-text="active?textActive:text" :style="active?labelActiveStyle:labelStyle">
    </div>
  </div>


</template>
<script>
  export default {
    name: 'Label',
    data() {
      return {
        labelStyle: {
          color: this.color,
          background: this.background,
        },
        labelActiveStyle: {
          color: this.colorActive,
          background: this.backgroundActive,
        }
      };
    },
    props: {
      active: {
        type: Boolean,
        default: false,
      },
      color: {
        type: String,
        default: '#343434',
      },
      colorActive: {
        type: String,
        default: '#343434',
      },
      background: {
        type: String,
        default: "#b3b3b3",
      },
      backgroundActive: {
        type: String,
        default: "#ffff33",
      },
      text: {
        type: String,
        default: '不紧急',
      },
      textActive: {
        type: String,
        default: '紧急',
      },
      size: {
        type: String,
        default: 'md',
        validator: function (value) {
          return ['lg', 'md', 'sm', 'xm'].indexOf(value) !== -1
        }
      },
    },
    mounted() {},
    filters: {
      columnClass: (column) => 'column-' + column
    }
  }

</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped lang='less'>
  .wrapper {
    display: inline-block;
  }

  .Label {
    display: inline-block;
    font-family: 'STHupo', 'STXingkai', 'STLiti', 'STXinwei', "仿宋", "FangSong", "FZFangSong", "楷书", sans-serif;
    text-align: center;
    vertical-align: middle;
    transform: rotate(-20deg)
  }

  .Label.lg {
    padding: 0 6px;
    margin: 10px 0;
    line-height: 20px;
    border-radius: 20px;
  }

  .Label.md {
    padding: 0 6px;
    margin: 10px 0;
    line-height: 20px;
    border-radius: 20px;
    font-size: 18px;
  }

  .Label.sm {
    padding: 0 4px;
    margin: 5px 0;
    line-height: 15px;
    border-radius: 15px;
    font-size: 14px;
  }

</style>
