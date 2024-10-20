<template>
  <div v-if="isOpen" class="overlay" @click.self="closePanel">
<!--  <div  class="overlay" @click.self="closePanel">-->
    <div class="panel">
      <h2>Фильтр</h2>

      <div class="filter-row">
        <label for="name-sort">Название</label>
        <select id="name-sort">
          <option value="asc">По возрастанию</option>
          <option value="desc">По убыванию</option>
        </select>
      </div>

      <div class="filter-row">
        <label for="rating-sort">Рейтинг</label>
        <select id="rating-sort">
          <option value="asc">По возрастанию</option>
          <option value="desc">По убыванию</option>
        </select>
      </div>

      <!-- Динамически создаем чекбоксы из массива -->
<!--      <div class="checkbox-row" v-for="option in checkBoxOptions" :key="option.id">-->
<!--        <input type="checkbox" :id="option.id" v-model="selectedOptions" :value="option.value" />-->
<!--        <label :for="option.id">{{ option.label }}</label>-->
<!--      </div>-->

      <hr />
      <div class="apply-button">
<!--        <ButtonUI @click="applyFilter">Применить</ButtonUI>-->
      </div>
    </div>
  </div>

</template>


<script setup>
import { ref } from 'vue';
import { defineProps, defineEmits } from 'vue';
import ButtonUI from "../UI/ButtonUI.vue";

const props = defineProps({
  isOpen: Boolean,
});

const emit = defineEmits(['close']);

const closePanel = () => {
  emit('close');
};

// Список опций для чекбоксов
const checkBoxOptions = ref([
  { id: 'checkbox-1', label: 'Опция 1', value: 'option1' },
  { id: 'checkbox-2', label: 'Опция 2', value: 'option2' },
  { id: 'checkbox-3', label: 'Опция 3', value: 'option3' },
  { id: 'checkbox-4', label: 'Опция 4', value: 'option4' },
  { id: 'checkbox-5', label: 'Опция 5', value: 'option5' },
]);

// Выбранные опции
const selectedOptions = ref([]);

// Функция для применения фильтра
const applyFilter = () => {
  console.log('Выбранные опции:', selectedOptions.value);
  closePanel();
};
</script>


<style scoped lang="scss">
.overlay {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: flex-end;
}

.panel {
  background-color: #ffffff;
  width: 300px;
  padding: 1.5em;
  box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.1);
  animation: slide-in 0.3s forwards;

  h2 {
    text-align: center;
    margin-bottom: 1em;
    color: #333;
  }

  .filter-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5em;

    label {
      font-size: 14px;
      color: #333;
    }

    select {
      width: 150px;
      padding: 0.5em;
      border: 1px solid #e3ebf6;
      border-radius: 5px;
      background-color: #fff;
      font-size: 14px;
      transition: border-color 0.3s;

      &:focus {
        border-color: #569afa;
      }

      option {
        padding: 0.5em;
      }
    }
  }

  .checkbox-row {
    display: flex;
    align-items: center;
    margin-bottom: 1em;

    input[type="checkbox"] {
      margin-right: 10px;
    }

    label {
      font-size: 14px;
      color: #333;
    }
  }

  .apply-button {
    display: flex;
    justify-content: center;
  }
}

@keyframes slide-in {
  from {
    transform: translateX(100%);
  }
  to {
    transform: translateX(0);
  }
}
</style>
