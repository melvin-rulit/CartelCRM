<!--<template>-->
<!--    <div class="container">-->

<!--        &lt;!&ndash; Первая строка: поиск, выпадающий список для количества строк, кнопка фильтр &ndash;&gt;-->
<!--        <div class="header">-->
<!--            <Icon icon="ic:baseline-search" class="bottom-icon" />-->
<!--            <input-->
<!--                class="form-control"-->
<!--                v-model="searchQuery"-->
<!--                @input="handleSearch"-->
<!--                type="text"-->
<!--                placeholder="Поиск"-->
<!--            />-->
<!--            <select v-model="rowsPerPage" @change="handleRowsChange">-->
<!--                <option-->
<!--                    v-for="option in rowsPerPageOptions"-->
<!--                    :key="option"-->
<!--                    :value="option"-->
<!--                >-->
<!--                    {{ option }} на стр.-->
<!--                </option>-->
<!--            </select>-->
<!--            <ButtonUI-->
<!--                color="white"-->
<!--                fontSize="11px"-->
<!--                padding="5px 10px"-->
<!--                fontWeight="500"-->
<!--                @click="toggleFilterDropdown"-->
<!--            >-->
<!--                <Icon icon="jam:settings-alt" class="ico" />Фильтр-->
<!--            </ButtonUI>-->
<!--        </div>-->

<!--        &lt;!&ndash; Выпадающее окно фильтрации &ndash;&gt;-->
<!--&lt;!&ndash;        <div v-if="isFilterDropdownVisible" class="filter-dropdown">&ndash;&gt;-->
<!--&lt;!&ndash;            <h3>Фильтр</h3>&ndash;&gt;-->
<!--&lt;!&ndash;            <div class="filter-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <label for="name-filter">Название</label>&ndash;&gt;-->
<!--&lt;!&ndash;                <select v-model="nameSort">&ndash;&gt;-->
<!--&lt;!&ndash;                    <option value="asc">По возрастанию</option>&ndash;&gt;-->
<!--&lt;!&ndash;                    <option value="desc">По убыванию</option>&ndash;&gt;-->
<!--&lt;!&ndash;                </select>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--&lt;!&ndash;            <div class="filter-item">&ndash;&gt;-->
<!--&lt;!&ndash;                <label for="rating-filter">Рейтинг</label>&ndash;&gt;-->
<!--&lt;!&ndash;                <select v-model="ratingSort">&ndash;&gt;-->
<!--&lt;!&ndash;                    <option value="asc">По возрастанию</option>&ndash;&gt;-->
<!--&lt;!&ndash;                    <option value="desc">По убыванию</option>&ndash;&gt;-->
<!--&lt;!&ndash;                </select>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--&lt;!&ndash;            <div class="filter-checkboxes">&ndash;&gt;-->
<!--&lt;!&ndash;                <h4>Выбор опций</h4>&ndash;&gt;-->
<!--&lt;!&ndash;                <label v-for="option in checkboxOptions" :key="option.id">&ndash;&gt;-->
<!--&lt;!&ndash;                    <input type="checkbox" v-model="selectedOptions" :value="option.value" />&ndash;&gt;-->
<!--&lt;!&ndash;                    {{ option.label }}&ndash;&gt;-->
<!--&lt;!&ndash;                </label>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->
<!--&lt;!&ndash;            <ButtonUI @click="applyFilter">Применить</ButtonUI>&ndash;&gt;-->
<!--&lt;!&ndash;        </div>&ndash;&gt;-->

<!--        &lt;!&ndash; Вторая строка: чекбокс выбора всех, настраиваемые заголовки колонок &ndash;&gt;-->
<!--        <table>-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th class="checkbox">-->
<!--                    <input type="checkbox" @change="toggleSelectAll" v-model="selectAll" />-->
<!--                </th>-->
<!--                <th v-for="(column, index) in columns" :key="index">{{ column }}</th>-->
<!--                <th>ФИО</th>-->
<!--                <th>Дата рождения</th>-->
<!--                <th>Email-адрес</th>-->
<!--&lt;!&ndash;                <th>Серия паспорта</th>&ndash;&gt;-->
<!--&lt;!&ndash;                <th>Номер паспорта</th>&ndash;&gt;-->
<!--&lt;!&ndash;                <th>Кем выдан паспорт</th>&ndash;&gt;-->
<!--&lt;!&ndash;                <th>Дата выдачи паспорта</th>&ndash;&gt;-->
<!--&lt;!&ndash;                <th>Адрес регистрации</th>&ndash;&gt;-->
<!--&lt;!&ndash;                <th>Фактическое место жительства</th>&ndash;&gt;-->
<!--                <th>Телефон контактный</th>-->
<!--                <th>Логин в телеграм</th>-->
<!--&lt;!&ndash;                <th>Пароль</th>&ndash;&gt;-->
<!--            </tr>-->
<!--            </thead>-->

