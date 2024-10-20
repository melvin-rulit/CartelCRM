<template>
  <div class="nav-container">
    <div class="nav-tabs">
      <div
        v-for="(tab, index) in tabs"
        :key="index"
        :class="['nav-item', { active: activeTab === index }]"
        @click="setActiveTab(index)"
      >
        {{ tab }}
      </div>
    </div>

    <!-- Динамический слот для вывода контента -->
    <div class="tab-content">
      <slot :name="'tab-' + activeTab"></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    tabs: {
      type: Array,
      required: true,
    },
    defaultTab: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      activeTab: this.defaultTab,
    };
  },
  methods: {
    setActiveTab(index) {
      this.activeTab = index;
    },
  },
};
</script>

<style lang="scss" scoped>
.nav-tabs {
  display: flex;
  width: 100%;
  border-bottom: 1px solid #e3ebf6;
}

.nav-item {
  padding: 10px 20px;
  cursor: pointer;
  color: #6e84a3;
  position: relative;
  transition: color 0.3s ease;

  &.active {
    color: #000;
    font-weight: bold;

    &::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 100%;
      height: 1px;
      background-color: #2c7be5;
    }
  }

  &:hover {
    color: #000;
  }
}

.tab-content {
  padding: 70px 0;
}
</style>
