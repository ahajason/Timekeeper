<template>
  <div class="page">
    <div class="top-panel">
      <div class="type">
        <ul>
          <li
            class="item"
            :class="swiper.realIndex == 0 ? 'active' : ''"
            @click="swiperTo('0')"
          >
            <i class="fa fa-tasks"></i>
            <div class="text">事项</div>
          </li>
          <li
            class="plan"
            :class="swiper.realIndex == 1 ? 'active' : ''"
            @click="swiperTo('1')"
          >
            <i class="fa fa-calendar"></i>
            <div class="text">计划</div>
          </li>
          <li
            class="category"
            :class="swiper.realIndex == 2 ? 'active' : ''"
            @click="swiperTo('2')"
          >
            <i class="fa fa-tags"></i>
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
              label="状态："
              :selected="stateSelected"
              @on-select="bindStateSelect"
              selectedColor="#33c"
            ></Selector>
            <Selector
              :options="importanceLevelList"
              label="重要程度："
              v-bind:selected="importanceLevelSelected"
              @on-select="bindImportanceLevelSelect"
              selectedColor="#c33"
            ></Selector>
            <Selector
              :options="emergencyLevelList"
              label="紧急程度："
              v-bind:selected="emergencyLevelSelected"
              @on-select="bindEmergencyLevelSelect"
              selectedColor="#cc3"
            ></Selector>
          </div>
          <div class="folding-bar">
            <i class="fa fa-angle-up r" aria-hidden="true"> </i>
          </div>
        </div>
        <ul class="itemList">
          <li class="nofound" v-if="itemList.length == 0">
            没有找到符合条件的「事项」<br />
            可通过「首页」或「右下角」的「创建」按钮添加更多「事项」
          </li>
          <li
            class="item"
            v-for="(item, index) in itemList"
            :key="index"
            @click="goDetails(index)"
          >
            <div class="name-line">
              <div class="name" @click="goDetails(index)">
                {{ item.item_name }}
              </div>
              <div class="text category-name">
                #{{ item.category.category_name }}
              </div>
            </div>
            <div class="level-line">
              <Label
                v-bind:active="item.item_importance_level >= 5"
                textActive="重要"
                text="不重要"
                backgroundActive="#f66"
                size="sm"
              ></Label>
              <Label
                v-bind:active="item.item_emergency_level >= 5"
                textActive="紧急"
                backgroundActive="#ff6"
                size="sm"
              ></Label>
            </div>
            <div class="level-line">
              <div class="text created-at">{{ item.item_created_at }} 创建</div>
            </div>
            <div class="level-line">
              <div class="text closed-at" v-if="item.item_closed_at">
                {{ item.item_closed_at }}
              </div>
              <Label
                v-bind:active="item.item_state == 0"
                textActive="待办"
                text="已完成"
                backgroundActive="#68f"
                background="#88eeee"
                size="sm"
              ></Label>
            </div>
          </li>
        </ul>
      </swiperSlide>
      <swiperSlide class="module" id="module2">2</swiperSlide>
      <swiperSlide class="module" id="module3">
        <ul class="itemList">
          <li
            class="item"
            v-for="(category, index) in categoryList"
            :key="index"
            @click="goDetails(index)"
          >
            <div class="name-line">
              <div class="name" @click="goDetails(index)">
                <i :class="category.icon.icon_src"></i>
                {{ category.category_name }}
              </div>
            </div>
            <div class="level-line"></div>
          </li>
        </ul>
      </swiperSlide>
    </swiper>
    <CircleMenu
      class="create-menu"
      type="top"
      :number="3"
      mask="black"
      circle
      animate="animated rubberBand"
      btn
    >
      <a slot="item_1" class="fa fa-tags">
        <div class="menu-letf" @click="show = !show">
          新建类别
        </div>
      </a>
      <a slot="item_2" class="fa fa-calendar">
        <div class="menu-letf">
          新建计划
        </div>
      </a>
      <a slot="item_3" class="fa fa-tasks">
        <div class="menu-letf">
          新建事项
        </div>
      </a>
    </CircleMenu>
    <div v-transfer-dom class="popup-warpper">
      <popup v-model="show" height="68%" class="popup">
        <Group>
          <Cell :inline="true">
            <input
              type="text"
              placeholder="输入类别名称"
              v-model="editingCategory.category_name"
            />
          </Cell>
          <Cell :inline="true">
            <Slider v-model="colors"></Slider>
          </Cell>
          <Cell :inline="true">
            <i
              v-if="editingCategory.icon"
              v-bind:style="editingCategory.category_color | colorsCss"
              :class="editingCategory.icon.icon_src"
            ></i>
            {{ editingCategory.category_color }}
          </Cell>
          <Cell :inline="true">
            <div class="icon-box">
              <div
                class="icon-item"
                v-for="icon in iconList"
                :key="icon.icon_id"
              >
                <Glowing color="#fff" :textShadow="colors.hex">
                  <i :class="icon.icon_src"></i>
                </Glowing>

                  <i :style="colors.hex | colorsCss" :class="icon.icon_src"></i>

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
import { swiper, swiperSlide } from "vue-awesome-swiper";
import { Popup, TransferDom, Flexbox, FlexboxItem } from "vux";
import Group from "@/components/common/Group";
import Cell from "@/components/common/Cell";
import { Slider } from "vue-color";
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
    Group,
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
      show: false,
      colors: {
        hex: "#888"
      }
    };
  },
  watch: {
    colors: function(val) {
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
    colorsCss: color => "color:" + color
  },
  computed: {},
  methods: {
    log() {
      console.log(this.colors);
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
          console.log(this.iconList);
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
    editCategory() {
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
    }
  },
  directives: {
    TransferDom
  }
};
</script>

<style scoped lang="less">
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
  padding: 10px;
  background: #343434;
  color: #fff;
  font: 20px/150% "仿宋", "FangSong", "FZFangSong", "楷书", Arial, Tahoma,
    "Hiragino Sans GB", "NSimSun", sans-serif;
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
    .icon-item {
      display: inline-block;
      padding: 5px;
      width: auto;
    }
  }
}
</style>