<!--            &lt;!&ndash; Строки с данными &ndash;&gt;-->
<!--                                <tbody>-->
<!--                                <tr v-for="user of users" :key="user.id" tabindex="0"-->
<!--                                    class="focus:outline-none h-12 border border-gray-50 rounded cursor-pointer"-->
<!--                                    @click="toDetail(user.id)">-->

<!--                                    <td class="text-center">-->
<!--                                        <div class="flex items-center justify-center">-->
<!--                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ user.id }}</p>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td class="text-center">-->
<!--                                        <div class="flex items-center justify-center">-->
<!--                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ user.full_name }}</p>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td class="text-center">-->
<!--                                        <div class="flex items-center justify-center">-->
<!--                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.birthday }}</p>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td class="text-center">-->
<!--                                        <div class="flex items-center justify-center">-->
<!--                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.email }}</p>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--&lt;!&ndash;                                    <td class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_series }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <td class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_number }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <td class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_give }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <td class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_issuedByDate }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <td class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.registration_address }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <td class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.live_adress }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </td>&ndash;&gt;-->
<!--                                    <td class="text-center">-->
<!--                                        <div class="flex items-center justify-center">-->
<!--                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.phone_number }}</p>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                    <td class="text-center">-->
<!--                                        <div class="flex items-center justify-center">-->
<!--                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.telegram }}</p>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--&lt;!&ndash;                                    <td v-show="this.role === 'admin'" class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.password_see }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </td>&ndash;&gt;-->

<!--            &lt;!&ndash;                        <td class="text-center">&ndash;&gt;-->
<!--            &lt;!&ndash;                            <div class="flex justify-center">&ndash;&gt;-->
<!--            &lt;!&ndash;                                <router-link :to="{path: '/counterparties/detail/' + user.id}">&ndash;&gt;-->
<!--            &lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--            &lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="size-6">&ndash;&gt;-->
<!--            &lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />&ndash;&gt;-->
<!--            &lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />&ndash;&gt;-->
<!--            &lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--            &lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--            &lt;!&ndash;                                </router-link>&ndash;&gt;-->

<!--            &lt;!&ndash;                                <router-link :to="{path: '/counterparties/' + user.id}">&ndash;&gt;-->
<!--            &lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--            &lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--            &lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>&ndash;&gt;-->
<!--            &lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--            &lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--            &lt;!&ndash;                                </router-link>&ndash;&gt;-->

<!--            &lt;!&ndash;                                <button @click.stop="deleteUser(user.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">&ndash;&gt;-->
<!--            &lt;!&ndash;                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--            &lt;!&ndash;                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>&ndash;&gt;-->
<!--            &lt;!&ndash;                                    </svg>&ndash;&gt;-->
<!--            &lt;!&ndash;                                </button>&ndash;&gt;-->
<!--            &lt;!&ndash;                            </div>&ndash;&gt;-->
<!--            &lt;!&ndash;                        </td>&ndash;&gt;-->

<!--                                </tr>-->
<!--                                </tbody>-->
<!--            <tbody>-->

<!--            <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex">-->
<!--                <td><input type="checkbox" v-model="selectedRows" :value="row" /></td>-->
<!--&lt;!&ndash;                <td v-for="(column, index) in columns" :key="index">{{ row[column] }}</td>&ndash;&gt;-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </table>-->

<!--        &lt;!&ndash; Пагинация &ndash;&gt;-->
<!--        <div class="table-footer">-->
<!--            <button @click="goToPreviousPage" :disabled="currentPage === 1"><Icon icon="ic:round-arrow-back" class="logo" />Назад</button>-->
<!--            <div class="pagination-numbers">-->
<!--&lt;!&ndash;                <button v-for="page in totalPagesArray" :key="page" :class="{ active: page === currentPage }" @click="goToPage(page)">&ndash;&gt;-->
<!--&lt;!&ndash;                    {{ page }}&ndash;&gt;-->
<!--&lt;!&ndash;                </button>&ndash;&gt;-->
<!--            </div>-->
<!--            <button @click="goToNextPage" :disabled="currentPage === totalPages">Вперед<Icon icon="ic:round-arrow-forward" class="logo" /></button>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--import {UserService} from "../../services/UserService";-->
<!--import Pagination from "../forms/Pagination.vue";-->
<!--import TextInput from "../forms/TextInput.vue";-->
<!--import _ from "lodash"-->
<!--import Spinner from "../forms/Spinner.vue";-->
<!--import Alert from "../forms/Alert.vue";-->
<!--import { Icon } from '@iconify/vue';-->
<!--import ButtonUI from "../UI/ButtonUI.vue";-->

