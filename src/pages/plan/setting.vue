<template>
  <div class="page">

    <div class="form">
      <div class="form-item">
        <div class="label">重要程度</div>
        <div class="input">
          <Label v-bind:active="isImportanceLevelActive" textActive="重要" text="不重要" backgroundActive='#ff3333'
            @on-active="bindImportanceLevelActive"></Label>
        </div>
      </div>
      <div class="form-item">
        <div class="label">紧急程度</div>
        <div class="input">
          <Label v-bind:active="isEmergencyLevelActive" textActive="紧急" @on-active="bindEmergencyLevelActive"></Label>
        </div>
      </div>
      <div class="form-item">
        <div class="label">事务类别</div>
        <div class="input" @click="showPopupPicker=!showPopupPicker">
          <i class="fa fa-check-square-o" aria-hidden="true">
          </i>
          {{value1[0]}}
        </div>
      </div>
    </div>
    <section class="bottom flex-box">
      <div class="l" @click="goback">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <div  class="text">返回</div>
      </div>
      <div class="c">
      </div>
      <div class="r">
        <div class="text">完成</div>
        <i class="fa fa-check" aria-hidden="true"></i>
      </div>
    </section>

    <group>
      <popup-picker :show.sync="showPopupPicker" :show-cell="false" :data="list1" v-model="value1">
      </popup-picker>
    </group>
  </div>
</template>
<script>
  import {
    Picker
  } from 'vux'
  import {
    PopupPicker,
    Group
  } from 'vux'
  import Label from '@/components/common/Label.vue'
  export default {
    name: 'HelloWorld',
    data() {
      return {
        isImportanceLevelActive: true,
        isEmergencyLevelActive: true,
        list1: [
          ['111', '222', '333']
        ],
        value1: ['事务类别'],
        showPopupPicker: false,
      }
    },
    components: {
      Label,
      PopupPicker,
      Group
    },
    mounted() {

    },

    methods: {
      goback(){
      this.$router.back()
      },
      bindImportanceLevelActive() {
        this.isImportanceLevelActive = !this.isImportanceLevelActive;
      },
      bindEmergencyLevelActive() {
        this.isEmergencyLevelActive = !this.isEmergencyLevelActive;
      },
    },
  }

</script>

<style lang='less' scoped>
  .page {
    background: #343434;

    .form {
      padding: 40px 0;
      width: 100%;

      .form-item {
        padding: 20px 20px;
        display: flex;
        justify-content: center;
        width: 90%;
        margin: auto;

        .label,
        .input {
          display: inline-block;
          color: #fff;
          font-size: 20px;
        }

        .label {
          flex: none;

          &::after {
            content: '：'
          }
        }

        .input {
          flex: auto;
          text-align: center;
          vertical-align: middle;

          i {
            vertical-align: middle;
          }

          .text {
            max-width: 100px;
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            vertical-align: middle;
          }
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
