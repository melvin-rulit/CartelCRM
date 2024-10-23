<template>
    <div class="container">
        <!-- Первая строка: поиск, выпадающий список для количества строк, кнопка фильтр -->
        <div class="header">
            <template v-if="searchQuery">
                <Icon icon="ooui:clear" @click="clearSearch" class="bottom-icon" />
            </template>
            <template v-else>
                <Icon icon="ic:baseline-search" class="bottom-icon"/>
            </template>
            <input
                class="form-control"
                v-model="searchQuery"
                @input="handleSearch"
                type="text"
                placeholder="Поиск"
            />

<!--            <ButtonUI v-if="selectedRows.length > 0" @click="deleteSelected" fontSize="11px" fontWeight="300">-->
<!--                {{ selectAll ? 'Удалить всех' : 'Удалить пользователя' }}-->
<!--            </ButtonUI>-->

            <ButtonUI
                color="white"
                fontSize="11px"
                padding="5px 10px"
                fontWeight="500"
                v-if="selectedRows.length > 0" @click="deleteSelected"
            >
                {{ selectAll ? 'Удалить все' : 'Удалить строку' }}
            </ButtonUI>


                <button v-if="isThisRouteCounterpartiesOrders" @click="addfilter('all')" class="white-button for_payment">
                    Все
                </button>
                <button v-if="isThisRouteCounterpartiesOrders" @click="addfilter('for_payment')" class="white-button for_payment">
                    Текущие
                </button>
                <button v-if="isThisRouteCounterpartiesOrders" @click="addfilter('completed')" class="white-button completed">
                    Архивные
                </button>


            <select v-model="rowsPerPage" @change="handleRowsChange">
                <option
                    v-for="option in rowsPerPageOptions"
                    :key="option"
                    :value="option"
                >
                    {{ option }} на стр.
                </option>
            </select>

<!--            <ButtonUI-->
<!--                color="white"-->
<!--                fontSize="11px"-->
<!--                padding="5px 10px"-->
<!--                fontWeight="500"-->
<!--                @click="togglePanel"-->
<!--            >-->
<!--                <Icon icon="jam:settings-alt" class="ico"/>-->
<!--                Фильтр-->
<!--            </ButtonUI>-->

            <button @click="togglePanel" class="white-button">
                 Фильтр
            </button>
            <FilterPanel
                :isOpen="isFilterOpen"
                :dropdownOptions="dropdownConfig"
                :checkBoxOptions="checkBoxConfig"
                @filterApplied="handleFilterApplied"
                @close="closeFilter"
            />

        </div>

        <!-- Вторая строка: чекбокс выбора всех, настраиваемые заголовки колонок -->
        <table>
            <thead>
            <tr>
                <th class="checkbox"><input type="checkbox" @change="toggleSelectAll" v-model="selectAll"/></th>
                <th v-for="(column, index) in columns" :key="index">{{ column.label }}</th>
            </tr>
            </thead>

            <!-- Строки с данными -->
            <tbody>
            <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex" @click="goToDetails(row.id)">
                <td><input type="checkbox" v-model="selectedRows" :value="row" @click.stop/></td>
                <td v-for="(column, index) in columns" :key="index">

                    <template v-if="column.key === 'is_paid'">
                <span :class="{ 'paid-yes': row.is_paid, 'paid-no': !row.is_paid}">
                    {{ row.is_paid ? 'Оплачен' : 'Не оплачен' }}
                </span>
                    </template>

                    <template v-if="column.key === 'order_successful'">
                <span :class="{ 'order_successful': row.order_successful}">
                    {{ row.order_successful ? 'Выполнен' : 'Не выполнен' }}
                </span>
                    </template>

                    <template v-if="column.key === 'status'">

<!--                        <select v-model="row.status" @change="handleStatusChange(row)" @click.stop>-->
<!--                            <option v-for="status in statuses" :key="status.id" :value="status.value">-->
<!--                                {{ status.label }}-->
<!--                            </option>-->
<!--                        </select>-->
                        <div v-if="row.status && statuses.length > 0">
                            <select v-model="row.status" @change="handleStatusChange(row)" @click.stop>
                                <option v-for="status in statuses" :key="status.id" :value="status.value">
                                    {{ status.label }}
                                </option>
                            </select>
                        </div>

                    </template>
                    <template v-else>
                        {{ getValue(row, column.key) }}
                    </template>
                </td>
            </tr>
            </tbody>

        </table>

        <!-- Пагинация -->
        <div class="table-footer">
            <button @click="goToPreviousPage" :disabled="currentPage === 1">
                <Icon icon="ic:round-arrow-back" class="ico"/>
                Назад
            </button>
            <div class="pagination-numbers">
                <button v-for="page in totalPagesArray" :key="page" :class="{ active: page === currentPage }"
                        @click="goToPage(page)">
                    {{ page }}
                </button>
            </div>
            <button @click="goToNextPage" :disabled="currentPage === totalPages">Вперед
                <Icon icon="ic:round-arrow-forward" class="ico"/>
            </button>
        </div>
    </div>
</template>

