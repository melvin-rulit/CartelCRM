<template>
    <div class="header-container">
        <h3>{{ title }}</h3>

        <div class="error-container">
            <slot name="errors"></slot>
        </div>

        <div class="button-container">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'Напишите заголовок' // Текст по умолчанию
        }
    }
}
</script>

<style scoped>

.header-container {
    display: flex;
    justify-content: space-between; /* Размещает заголовок и слот по краям */
    align-items: center; /* Центрует элементы по вертикали */
}

.button-container {
    display: flex; /* Используем flex для кнопок */
    gap: 10px; /* Пробел между кнопками */
}

.error-container {
    margin-top: 10px;
    //color: red; /* Цвет для отображения ошибок */
}

</style>