<!--export default {-->
<!--    components: {Icon, Alert, Spinner, TextInput, Pagination, ButtonUI},-->
<!--    props: {-->
<!--        data: {-->
<!--            type: Array,-->
<!--            required: true,-->
<!--        },-->
<!--        rowsPerPageOptions: {-->
<!--            type: Array,-->
<!--            default: () => [10, 25, 50, 100],-->
<!--        },-->
<!--    },-->
<!--    data: function () {-->
<!--        return {-->
<!--            users: [],-->
<!--            role: '',-->
<!--            loading: false,-->
<!--            errorMessage: null,-->
<!--            query: '',-->
<!--            limit: 5,-->
<!--            total: 1,-->

<!--            searchQuery: "",-->
<!--            rowsPerPage: 10,-->
<!--            filteredData: this.data,-->
<!--            selectedRows: [],-->
<!--            selectAll: false,-->
<!--            currentPage: 1,-->
<!--            isFilterDropdownVisible: false, // Состояние видимости выпадающего окна-->
<!--            nameSort: "asc", // Для сортировки названия-->
<!--            ratingSort: "asc", // Для сортировки рейтинга-->
<!--            checkboxOptions: [-->
<!--                { id: 1, label: 'Опция 1', value: 'option1' },-->
<!--                { id: 2, label: 'Опция 2', value: 'option2' },-->
<!--                { id: 3, label: 'Опция 3', value: 'option3' },-->
<!--                { id: 4, label: 'Опция 4', value: 'option4' },-->
<!--                { id: 5, label: 'Опция 5', value: 'option5' },-->
<!--                { id: 6, label: 'Опция 6', value: 'option6' },-->
<!--                { id: 7, label: 'Опция 7', value: 'option7' },-->
<!--                { id: 8, label: 'Опция 8', value: 'option8' },-->
<!--            ],-->
<!--            selectedOptions: [], // Для выбранных чекбоксов-->
<!--        }-->
<!--    },-->
<!--    name: "UsersList",-->
<!--    created:  function () {-->
<!--        this.update(this.page)-->
<!--    },-->
<!--    methods: {-->
<!--        update:  function () {-->
<!--            this.loading = true-->
<!--            UserService.currentUser().then(response => {-->
<!--                this.role = response.data.role-->
<!--            })-->
<!--            UserService.getUsers(this.page, this.query)-->
<!--                .then(response => {-->
<!--                    console.log(response);-->
<!--                this.users = response.data.users-->
<!--                // this.limit = response.data.limit-->
<!--                // this.total = response.data.total-->
<!--            })-->
<!--                .catch(error => this.errors = error.data.message || error)-->
<!--                .finally(() => this.loading = false)-->
<!--        },-->
<!--        handleSearch() {-->
<!--            this.filteredData = this.data.filter((row) =>-->
<!--                this.columns.some((col) =>-->
<!--                    String(row[col])-->
<!--                        .toLowerCase()-->
<!--                        .includes(this.searchQuery.toLowerCase())-->
<!--                )-->
<!--            );-->
<!--            this.currentPage = 1; // сбрасываем на первую страницу после поиска-->
<!--        },-->
<!--        handleRowsChange() {-->
<!--            this.currentPage = 1; // сбрасываем на первую страницу при изменении количества строк-->
<!--        },-->
<!--        toggleFilterDropdown() {-->
<!--            this.isFilterDropdownVisible = !this.isFilterDropdownVisible; // Переключаем видимость выпадающего окна-->
<!--            console.log('Toggle filter dropdown', this.isFilterDropdownVisible);-->
<!--        },-->
<!--        applyFilter() {-->
<!--            // Логика для применения фильтров-->
<!--            // Например, сортировка по названию и рейтингу-->
<!--            this.filteredData = this.data.filter(row => {-->
<!--                return this.selectedOptions.includes(row.option); // Предполагается, что есть поле "option" в данных-->
<!--            });-->

<!--            // Здесь можно добавить логику сортировки по nameSort и ratingSort-->

<!--            this.isFilterDropdownVisible = false; // Закрываем выпадающее окно после применения фильтров-->
<!--        },-->
<!--        toggleSelectAll() {-->
<!--            if (this.selectAll) {-->
<!--                this.selectedRows = [...this.paginatedData];-->
<!--            } else {-->
<!--                this.selectedRows = [];-->
<!--            }-->
<!--        },-->
<!--        goToPage(page) {-->
<!--            this.currentPage = page;-->
<!--        },-->
<!--        goToPreviousPage() {-->
<!--            if (this.currentPage > 1) {-->
<!--                this.currentPage&#45;&#45;;-->
<!--            }-->
<!--        },-->
<!--        goToNextPage() {-->
<!--            if (this.currentPage < this.totalPages) {-->
<!--                this.currentPage++;-->
<!--            }-->
<!--        },-->

<!--        toDetail: function(id) {-->
<!--            this.$router.push({ path: '/users/' + id });-->
<!--        },-->

<!--        deleteUser: function(id) {-->
<!--            if (confirm('Вы действительно хотите удалить пользователя?')) {-->
<!--                UserService.delete(id)-->
<!--                    .then(() => this.update(this.page))-->
<!--                    .catch(error => this.errorMessage = error.response.data.error)-->
<!--            }-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        page() {-->
<!--            return Number(this.$route.query.page) ?? 1;-->
<!--        },-->
<!--        totalPages() {-->
<!--            return Math.ceil(this.filteredData.length / this.rowsPerPage);-->
<!--        },-->
<!--        totalPagesArray() {-->
<!--            // Отображаем максимум 3 страницы-->
<!--            const pages = [];-->
<!--            for (let i = 1; i <= this.totalPages && i <= 3; i++) {-->
<!--                pages.push(i);-->
<!--            }-->
<!--            return pages;-->
<!--        },-->
<!--        paginatedData() {-->
<!--            const startIndex = (this.currentPage - 1) * this.rowsPerPage;-->
<!--            return this.filteredData.slice(startIndex, startIndex + this.rowsPerPage);-->
<!--        },-->
<!--    },-->
<!--    watch: {-->
<!--        'query': _.debounce(function () {-->
<!--            this.update()-->
<!--        }, 500),-->
<!--        // data: {-->
<!--        //     handler(newData) {-->
<!--        //         this.filteredData = newData;-->
<!--        //     },-->
<!--        //     deep: true,-->
<!--        // },-->
<!--    }-->
<!--}-->
<!--</script>-->


<template>
    <div>
        <Header title="Пользователи" />
        <hr>

        <Table
            :data="employees"
            :columns="columns"
            :rowsPerPageOptions="[5, 10, 25]"
        />
    </div>
</template>

<script>
import {UserService} from "../../services/UserService";
import Table from '../forms/Table.vue';
import Header from "../Header.vue";

export default {
    components: {
        Header,
        Table,
    },
    data() {
        return {
            // Названия колонок
            columns: ['Имя', 'Работа', 'Почта', 'Телефон', 'Компания'],
            // Данные сотрудников
            employees: [
                { Имя: 'Иван Иванов', Работа: 'Разработчик', Почта: 'ivan@mail.com', Телефон: '+123456789', Компания: 'Tech Co.' },
                { Имя: 'Анна Смирнова', Работа: 'Дизайнер', Почта: 'anna@mail.com', Телефон: '+987654321', Компания: 'Design Studio' },
                { Имя: 'Петр Петров', Работа: 'Менеджер', Почта: 'petr@mail.com', Телефон: '+123987654', Компания: 'Sales Corp.' },
                { Имя: 'Сергей Кузнецов', Работа: 'Аналитик', Почта: 'sergey@mail.com', Телефон: '+789456123', Компания: 'Data Solutions' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
                { Имя: 'Ольга Соколова', Работа: 'Маркетолог', Почта: 'olga@mail.com', Телефон: '+456789123', Компания: 'Marketing World' },
            ],
        };
    },
    methods: {
        update:  function () {
            this.loading = true
            UserService.currentUser().then(response => {
                this.role = response.data.role
            })
            UserService.getUsers(this.page, this.query)
                .then(response => {
                    console.log(response);
                    this.users = response.data.users
                    // this.limit = response.data.limit
                    // this.total = response.data.total
                })
                .catch(error => this.errors = error.data.message || error)
                .finally(() => this.loading = false)
        },
    }
};
</script>
