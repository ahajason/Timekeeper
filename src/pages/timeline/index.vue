<template>
  <ul class="list">
    <li class="item flex-box" v-for="(item, index) in [1,2,3,4,5,6,7,8,9,10,11]" :key="index">
      <div class="time">{{time()}}</div>
      <div class="dialog">
        <div class="line"></div>
        <div class="icon"><i class="fa fa-address-book" aria-hidden="true"></i></div>
        <div class="triangle"></div>
        <div class="box">
          <div class="name">我是中文乱码熬枯受淡</div>
          <div class="content">
            我是中文乱码熬枯受淡就卡到卡上打瞌睡的教科书的哈卡收到货拉三等奖安徽的卡是极好的开始接电话
          </div>
        </div>
      </div>
    </li>
  </ul>
</template>
<script>
  import {
    dateFormat
  } from 'vux'
  export default {
    name: 'timeline',
    components: {

    },
    data() {
      return {
        msg: 'Welcome to Your Vue.js App'
      }
    },
    methods: {
      time() {
        return dateFormat(new Date(), 'MM/DD HH:mm')
      }
    }
  }

</script>

<style scoped lang='less'>
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
        padding: 3px 10px 0 0 ;
      }

      .dialog {
        position: relative;
        flex: 1 1 auto;

        .line {
          position: absolute;
          content: '';
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
          content: '';
          width: 0;
          height: 0;
          border-width: 15px 20px 20px 0;
          border-style: solid;
          border-color: transparent #F5F5F5 transparent transparent;
          top: 4px;
          left: 40px;
        }

        .box {
          padding: 10px;
          margin-left: 50px;
          color: #343434;
          background: #F5F5F5;
          border-radius: 6px;
          .name{
            color: #000;
            margin-bottom: 10px;
            font-weight: bold; 
          }
        }
      }
    }
  }

</style>
