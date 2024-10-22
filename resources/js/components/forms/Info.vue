<template>
  <transition name="slide-down">
    <div v-if="isVisible" :class="['alert', alertTypeClass]" @click="closeAlert">
      <div class="content">
        <Icon :icon="icon" class="alert-icon" :class="iconColorClass" />
        <p>{{ message }}</p>
        <!-- <Icon icon="mdi:close" class="close-icon" @click.stop="closeAlert" /> -->
      </div>
    </div>
  </transition>
</template>

<script>
import { Icon } from "@iconify/vue";

export default {
  props: {
    message: {
      type: String,
      required: true,
    },
    type: {
      type: String,
      default: 'success', // Возможные значения: 'success', 'error', 'danger', 'info'
    },
  },
  data() {
    return {
      isVisible: true,
    };
  },
  computed: {
    alertTypeClass() {
      switch (this.type) {
        case 'success':
          return 'alert-success';
        case 'error':
          return 'alert-error';
        case 'danger':
          return 'alert-danger';
        case 'info':
          return 'alert-info';
        default:
          return 'alert-success';
      }
    },
    icon() {
      switch (this.type) {
        case 'success':
          return 'mdi:success-bold';
        case 'error':
          return 'mdi:cancel-bold';
        case 'danger':
          return 'pajamas:warning';
        case 'info':
          return 'zondicons:information-outline';
        default:
          return 'mdi:success-bold';
      }
    },
    iconColorClass() {
      switch (this.type) {
        case 'success':
          return 'icon-success';
        case 'error':
          return 'icon-error';
        case 'danger':
          return 'icon-danger';
        case 'info':
          return 'icon-info';
        default:
          return 'icon-success';
      }
    },
  },
  methods: {
    showAlert() {
      this.isVisible = true;
    },
    closeAlert() {
      this.isVisible = false;
    },
  },
  components: {
    Icon,
  },
};
</script>

<style lang="scss" scoped>
.alert {
  position: fixed;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80%;
  max-width: 600px;
  padding: 12px;
  border-radius: 6px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  text-align: center;
  font-size: 16px;
  opacity: 0.9;
  margin-top: 0.4em;
  background-color: #fff;
  cursor: pointer;

  p {
    margin: 0 0 0 1em;
    font-weight: 500;
    flex: 1;
  }

  &-success {
    background-color: #e8f5e9;
  }

  &-error {
    background-color: #ffebee;
  }

  &-danger {
    background-color: #fff3e0;
  }

  &-info {
    background-color: #e3f2fd;
  }

  .content {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
  }
}

/* Цвет иконки в зависимости от типа */
.icon-success {
  color: #4caf50;
}

.icon-error {
  color: #f44336;
}

.icon-danger {
  color: #ff9800;
}

.icon-info {
  color: #2196f3;
}

/* Иконка закрытия (крестик) */
.close-icon {
  color: #777;
  position: absolute;
  right: 10px;
  cursor: pointer;
  font-size: 1.2em;
}

.slide-down-enter-active, .slide-down-leave-active {
  transition: all 0.3s ease;
}

.slide-down-enter, .slide-down-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
</style>
