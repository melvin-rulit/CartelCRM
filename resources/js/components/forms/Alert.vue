<!--<template>-->
<!--  <transition name="slide-down">-->
<!--    <div v-if="isVisible" :class="['alert', alertTypeClass]">-->
<!--      <div class="content">-->
<!--        <Icon :icon="icon" class="alert-icon" />-->
<!--        <p>{{ message }}</p>-->
<!--      </div>-->
<!--      <div class="progress-bar" :style="progressBarStyle"></div>-->
<!--    </div>-->
<!--  </transition>-->
<!--</template>-->

<!--<script>-->
<!--import { Icon } from "@iconify/vue";-->

<!--export default {-->
<!--  props: {-->
<!--    message: {-->
<!--      type: String,-->
<!--      required: true,-->
<!--    },-->
<!--    type: {-->
<!--      type: String,-->
<!--      default: 'success',-->
<!--    },-->
<!--    duration: {-->
<!--      type: Number,-->
<!--      default: 5000,-->
<!--    },-->
<!--  },-->
<!--  data() {-->
<!--    return {-->
<!--      isVisible: false,-->
<!--      progressBarWidth: 100,-->
<!--    };-->
<!--  },-->
<!--  computed: {-->
<!--    alertTypeClass() {-->
<!--      return this.type === 'success' ? 'alert-success' : 'alert-error';-->
<!--    },-->
<!--    icon() {-->
<!--      return this.type === 'success' ? 'mdi:success-bold' : 'mdi:cancel-bold';-->
<!--    },-->
<!--    progressBarStyle() {-->
<!--      return {-->
<!--        width: `${this.progressBarWidth}%`,-->
<!--      };-->
<!--    },-->
<!--  },-->
<!--  methods: {-->
<!--    showAlert() {-->
<!--      this.isVisible = true;-->
<!--      this.startProgressBar();-->
<!--      setTimeout(() => {-->
<!--        this.isVisible = false;-->
<!--      }, this.duration);-->
<!--    },-->
<!--    startProgressBar() {-->
<!--      this.progressBarWidth = 100;-->
<!--      const interval = setInterval(() => {-->
<!--        if (this.progressBarWidth > 0) {-->
<!--          this.progressBarWidth -= 100 / (this.duration / 100);-->
<!--        } else {-->
<!--          clearInterval(interval);-->
<!--        }-->
<!--      }, 100);-->
<!--    },-->
<!--  },-->
<!--  components: {-->
<!--    Icon,-->
<!--  },-->
<!--};-->
<!--</script>-->

<!--<style lang="scss" scoped>-->
<!--.alert {-->
<!--  position: fixed;-->
<!--  top: 0;-->
<!--  left: 50%;-->
<!--  transform: translateX(-50%);-->
<!--  width: 80%;-->
<!--  max-width: 400px;-->
<!--  padding: 15px;-->
<!--  border-radius: 6px;-->
<!--  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);-->
<!--  z-index: 1000;-->
<!--  text-align: center;-->
<!--  font-size: 16px;-->
<!--  opacity: 0.9;-->
<!--  margin-top: 2em;-->
<!--  -->
<!--  p {-->
<!--    margin: 0 0 0 1em;-->
<!--    font-weight: 500;-->
<!--  }-->

<!--  &-success {-->
<!--    border: 1px solid #4caf50;-->
<!--    .progress-bar {-->
<!--      background-color: #4caf50;-->
<!--    }-->
<!--  }-->
<!--  -->
<!--  &-error {-->
<!--    border: 1px solid #f44336;-->
<!--    .progress-bar {-->
<!--      background-color: #f44336;-->
<!--    }-->
<!--  }-->

<!--  .content {-->
<!--    display: flex;-->
<!--    justify-content: center;-->
<!--    align-items: center;-->
<!--  }-->
<!--}-->

<!--.progress-bar {-->
<!--  height: 4px;-->
<!--  transition: width 0.1s linear;-->
<!--  border-radius: 8px;-->
<!--  margin-top: 1em;-->
<!--}-->

<!--.slide-down-enter-active, .slide-down-leave-active {-->
<!--  transition: all 0.3s ease;-->
<!--}-->

<!--.slide-down-enter, .slide-down-leave-to {-->
<!--  transform: translateX(100%);-->
<!--  opacity: 0;-->
<!--}-->
<!--</style>-->

<template>
    <transition name="slide-down">
        <div v-if="isVisible" :class="['alert', alertTypeClass]">
            <div class="content">
                <Icon :icon="icon" class="alert-icon" />
                <p>{{ message }}</p>
            </div>
            <div class="progress-bar" :style="progressBarStyle"></div>
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
        duration: {
            type: Number,
            default: 5000,
        },
    },
    data() {
        return {
            isVisible: false,
            progressBarWidth: 100,
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
                    return 'mdi:check-circle-outline';
                case 'error':
                    return 'mdi:close-circle-outline';
                case 'danger':
                    return 'mdi:alert-outline';
                case 'info':
                    return 'mdi:information-outline';
                default:
                    return 'mdi:check-circle-outline';
            }
        },
        progressBarStyle() {
            return {
                width: `${this.progressBarWidth}%`,
            };
        },
    },
    methods: {
        showAlert() {
            this.isVisible = true;
            this.startProgressBar();
            setTimeout(() => {
                this.isVisible = false;
            }, this.duration);
        },
        startProgressBar() {
            this.progressBarWidth = 100;
            const interval = setInterval(() => {
                if (this.progressBarWidth > 0) {
                    this.progressBarWidth -= 100 / (this.duration / 100);
                } else {
                    clearInterval(interval);
                }
            }, 100);
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
    max-width: 400px;
    padding: 15px;
    border-radius: 6px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    text-align: center;
    font-size: 16px;
    opacity: 0.9;
    margin-top: 2em;
    background-color: #fff;

    p {
        margin: 0 0 0 1em;
        font-weight: 500;
    }

    &-success {
        border: 1px solid #4caf50;
        .progress-bar {
            background-color: #4caf50;
        }
    }

    &-error {
        border: 1px solid #f44336;
        .progress-bar {
            background-color: #f44336;
        }
    }

    &-danger {
        border: 1px solid #ff9800;
        .progress-bar {
            background-color: #ff9800;
        }
    }

    &-info {
        border: 1px solid #2196f3;
        .progress-bar {
            background-color: #2196f3;
        }
    }

    .content {
        display: flex;
        justify-content: center;
        align-items: center;
    }
}

.progress-bar {
    height: 4px;
    transition: width 0.1s linear;
    border-radius: 8px;
    margin-top: 1em;
}

.slide-down-enter-active, .slide-down-leave-active {
    transition: all 0.3s ease;
}

.slide-down-enter, .slide-down-leave-to {
    transform: translateX(100%);
    opacity: 0;
}
</style>
