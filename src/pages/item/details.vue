<template>
  <div class="page">
    <THeader>
      <div slot="l" @click="goback">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <div class="text">返回</div>
      </div>
      <div slot="c">详情</div>
      <div slot="r">
        <div class="text" @click="updateItem">保存</div>
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
      </div>
    </THeader>
    <TGroup class="group">
      <Cell label="事项名称:" :inline="true">
        <input type="text" placeholder="事项名称" v-model="item.item_name" />
      </Cell>
      <Cell label="重要程度:">
        <Label
          v-bind:active="item.item_importance_level >= 5"
          textActive="重要"
          text="不重要"
          backgroundActive="#ff3333"
          @on-active="bindImportanceLevelActive"
        ></Label>
      </Cell>
      <Cell label="紧急程度:">
        <Label
          v-bind:active="item.item_emergency_level >= 5"
          textActive="紧急"
          @on-active="bindEmergencyLevelActive"
        ></Label>
      </Cell>
      <Cell label="预测用时:">
        <div class="forecast_time">
          <input
            type="text"
            placeholder="0"
            v-model="item.item_forecast_time"
          />
          <div class="unit">min</div>
        </div>
      </Cell>
      <Cell label="事务类别:">
        <div
          class="category input"
          @click="showPopupPicker = !showPopupPicker"
          v-if="categoryMap[item.category_id]"
        >
          #
          {{ categoryMap[item.category_id].category_name }}
          <i
            :class="categoryMap[item.category_id].icon.icon_src"
            aria-hidden="true"
          >
          </i>
        </div>
      </Cell>
      <Cell label="事项描述:">
        <textarea
          type="text"
          placeholder="输入对事项的详细描述"
          rows="4"
          v-model="item.item_description"
        />
      </Cell>
      <Cell label="开始时间:" v-if="item.item_started_at">
        <div class="time">{{ item.item_started_at }}</div>
      </Cell>
      <Cell label="结束时间:" v-if="item.item_closed_at">
        <div class="time">{{ item.item_closed_at }}</div>
      </Cell>
      <Cell label="状态:">
        <div class="text">
          {{ ["待办", "进行中", "已完成"][item.item_state] }}
        </div>
      </Cell>
      <Cell label="番茄钟数:">
        <div class="text">{{ item.item_tomatoes }}</div>
      </Cell>
      <Cell label="所属计划:" v-if="item.plan_id">
        <div class="text">{{ item.plan_id }}</div>
      </Cell>
      <Cell label="创建时间:">
        <div class="time">{{ item.item_created_at }}</div>
      </Cell>
      <Cell label="上次更新时间:">
        <div class="time">{{ item.item_updated_at }}</div>
      </Cell>
      <Cell :inline="true">
        <div>
          <button @click="restartItem" v-if="item.item_state == 2">
            <i class="fa fa-check-square-o" aria-hidden="true"></i>重启
          </button>
          <button @click="completeItem" v-if="item.item_state == 0">
            <i class="fa fa-square-o" aria-hidden="true"></i>结束
          </button>
        </div>
        <div>
          <button @click="confirmDeleteItem">
            <i class="fa fa-trash-o" aria-hidden="true"></i>删除
          </button>
        </div>
      </Cell>
    </TGroup>
    <group v-transfer-dom>
      <popup-picker
        :show.sync="showPopupPicker"
        :show-cell="false"
        :data="[categoryPickerList]"
        @on-change="onCategoryPickerChange"
        v-model="defaultPicked"
      >
      </popup-picker>
    </group>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { Picker, PopupPicker, Group, Range } from "vux";
import THeader from "../../components/THeader";
import Label from "@/components/common/Label";
import TGroup from "@/components/common/Group";
import Cell from "@/components/common/Cell";
import { TransferDom } from "vux";

export default {
  name: "HelloWorld",

  data() {
    return {
      showPopupPicker: false,
      item: {},
      defaultPicked: [1]
    };
  },
  components: {
    THeader,
    Label,
    PopupPicker,
    Group,
    TGroup,
    Cell,
    Range
  },
  mounted() {
    this.$vux.loading.show({
      text:''
    });
    this.getItem();
    this.getCategoryList();
  },
  computed: {
    ...mapGetters(["categoryPickerList", "categoryMap", "tokenInfo"])
  },
  methods: {
    getCategoryList() {
      let requestData = this.tokenInfo;
      this.$startRequest(
        "/category/getCategoryList",
        requestData,
        res => {
          this.$store.commit("setCategoryList", res.data);
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    getItem() {
      let item_sync_key = this.$route.params.syncKey;
      if (!item_sync_key) {
        this.$router.back();
      }
      let requestData = { item_sync_key, ...this.$store.getters.tokenInfo };
      this.$startRequest(
        "/item/getItem",
        requestData,
        res => {
          this.item = res.data;
          this.$vux.loading.hide();
        },
        error => {
          this.$vux.loading.hide();
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    updateItem() {
      let requestData = { ...this.item, ...this.$store.getters.tokenInfo };
      this.$startRequest(
        "/item/updateItem",
        requestData,
        res => {
          this.$vux.toast.text("保存成功", "top");
          this.$router.back();
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    goback() {
      this.$router.back();
    },
    bindImportanceLevelActive() {
      if (this.item.item_importance_level >= 5) {
        this.item.item_importance_level = 2;
      } else {
        this.item.item_importance_level = 7;
      }
    },
    bindEmergencyLevelActive() {
      if (this.item.item_emergency_level >= 5) {
        this.item.item_emergency_level = 2;
      } else {
        this.item.item_emergency_level = 7;
      }
    },
    onCategoryPickerChange(val) {
      this.item.category_id = val[0];
    },
    completeItem(item_sync_key) {
      let item = this.todayTodoList[item_sync_key];
      let requestData = { item_sync_key, ...this.$store.getters.tokenInfo };
      this.$startRequest(
        "/item/completeItem",
        requestData,
        res => {
          this.item = res.data;
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    confirmDeleteItem() {
      this.$vux.confirm.show({
        title: "确认删除",
        content: "确定要删除吗？删除就没啦~",
        onCancel: () => {},
        onConfirm: () => {
          this.deleteItem();
        }
      });
    },
    deleteItem() {
      let item_sync_key = this.item.item_sync_key;
      let requestData = { item_sync_key, ...this.$store.getters.tokenInfo };
      this.$startRequest(
        "/item/deleteItem",
        requestData,
        res => {
          this.$vux.toast.text("删除成功", "top");
          this.$router.back();
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    completeItem() {
      let item_sync_key = this.item.item_sync_key;
      let requestData = { item_sync_key, ...this.tokenInfo };
      this.$startRequest(
        "/item/completeItem",
        requestData,
        res => {
          this.item = res.data;
        },
        error => {
          if (error.msg) {
            this.$vux.toast.text(error.msg, "top");
          } else {
            this.$vux.toast.text("网络错误", "top");
          }
        }
      );
    },
    restartItem() {
      let item_sync_key = this.item.item_sync_key;
      let requestData = { item_sync_key, ...this.$store.getters.tokenInfo };
      this.$startRequest(
        "/item/restartItem",
        requestData,
        res => {
          this.item = res.data;
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
  },
  directives: {
    TransferDom
  }
};
</script>

<style lang="less" scoped>
.page {
  background: #343434;
  color: #fff;
  padding: 60px 0 0;
  .group {
    .forecast_time {
      justify-content: center;
      display: flex;
      input {
        text-align: right;
        width: 80px;
      }
      .unit {
        margin-left: 10px;
        text-align: left;
        width: 80px;
      }
    }
    .category {
      font-style: italic;
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
