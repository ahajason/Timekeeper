<template>
  <div class="from-item">
    <div v-if="!inline" class="label" v-text="label"></div>
    <div class="input">
      <slot></slot>
    </div>
  </div>
</template>
<script>
  export default {
    name: "Cell",
    data() {
      return {};
    },
    props: {
      label: {
        type: String,
        default: ""
      },
      inline: {
        type: Boolean,
        default: false
      }
    },
    methods: {}
  };
</script>

<style scoped lang="less">
  .from-item {
    padding: 10px 20px;
    display: flex;
    justify-content: center;

    .label {
      flex: 0 0 120px;
      display: flex;
      color: #fff;
      font-size: inherit;
    }

    .input {
      color: #fff;
      flex: 1 1 auto;
      justify-content: center;
      align-items: center;
      font-size: inherit;

      text-align: center;
      display: flex;

      input {
        text-align: center;
      }

      div,
      input,
      button,
      textarea {
        width: 100%;
        font-size: inherit;
        color: #fff;
        background: none;
        font-family: inherit;

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

      i {
        margin: 0 5px;
      }

      .text {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
      }
    }
  }
</style>
