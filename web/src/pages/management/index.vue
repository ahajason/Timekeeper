<template>
  <div class="page">
    <div class="top-panel">
      <div class="type">
        <ul>
          <li
            :class="swiper.realIndex == 0 ? 'active' : ''"
            @click="swiperTo('0')"
            class="item"
          >
            <i class="fa fa-tasks"/>
            <div class="text">事项</div>
          </li>
          <li
            :class="swiper.realIndex == 1 ? 'active' : ''"
            @click="swiperTo('1')"
            class="category"
          >
            <i class="fa fa-tags"/>
            <div class="text">类别</div>
          </li>
        </ul>
      </div>
    </div>

    <swiper ref="tswiper">
      <swiperSlide class="module" id="module1">
        <div class="panel">
          <div class="selector-group">
            <Selector
              :options="stateList"
              :selected="stateSelected"
              @on-select="bindStateSelect"
              label="状态："
              selectedColor="#33c"
            />
            <Selector
              :options="importanceLevelList"
              @on-select="bindImportanceLevelSelect"
              label="重要程度："
              selectedColor="#c33"
              v-bind:selected="importanceLevelSelected"
            />
            <Selector
              :options="emergencyLevelList"
              @on-select="bindEmergencyLevelSelect"
              label="紧急程度："
              selectedColor="#cc3"
              v-bind:selected="emergencyLevelSelected"
            />
          </div>
          <div class="folding-bar">
            <i aria-hidden="true" class="fa fa-angle-up r"> </i>
          </div>
        </div>
        <ul class="itemList">
          <li class="nofound" v-if="itemList.length == 0">
            没有找到符合条件的「事项」<br/>
            可通过「首页」或「右下角」的「创建」按钮添加更多「事项」
          </li>
          <li
            :key="index"
            @click="goDetails(index)"
            class="item"
            v-for="(item, index) in itemList"
          >
            <div class="name-line">
              <div @click="goDetails(index)" class="name">
                {{ item.item_name }}
              </div>
              <div class="text category-name">
                #{{ item.category.category_name }}
              </div>
            </div>
            <div class="level-line">
              <Label
                backgroundActive="#f66"
                size="sm"
                text="不重要"
                textActive="重要"
                v-bind:active="item.item_importance_level >= 5"
              />
              <Label
                backgroundActive="#ff6"
                size="sm"
                textActive="紧急"
                v-bind:active="item.item_emergency_level >= 5"
              />
            </div>
            <div class="level-line">
              <div class="text created-at">{{ item.item_created_at }} 创建</div>
            </div>
            <div class="level-line">
              <div class="text closed-at" v-if="item.item_closed_at">
                {{ item.item_closed_at }}
              </div>
              <Label
                background="#88eeee"
                backgroundActive="#68f"
                size="sm"
                text="已完成"
                textActive="待办"
                v-bind:active="item.item_state == 0"
              />
            </div>
          </li>
        </ul>
      </swiperSlide>
      <swiperSlide class="module" id="module3">
        <ul class="categoryList">
          <li
            :key="index"
            @click="editCategory(category)"
            class="item"
            v-for="(category, index) in categoryList"
          >
            <div class="name-line">
              <Glowing :textShadow="category.category_color" color="#fff">
                <i :class="category.icon.icon_src"></i>
              </Glowing>
              <div class="name">
                {{ category.category_name }}
              </div>
            </div>
            <div class="level-line"></div>
          </li>
        </ul>
      </swiperSlide>
    </swiper>
    <CircleMenu
      :number="2"
      animate="animated rubberBand"
      btn
      circle
      class="create-menu"
      mask="black"
      type="top"
    >
      <a class="fa fa-tags" slot="item_1">
        <div @click="createCategory" class="menu-letf">
          新建类别
        </div>
      </a>
      <a @click="goCreateItem" class="fa fa-tasks" slot="item_2">
        <div class="menu-letf">
          新建事项
        </div>
      </a>
    </CircleMenu>
    <div class="popup-warpper" v-transfer-dom>
      <popup class="popup" height="68%" v-model="categoryPanel">
        <div class="header">
          <div class="l">
            <div @click="hideCategoryPanel">
              <i aria-hidden="true" class="fa fa-times"></i>
              <div class="text">关闭</div>
            </div>
          </div>
          <div class="c">
            <div
              @click="confirmDeleteCategory"
              v-if="editingCategory.category_id"
            >
              <i aria-hidden="true" class="fa fa-trash"></i>
              <div class="text">删除</div>
            </div>
          </div>
          <div class="r">
            <div @click="saveCategory">
              <i aria-hidden="true" class="fa fa-floppy-o"></i>
              <div class="text">保存</div>
            </div>
          </div>
        </div>
        <Group>
          <Cell :inline="true">
            <input
              placeholder="输入类别名称"
              type="text"
              v-model="editingCategory.category_name"
            />
          </Cell>
          <Cell :inline="true">
            <Slider v-model="colors"></Slider>
          </Cell>
          <Cell :inline="true" v-if="editingCategory.icon">
            <div class="example-wrapper">
              <div class="example">
                <i :class="editingCategory.icon.icon_src"></i>
              </div>
              <div class="example">
                <Glowing
                  :textShadow="editingCategory.category_color"
                  color="#fff"
                >
                  <i :class="editingCategory.icon.icon_src"></i>
                </Glowing>
              </div>
              <div class="example">
                <div
                  :style="editingCategory.category_color | backgroundCss"
                  class="circle"
                >
                  <i :class="editingCategory.icon.icon_src"></i>
                </div>
              </div>
              <div class="example">
                <div class="color-text">
                  {{ editingCategory.category_color }}
                </div>
              </div>
            </div>
          </Cell>
          <Cell :inline="true">
            <div class="icon-box">
              <div
                :key="icon.icon_id"
                @click="setIconOfEditingCategory(icon)"
                class="icon-item"
                v-for="icon in iconList"
              >
                <i :class="icon.icon_src"></i>
              </div>
            </div>
          </Cell>
        </Group>
      </popup>
    </div>
  </div>
