<template>
    <div class="container">
        <!-- Первая строка: поиск, выпадающий список для количества строк, кнопка фильтр -->
        <div class="header">
            <Icon icon="ic:baseline-search" class="bottom-icon"/>
            <input
                class="form-control"
                v-model="searchQuery"
                @input="handleSearch"
                type="text"
                placeholder="Поиск"
            />

            <select v-model="rowsPerPage" @change="handleRowsChange">
                <option
                    v-for="option in rowsPerPageOptions"
                    :key="option"
                    :value="option"
                >
                    {{ option }} на стр.
                </option>
            </select>

            <ButtonUI
                color="white"
                fontSize="11px"
                padding="5px 10px"
                fontWeight="500"
                @click="toggleFilterDropdown"
            >
                <Icon icon="jam:settings-alt" class="ico"/>
                Фильтр
            </ButtonUI>
        </div>

        <!-- Выпадающее окно фильтрации -->
        <div v-if="isFilterDropdownVisible" class="filter-dropdown">
            <h3>Фильтр</h3>
            <div class="filter-item">
                <label for="name-filter">Название</label>
                <select v-model="nameSort">
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </div>
            <div class="filter-item">
                <label for="rating-filter">Рейтинг</label>
                <select v-model="ratingSort">
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </div>
            <div class="filter-checkboxes">
                <h4>Выбор опций</h4>
                <label v-for="option in checkboxOptions" :key="option.id">
                    <input type="checkbox" v-model="selectedOptions" :value="option.value"/>
                    {{ option.label }}
                </label>
            </div>
            <ButtonUI @click="applyFilter">Применить</ButtonUI>
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
<!--            <tbody>-->
<!--            <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex" @click="goToDetails(row.id)">-->
<!--                <td><input type="checkbox" v-model="selectedRows" :value="row" @click.stop /></td>-->
<!--                <td v-for="(column, index) in columns" :key="index">{{ getValue(row, column.key) }}</td>-->
<!--            </tr>-->
<!--            </tbody>-->
            <tbody>
            <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex" @click="goToDetails(row.id)">
                <td><input type="checkbox" v-model="selectedRows" :value="row" @click.stop /></td>
                <td v-for="(column, index) in columns" :key="index">
                    <!-- Добавляем условие для статуса -->
                    <template v-if="column.key === 'order_status'">
                        <select v-model="row.status" @change="handleStatusChange(row)" @click.stop>
                            <option v-for="status in statuses" :key="status.id" :value="status.label">
                                {{ status.label }}
                            </option>
                        </select>
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

export default {
    components: {ButtonUI, Icon},
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
            required: true
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
                { id: 1, label: 'Все' },
                { id: 2, label: 'Активные' },
                { id: 3, label: 'Неактивные' },
                { id: 4, label: 'Ожидающие' },
            ],
            selectedStatus: null, // для хранения выбранного статуса
        };
    },
    computed: {
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

        handleRowsChange() {
            this.currentPage = 1; // сбрасываем на первую страницу при изменении количества строк
        },
        toggleFilterDropdown() {
            this.isFilterDropdownVisible = !this.isFilterDropdownVisible; // Переключаем видимость выпадающего окна
            console.log('Toggle filter dropdown', this.isFilterDropdownVisible);
        },
        applyFilter() {
            // Логика для применения фильтров
            // Например, сортировка по названию и рейтингу
            this.filteredData = this.data.filter(row => {
                return this.selectedOptions.includes(row.option); // Предполагается, что есть поле "option" в данных
            });

            // Здесь можно добавить логику сортировки по nameSort и ratingSort

            this.isFilterDropdownVisible = false; // Закрываем выпадающее окно после применения фильтров
        },
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
        goToDetails: function(id) {
            this.$router.push({ path: `${this.path}${id}` });
        },
        getValue(row, key) {
            const keys = key.split('.'); // Разделяем ключи по точке
            return keys.reduce((obj, key) => (obj ? obj[key] : ''), row); // Извлекаем значение
        },
        handleStatusChange(row) {
                this.selectedStatus = row.status
        },
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
