<template>
  <div class="page">
    <THeader>
      <div slot="l" @click="goback">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <div class="text">返回</div>
      </div>
      <div slot="c">设置事项</div>
      <div slot="r">
        <div class="text" @click="createItem">完成</div>
        <i class="fa fa-check" aria-hidden="true"></i>
      </div>
    </THeader>
    <div class="form">
      <div class="form-item">
        <div class="label">重要程度</div>
        <div class="input">
          <Label
            v-bind:active="isImportanceLevelActive"
            textActive="重要"
            text="不重要"
            backgroundActive="#ff3333"
            @on-active="bindImportanceLevelActive"
          ></Label>
        </div>
      </div>
      <div class="form-item">
        <div class="label">紧急程度</div>
        <div class="input">
          <Label
            v-bind:active="isEmergencyLevelActive"
            textActive="紧急"
            @on-active="bindEmergencyLevelActive"
          ></Label>
        </div>
      </div>
      <div class="form-item">
        <div class="label">事务类别</div>
        <div class="category input" @click="showPopupPicker = !showPopupPicker">
          #
          {{
            categoryMap[picked[0]]
              ? categoryMap[picked[0]].category_name
              : "默认"
          }}
          <Glowing
            v-if="categoryMap[picked[0]]"
            color="#fff"
            :textShadow="categoryMap[picked[0]].category_color"
          >
            <i :class="categoryMap[picked[0]].icon.icon_src"></i>
          </Glowing>
        </div>
      </div>
    </div>
    <group>
      <popup-picker
        :show.sync="showPopupPicker"
        :show-cell="false"
        :data="[categoryPickerList]"
        v-model="picked"
      >
      </popup-picker>
    </group>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { Picker, PopupPicker, Group } from "vux";
import THeader from "../../components/THeader";
import Label from "@/components/common/Label.vue";
import Glowing from "../../components/common/Glowing.vue";
export default {
  name: "Setting",
  data() {
    return {
      showPopupPicker: false
    };
  },
  components: {
    THeader,
    Label,
    PopupPicker,
    Group,
    Glowing
  },
  mounted() {
    this.getCategoryList();
    if (!this.editingItem.item_sync_key) {
      this.$router.push({
        name: "createItem"
      });
    }
  },
  computed: {
    isImportanceLevelActive: {
      get() {
        return this.editingItem.item_importance_level >= 5;
      },
      set(value) {
        this.$store.commit("updateEditingItem", {
          key: "item_importance_level",
          value: value ? 7 : 2
        });
      }
    },
    picked: {
      get() {
        return [this.editingItem.category_id];
      },
      set(value) {
        this.$store.commit("updateEditingItem", {
          key: "category_id",
          value: value[0]
        });
      }
    },
    isEmergencyLevelActive: {
      get() {
        return this.editingItem.item_emergency_level >= 5;
      },
      set(value) {
        this.$store.commit("updateEditingItem", {
          key: "item_emergency_level",
          value: value ? 7 : 2
        });
      }
    },

    ...mapGetters([
      "editingItem",
      "categoryPickerList",
      "categoryMap",
      "tokenInfo"
    ])
  },
  methods: {
    createItem() {
      if (!this.editingItem.item_name) {
        this.$vux.toast.text("请填写事项名称", "top");
        return;
      }
      this.$store.commit("generateItemSyncKey");
      let requestData = { ...this.tokenInfo, ...this.editingItem };
      this.$startRequest(
        "/item/createItem",
        requestData,
        res => {
          this.$store.commit("addItemList", res.data);
          this.$store.commit("InitEditingItem");
          this.$vux.toast.text("创建成功", "top");
          this.$router.replace({
            name: "home"
          });
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
    goback() {
      this.$router.back();
    },
    bindImportanceLevelActive() {
      this.isImportanceLevelActive = !this.isImportanceLevelActive;
    },
    bindEmergencyLevelActive() {
      this.isEmergencyLevelActive = !this.isEmergencyLevelActive;
    }
  }
};
</script>

<style lang="less" scoped>
.page {
  background: #343434;
  color: #fff;

  .form {
    padding: 80px 0;
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
          content: "：";
        }
      }
      .category {
        font-style: italic;
        opacity: 0.8;
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
