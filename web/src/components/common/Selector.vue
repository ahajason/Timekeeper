<template>
  <div class="selector" id="Selector">
    <div class="label" v-text="label"></div>
    <ul>
      <li
          :class="(item.value == selected.value) | selectedClass"
          :key="item.value"
          @click="select(item)"
          v-for="item in options"
      >
        <div
            :style="
            item.value == selected.value
              ? 'text-shadow: 0 0 1px ' +
                selectedColor +
                ', 0 0 2px ' +
                selectedColor +
                ', 0 0 3px ' +
                selectedColor +
                ', 0 0 4px ' +
                selectedColor +
                ', 0 0 5px ' +
                selectedColor +
                ', 0 0 6px ' +
                selectedColor +
                ';'
              : ''
          "
        >
          {{ item.name }}
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
  export default {
    name: "Selector",
    data() {
      return {};
    },
    props: {
      options: {
        type: Array,
        default: () => []
      },
      selected: {
        type: Object,
        default: () => {
        }
      },
      label: {
        type: String,
        default: ""
      },
      selectedColor: {
        type: String,
        default: "#f87"
      }
    },
    filters: {
      selectedClass: isSelected => (isSelected ? "selected" : "")
    },
    computed: {},
    methods: {
      select(item) {
        this.$emit("on-select", item);
      }
    },
    mounted() {
    }
  };
</script>

<style lang="less" scoped>
  .selector {
    display: flex;

    .label {
      display: flex;
      flex: 0 0 100px;
      white-space: nowrap;
    }

    ul {
      display: flex;

      li {
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 0 0 60px;

        .text {
          display: flex;
          white-space: nowrap;
        }
      }
    }
  }
</style>