<script>
import {Icon} from "@iconify/vue";
import ButtonUI from "../UI/ButtonUI.vue";
import FilterPanel from './SidePanel.vue';
import { ref } from 'vue';

export default {
    setup() {
        const isPanelOpen = ref(false);

        const togglePanel = () => {
            isPanelOpen.value = !isPanelOpen.value;
        };

        return { isPanelOpen, togglePanel };
    },
    components: {ButtonUI, Icon, FilterPanel},
    props: {
        data: {
            type: Array,
            required: true,
        },
        columns: {
            type: Array,
            required: true,
        },
        rowsPerPageOptions: {
            type: Object,
            default: () => [10, 25, 50, 100],
        },
        path: {
            type: String,
            required: false
        },
        rowSelect: {
            type: Boolean,
            required: false,
            default: true
        }
    },
    data() {
        return {

            searchQuery: "",
            rowsPerPage: 10,
            filteredData: this.data,
            selectedRows: [],
            selectAll: false,
            currentPage: 1,
            isFilterDropdownVisible: false, // Состояние видимости выпадающего окна
            nameSort: "asc", // Для сортировки названия
            ratingSort: "asc", // Для сортировки рейтинга
            checkboxOptions: [
                {id: 1, label: 'Опция 1', value: 'option1'},
                {id: 2, label: 'Опция 2', value: 'option2'},
                {id: 3, label: 'Опция 3', value: 'option3'},
                {id: 4, label: 'Опция 4', value: 'option4'},
                {id: 5, label: 'Опция 5', value: 'option5'},
                {id: 6, label: 'Опция 6', value: 'option6'},
                {id: 7, label: 'Опция 7', value: 'option7'},
                {id: 8, label: 'Опция 8', value: 'option8'},
            ],
            selectedOptions: [], // Для выбранных чекбоксов
            statuses: [
                {id: 1, label: 'К оплате', value: 'for_payment'},
                {id: 2, label: 'Выполнено', value: 'completed'},
                // { id: 3, label: 'Неактивные' },
                // { id: 4, label: 'Ожидающие' },
            ],
            selectedStatus: null, // для хранения выбранного статуса
            isFilterOpen: false,
            dropdownConfig: [
                {
                    id: 'name-sort',
                    label: 'Название',
                    options: [
                        { text: 'По возрастанию', value: 'asc' },
                        { text: 'По убыванию 1', value: 'desc' },
                        { text: 'По убыванию 2', value: 'desasc' },
                        { text: 'По убыванию 3', value: 'daesc' },
                    ],
                },
                {
                    id: 'comany-sort',
                    label: 'Комания',
                    options: [
                        { text: 'Названия', value: 'asc' },
                        { text: 'Убываеия', value: 'desc' },
                    ],
                },
                {
                    id: 'rating-sort',
                    label: 'Рейтинг',
                    options: [
                        { text: 'По возрастанию', value: 'asc' },
                        { text: 'По убыванию', value: 'desc' },
                    ],
                },
            ],
            checkBoxConfig: [
                { id: 'checkbox-1', label: 'Поле', value: 'option1' },
                { id: 'checkbox-2', label: 'Поле 2', value: 'option2' },
            ],

        };
    },
    computed: {
        isThisRouteCounterpartiesOrders() {
            return this.$route.name === 'ordersCounterpartiesList';
        },
        totalPages() {
            return Math.ceil(this.filteredData.length / this.rowsPerPage);
        },
        totalPagesArray() {
            // Отображаем максимум 3 страницы
            const pages = [];
            for (let i = 1; i <= this.totalPages && i <= 3; i++) {
                pages.push(i);
            }
            return pages;
        },
        paginatedData() {
            const startIndex = (this.currentPage - 1) * this.rowsPerPage;
            return this.filteredData.slice(startIndex, startIndex + this.rowsPerPage);
        },
    },
    methods: {

        handleSearch() {
            this.filteredData = this.data.filter((row) => {
                // Проверяем, что строка поиска не пустая
                if (this.searchQuery.trim() === "") {
                    return true; // Если пустая, возвращаем все данные
                }

                // Проверяем каждое поле, по которому хотим осуществить поиск
                return this.columns.some((col) => {
                    const value = this.getValue(row, col.key);
                    return String(value)
                        .toLowerCase()
                        .includes(this.searchQuery.toLowerCase());
                });
            });
            this.currentPage = 1; // Сбрасываем на первую страницу после поиска
        },
        clearSearch() {
            this.searchQuery = ""; // Сбрасываем строку поиска
            this.handleSearch();   // Обновляем данные
        },

        handleRowsChange() {
            this.currentPage = 1; // сбрасываем на первую страницу при изменении количества строк
        },
        togglePanel() {
            this.isFilterOpen = !this.isFilterOpen;
        },
        closeFilter() {
            this.isFilterOpen = false;
        },
        addfilter(type) {
            this.$emit('filterApplied', type);
        },
        handleFilterApplied(filterData) {
            console.log('Примененные фильтры:', filterData);
            // Добавьте логику для применения фильтров к filteredData здесь
        },

        // applyFilter() {
        //     // Логика для применения фильтров
        //     // Например, сортировка по названию и рейтингу
        //     this.filteredData = this.data.filter(row => {
        //         return this.selectedOptions.includes(row.option); // Предполагается, что есть поле "option" в данных
        //     });
        //
        //     // Здесь можно добавить логику сортировки по nameSort и ratingSort
        //
        //     this.isFilterDropdownVisible = false; // Закрываем выпадающее окно после применения фильтров
        // },
        toggleSelectAll() {
            if (this.selectAll) {
                this.selectedRows = [...this.paginatedData];
            } else {
                this.selectedRows = [];
            }
        },
        goToPage(page) {
            this.currentPage = page;
        },
        goToPreviousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        goToNextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        goToDetails: function (id) {
            if (this.rowSelect){
                this.$router.push({path: `${this.path}${id}`});
            }
        },
        // getValue(row, key) {
        //     const keys = key.split('.'); // Разделяем ключи по точке
        //     return keys.reduce((obj, key) => (obj ? obj[key] : ''), row); // Извлекаем значение
        // },
        getValue(row, key) {
            // Игнорируем ключ 'is_paid'
            if (key === 'is_paid') {
                return null; // игнорируем его
            }
            if (key === 'order_successful') {
                return null; // игнорируем его
            }
            const keys = key.split('.'); // Разделяем ключи по точке
            return keys.reduce((obj, key) => (obj ? obj[key] : ''), row); // Извлекаем значение
        },
        handleStatusChange(row) {
            this.selectedStatus = row.status
        },
        // togglePanel() {
        //     isPanelOpen.value = !isPanelOpen.value;
        // },
    },
    watch: {
        data: {
            handler(newData) {
                this.filteredData = newData;
            },
            deep: true,
        },
    },
};
</script>

