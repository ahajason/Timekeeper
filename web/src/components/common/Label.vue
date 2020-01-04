<template>
  <div
    class="wrapper"
    :class="size"
    @click="onClick"
  >
    <div
      class="Label"
      v-text="active?textActive:text"
      :style="active?labelActiveStyle:labelStyle"
    ></div>
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
        default: "#ccc",
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
    mounted() {
    },
    filters: {
      columnClass: (column) => 'column-' + column
    },
    methods: {
      onClick() {
        this.$emit('on-active')
      },
    }
  }

</script>

<style scoped lang='less'>
  .wrapper {
    display: inline-block;
    text-align: center;

    .Label {
      display: inline-block;
      font-family: "STHupo", "STXingkai", "STLiti", "STXinwei", "仿宋", "FangSong",
      "FZFangSong", "楷书", sans-serif;
      text-align: center;
      vertical-align: middle;
      transform: rotate(-15deg);
      transition: all 0.1s ease;
    }
  }

  .lg {
    width: 120px;

    .Label {
      padding: 0 6px;
      line-height: 20px;
      border-radius: 20px;
      font-size: 20px;
    }
  }

  .md {
    width: 80px;

    .Label {
      padding: 0 6px;
      line-height: 20px;
      border-radius: 20px;
      font-size: 18px;
    }
  }

  .sm {
    .Label {
      padding: 0 4px;
      line-height: 15px;
      border-radius: 15px;
      font-size: 14px;
      vertical-align: bottom;
      font-family: "STXingkai", "STLiti", "STXinwei", "仿宋", "FangSong",
      "FZFangSong", "楷书", sans-serif;
      transform: rotate(-10deg);
    }
  }
</style>
