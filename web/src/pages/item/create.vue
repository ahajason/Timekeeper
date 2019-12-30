<template>
  <div class="page">
    <THeader>
      <div slot="l" @click="goback">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <div class="text">返回</div>
      </div>
      <div slot="c">创建事项</div>
      <div slot="r">
        <div class="text" @click="createItem">完成</div>
        <i class="fa fa-check" aria-hidden="true"></i>
      </div>
    </THeader>
    <TFooter>
      <div slot="c">
        <input
          type="text"
          ref="input-name"
          placeholder="请输入计划名称…"
          v-model="editingItem.item_name"
        />
      </div>
      <div slot="r">
        <div class="text" @click="goSetting">设置</div>
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </div>
    </TFooter>
  </div>
</template>
<script>
import THeader from "../../components/THeader";
import TFooter from "../../components/TFooter";
import { mapGetters } from "vuex";
export default {
  name: "HelloWorld",
  data() {
    return {
      msg: "Welcome to Your Vue.js App"
    };
  },
  computed: {
    ...mapGetters(["editingItem","tokenInfo"])
  },
  components: {
    THeader,
    TFooter
  },
  mounted() {
    this.$refs["input-name"].focus();
  },
  methods: {
    createItem() {
      if(!this.editingItem.item_name){
        this.$vux.toast.text('请填写事项名称', "top");
        return;
      }
      this.$store.commit("generateItemSyncKey");
      let requestData = {...this.tokenInfo,...this.editingItem}
      this.$startRequest(
        "/item/createItem",
        requestData,
        res => {
          this.$store.commit("addItemList", res.data);
          this.$store.commit("InitEditingItem");
          this.$vux.toast.text('创建成功', "top");
          this.$router.replace({
            name:'home'
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
    goback() {
      this.$router.back();
    },
    goSetting() {
      if(!this.editingItem.item_name){
        this.$vux.toast.text('请填写事项名称', "top");
        return;
      }
      this.$store.commit("generateItemSyncKey");
      this.$store.commit("setEditingItem", this.editingItem);
      this.$router.push({
        name:'settingItem',
      });
    }
  }
};
</script>

<style lang="less" scoped>
.page {
  background: #343434;
  color: #fff;
  .top {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    display: flex;
    color: #fff;
    border-bottom: 1px solid rgba(255, 255, 255);
    justify-content: space-between;
    .l,
    .r {
      padding: 10px;
      font-size: 30px;
    }
  }
  .bottom {
    .l,
    .r {
      padding: 10px;
      font-size: 30px;
    }
  }
}
</style>