<style lang="scss" scoped>
.container {
    width: 100%;
    background-color: #fff;
    box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.03);
    border: 1px solid hsl(215, 50%, 95%);
    border-radius: 6px;
    overflow: hidden;
    user-select: none;

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #b1c2d9;
        padding: 0 1em;

        .form-control {
            border: none;
            width: 100%;
            outline: none;
            padding: 1.5em 1em 1.5em 0.5em;
            border-radius: 6px;

            &::placeholder {
                color: #b1c2d9;
            }
        }

        .for_payment {
            margin-right: 5px;
        }
        //.for_payment.active {
        //   background-color: red;
        //}

        select {
            cursor: pointer;
            margin: 0 1em;
            padding: 0.5em;
            border: none;
            font-size: 12px;
            color: black;
            background-color: unset;
        }

        .bottom-icon {
            font-size: 18px;
            margin-right: 0;
        }

        .ico {
            font-size: 16px;
            margin-right: 0.4em;
        }
    }

    table {
        width: 100%;
        border-collapse: collapse;

        thead {
            background-color: #f9fbfd;
            color: #95aac9;
            text-transform: uppercase;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            border-top: 1px solid #edf2f9;

            .checkbox {
                text-align: center;
            }

            th {
                padding: 1em;
                border-bottom: 1px solid #edf2f9;
                vertical-align: middle; // Добавлено
                &:first-child {
                    width: 3%;
                }
            }
        }

        tbody {
            tr {
                transition: background-color 0.3s;

                &:hover {
                    background-color: #f1f3f5;
                    cursor: pointer;
                }

                td {
                    padding: 0.75em;
                    border-top: 1px solid #edf2f9;
                    text-align: left;
                    vertical-align: middle; // Добавлено

                    &:first-child {
                        text-align: center;
                        width: 3%;
                    }
                    .paid-yes {
                        color: green;
                        font-weight: bold;
                    }
                    .paid-no {
                        color: red;
                        font-weight: bold;
                    }
                    .order_successful {
                        color: green;
                        font-weight: bold;
                    }

                    input[type="checkbox"] {
                        cursor: pointer;
                        height: 1rem;
                        width: 1rem;
                        margin: 0;
                    }
                }
            }
        }
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        // padding: 1em;
        background-color: #f9fbfd;
        border-top: 1px solid #edf2f9;

        button {
            display: flex;
            align-items: center;
            padding: 1.3em 3em;
            border: unset;
            border-left: 1px solid #edf2f9;
            border-right: 1px solid #edf2f9;
            background-color: #ffffff;
            color: #b1c2d9;
            cursor: pointer;
            transition: 0.3s;

            &:disabled {
                cursor: unset;
            }

            &:disabled:hover {
                color: #b1c2d9;
            }

            &:hover {
                transition: 0.3s;
                color: black;
            }

            .ico {
                width: 2em;
            }
        }

        .pagination-numbers {
            display: flex;
            gap: 0.5em;

            button {
                padding: 0.4em;
                background-color: #f9fbfd;
                border: none;
                color: #b1c2d9;
                cursor: pointer;

                &.active {
                    color: black;
                    border: 1px solid #edf2f9;
                    border-radius: 4px;
                }

                &:hover {
                    color: black;
                }
            }
        }
    }
}
</style>
