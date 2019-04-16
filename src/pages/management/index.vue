<template>
  <div class="page">
    <div class="panel">
      <div class="type">
        <ul>
          <li class="active">事项</li>
          <li>计划</li>
          <li>类别</li>
        </ul>
      </div>
      <div class="selector-group">
        <Selector
          :options="stateList"
          label="状态："
          v-bind:selected="stateSelected"
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
  </div>
</template>
<script>
import Selector from "@/components/common/Selector";
export default {
  name: "management",
  components: {
    Selector
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
      stateSelected: null,
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
      importanceLevelSelected: null,
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
      emergencyLevelSelected: null
    };
  },
  methods: {
    bindStateSelect(item) {
      this.stateSelected = item;
    },
    bindImportanceLevelSelect(item) {
      this.importanceLevelSelected = item;
    },
    bindEmergencyLevelSelect(item) {
      this.emergencyLevelSelected = item;
    },
  }
};
</script>

<style scoped lang="less">
.page {
  .panel {
    line-height: 2;
    border-bottom: 1px solid #fff;
    border-radius: 10px;
    .type {
      font-size: 22px;
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
          &.active {
            text-shadow: 0 0 1px rgb(204, 0, 255), 0 0 2px rgb(204, 0, 255),
              0 0 3px rgb(204, 0, 255), 0 0 4px rgb(204, 0, 255),
              0 0 5px rgb(204, 0, 255), 0 0 6px rgb(204, 0, 255);
          }
        }
      }
    }
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
}
</style>