</template>
<script>
  import Selector from "@/components/common/Selector";
  import Label from "../../components/common/Label.vue";
  import Glowing from "../../components/common/Glowing.vue";
  import CircleMenu from "vue-circle-menu";
  import {swiper, swiperSlide} from "vue-awesome-swiper";
  import {Flexbox, FlexboxItem, Popup, TransferDom} from "vux";
  import Group from "@/components/common/Group";
  import Cell from "@/components/common/Cell";
  import {Slider} from "vue-color";

  export default {
    name: "management",
    components: {
      swiper,
      swiperSlide,
      Label,
      Selector,
      CircleMenu,
      Group,
      Popup,
      Flexbox,
      FlexboxItem,
      Cell,
      Slider,
      Glowing
    },
    data() {
      return {
        stateList: [
          {
            value: 0,
            name: "全部"
          },
          {
            value: 1,
            name: "待办"
          },
          {
            value: 2,
            name: "已完成"
          }
        ],
        stateSelected: {
          value: 0,
          name: "全部"
        },
        importanceLevelList: [
          {
            value: 0,
            name: "全部"
          },
          {
            value: 1,
            name: "重要"
          },
          {
            value: 2,
            name: "不重要"
          }
        ],
        importanceLevelSelected: {
          value: 0,
          name: "全部"
        },
        emergencyLevelList: [
          {
            value: 0,
            name: "全部"
          },
          {
            value: 1,
            name: "紧急"
          },
          {
            value: 2,
            name: "不紧急"
          }
        ],
        emergencyLevelSelected: {
          value: 0,
          name: "全部"
        },
        itemList: {},
        typeSwiperIndex: 0,
        swiper: {},
        categoryList: {},
        editingCategory: {
          category_name: "",
          category_color: "#888",
          icon: {
            icon_id: 1,
            icon_order: 1,
            icon_size: 100,
            icon_src: "fa fa-tag",
            icon_type: 1
          }
        },
        iconList: [],
        categoryPanel: false,
        colors: {
          hex: "#888"
        },
        disableSaveCategory: false
      };
    },
    watch: {
      colors: function (val) {
        this.editingCategory.category_color = val.hex;
      }
    },
    mounted() {
      this.getFilteredItems();
      this.getCategoryList();
      this.getIconList();
      this.swiper = this.$refs.tswiper.swiper;
    },
    filters: {
      colorsCss: color => "color:" + color,
      backgroundCss: background => " background:" + background
    },
    computed: {},
    methods: {
      goCreateItem() {
        this.$router.push({
          name: "createItem",
        });
      },
      swiperTo(index) {
        this.swiper.slideTo(index, 500, true);
      },
      goDetails(index) {
        this.$router.push({
          name: "itemDetails",
          params: {
            syncKey: index
          }
        });
      },
      bindStateSelect(item) {
        this.stateSelected = item;
        this.getFilteredItems();
      },
      bindImportanceLevelSelect(item) {
        this.importanceLevelSelected = item;

        this.getFilteredItems();
      },
      bindEmergencyLevelSelect(item) {
        this.emergencyLevelSelected = item;
        this.getFilteredItems();
      },
      getFilteredItems() {
        let requestData = {
          state: this.stateSelected.value,
          importance_level: this.importanceLevelSelected.value,
          emergency_level: this.emergencyLevelSelected.value,
          ...this.$store.getters.tokenInfo
        };
        this.$startRequest(
          "/item/getFilteredItems",
          requestData,
          res => {
            this.itemList = res.data;
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
        let requestData = this.$store.getters.tokenInfo;
        this.$startRequest(
          "/category/getCategoryList",
          requestData,
          res => {
            this.categoryList = res.data;
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

      getIconList() {
        let requestData = this.$store.getters.tokenInfo;
        this.$startRequest(
          "/icon/getIconList",
          requestData,
          res => {
            this.iconList = res.data;
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
      saveCategory() {
        if (this.disableSaveCategory) {
          return;
        }

        this.disableSaveCategory = true;
        if (!this.editingCategory.category_name) {
          this.$vux.toast.text("请填写类别名称", "top");
          return;
        }
        this.$vux.loading.show({
          text: "保存中"
        });
        let requestData = {
          ...this.$store.getters.tokenInfo,
          ...this.editingCategory
        };
        this.$startRequest(
          "/category/saveCategory",
          requestData,
          res => {
            this.categoryList = res.data;
            this.$vux.loading.hide();
            this.$vux.toast.text("保存成功", "top");
            this.hideCategoryPanel();
            this.disableSaveCategory = false;
          },
          error => {
            this.$vux.loading.hide();
            if (error.msg) {
              this.$vux.toast.text(error.msg, "top");
            } else {
              this.$vux.toast.text("网络错误", "top");
            }
            this.disableSaveCategory = false;
          }
        );
      },
      createCategory() {
        this.editingCategory = {
          category_name: "",
          category_color: "#888",
          icon: {
            icon_id: 1,
            icon_order: 1,
            icon_size: 100,
            icon_src: "fa fa-tag",
            icon_type: 1
          },
          category_icon_id: 1
        };
        this.categoryPanel = true;
      },
      setIconOfEditingCategory(icon) {
        this.editingCategory.icon = icon;
        this.editingCategory.category_icon_id = icon.icon_id;
      },

      editCategory(category) {
        this.editingCategory = {...category};
        this.categoryPanel = true;
      },

      hideCategoryPanel() {
        this.categoryPanel = false;
        this.disableSaveCategory = false;
      },
      confirmDeleteCategory() {
        this.$vux.confirm.show({
          title: "确认删除",
          content: "确定要删除该类别吗？删除后所属的所有事项与计划都会被删除~",
          onCancel: () => {
          },
          onConfirm: () => {
            this.deleteCategory(this.editingCategory);
          }
        });
      },
      deleteCategory(category) {
        if (!category.category_id) {
          return;
        }
        let requestData = {
          category_id: category.category_id,
          ...this.$store.getters.tokenInfo
        };
        this.$startRequest(
          "/category/deleteCategory",
          requestData,
          res => {
            this.$vux.toast.text("删除成功", "top");
            this.getCategoryList();
            this.hideCategoryPanel();
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
    padding: 0 0 150px;

    .top-panel {
      .type {
        font-size: 22px;
        line-height: 2;
        border-bottom: 1px solid #fff;

        ul {
          display: flex;

          li {
            padding-top: 4px;
            flex: 1;
            text-align: center;

            &:not(:last-of-type) {
              border-right: 1px dashed #fff;
            }

            i {
              font-size: 14px;
              vertical-align: middle;
              display: inline-block;
            }

            .text {
              vertical-align: middle;
              display: inline-block;
            }
          }

          .item.active {
            text-shadow: 0 0 1px rgb(0, 230, 118), 0 0 2px rgb(0, 230, 118),
            0 0 3px rgb(0, 230, 118), 0 0 4px rgb(0, 230, 118),
            0 0 5px rgb(0, 230, 118), 0 0 6px rgb(0, 230, 118);
          }

          .plan.active {
            text-shadow: 0 0 1px rgb(142, 36, 170), 0 0 2px rgb(142, 36, 170),
            0 0 3px rgb(142, 36, 170), 0 0 4px rgb(142, 36, 170),
            0 0 5px rgb(142, 36, 170), 0 0 6px rgb(142, 36, 170);
          }

          .category.active {
            text-shadow: 0 0 1px rgb(255, 160, 0), 0 0 2px rgb(255, 160, 0),
            0 0 3px rgb(255, 160, 0), 0 0 4px rgb(255, 160, 0),
            0 0 5px rgb(255, 160, 0), 0 0 6px rgb(255, 160, 0);
          }
        }
      }
    }

    .panel {
      line-height: 2;
      border-bottom: 1px solid #fff;
      border-radius: 10px;

      .selector-group {
        padding: 0 5px;

        .selector {
          border-bottom: 1px dashed #fff;
          font-size: 18px;
        }
      }

      .folding-bar {
        padding: 2px 12px 2px 0;
        display: flex;
        justify-content: flex-end;

        &:active {
          background: #444;
        }

        i {
          transition: transform 800ms;

          &.active {
            transform: rotate(180deg);
          }
        }
      }
    }

    .categoryList,
    .itemList {
      padding: 10px 0;

      .nofound {
        padding: 6px 20px 6px 20px;
        border-bottom: 1px dashed #fff;
        border-top: 1px dashed #fff;
        font-style: italic;
        opacity: 0.8;
        font-size: 16px;
      }

      .item {
        padding: 6px 0 6px 20px;
        border-bottom: 1px dashed #fff;

        &:first-of-type {
          border-top: 1px dashed #fff;
        }

        .name-line {
          display: flex;

          .category-name {
            font-style: italic;
            opacity: 0.6;
            margin-left: 15px;
          }
        }

        .level-line {
          padding: 2px 0;
          font-size: 16px;
          line-height: 1.2;
          display: flex;

          .closed-at {
            opacity: 0.6;
            font-style: italic;
          }

          .created-at {
            font-style: italic;
            opacity: 0.6;
          }

          & > div {
            margin-right: 15px;
          }
        }
      }
    }

    .categoryList {
      .item {
        .name-line {
          display: flex;

          .name {
            margin-left: 15px;
          }
        }
      }
    }

    .create-menu {
      position: fixed;
      bottom: 70px;
      right: 20px;
      z-index: 10;

      .menu-letf {
        position: absolute;
        white-space: nowrap;
        right: 65px;
        height: 48px;
        line-height: 48px;
        font-size: 20px;
        font-family: "仿宋", "FangSong", "FZFangSong", "楷书", Arial, Tahoma,
        "Hiragino Sans GB", "NSimSun", sans-serif;
        top: 2px;
      }
    }
  }

  .popup {
    background: #343434;
    color: #fff;
    font: 20px/150% "仿宋", "FangSong", "FZFangSong", "楷书", Arial, Tahoma,
    "Hiragino Sans GB", "NSimSun", sans-serif;

    .header {
      padding: 5px 10px 0;
      font-size: 18px;
      display: flex;
      justify-content: space-between;

      .text {
        display: inline-block;
      }
    }

    .group {
      padding: 10px;

      .example-wrapper {
        width: 100%;
        display: flex;
        justify-content: flex-start;

        .example {
          margin-left: 20px;
          display: flex;
          justify-content: center;
          align-items: center;

          .color-text {
            opacity: 0.8;
            white-space: nowrap;
            font-style: italic;
          }
        }
      }

      .circle {
        width: 35px;
        height: 35px;
        line-height: 35px;
        display: table;
        border: 3px solid #fff;
        border-radius: 50%;
        z-index: 1;

        i {
          font-size: 16px;
          vertical-align: middle;
          text-align: center;
          display: table-cell;
        }
      }

      .icon1 {
        width: 35px;
        height: 35px;
        line-height: 35px;
        display: table;
        background: #4026b4;
        border: 3px solid #fff;
        border-radius: 50%;
        z-index: 1;

        i {
          font-size: 16px;
          vertical-align: middle;
          text-align: center;
          display: table-cell;
        }
      }

      .icon-box {
        padding: 10px;

        .icon-item {
          display: inline-block;
          padding: 5px;
          width: auto;
        }
      }
    }
  }
</style>
