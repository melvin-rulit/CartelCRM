<!--<template>-->
<!--    <Spinner v-show="this.loading" />-->
<!--    <Alert :errors="this.errorMessage"/>-->



<!--&lt;!&ndash;                        <td class="text-center">&ndash;&gt;-->
<!--                        <td class="text-center w-20">-->
<!--&lt;!&ndash;                            <div class="flex justify-center">&ndash;&gt;-->
<!--                            <div class="">-->
<!--                                <router-link :to="{path: '/providers/detail/' + provider.id}">-->
<!--                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 mr-2 ml-4 rounded bg-gray-200 hover:bg-gray-300 focus:outline-none">-->
<!--Перейти к заказу-->
<!--                                    </button>-->
<!--&lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="size-6">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />&ndash;&gt;-->
<!--&lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />&ndash;&gt;-->
<!--&lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--                                </router-link>-->

<!--                                <router-link :to="{path: '/providers/' + provider.id}">-->
<!--                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 mr-2 rounded bg-gray-200 hover:bg-gray-300 focus:outline-none">-->
<!--Редактировать-->
<!--                                    </button>-->
<!--&lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--                                </router-link>-->

<!--                                <button @click.stop="deleteUser(provider.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 mr-4 rounded bg-red-100 hover:bg-red-200 focus:outline-none">-->
<!--                                    Удалить-->
<!--&lt;!&ndash;                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </svg>&ndash;&gt;-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </td>-->

<!--                    </tr>-->
<!--                    </tbody>-->

<!--                </table>-->
<!--                &lt;!&ndash;                <Pagination @click="update(page)" url="users" :current-page="page" :limit="limit" :total="total" />&ndash;&gt;-->
<!--            </div>-->

<!--&lt;!&ndash;            <router-link to="/providers/create"&ndash;&gt;-->
<!--&lt;!&ndash;                         class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded"&ndash;&gt;-->
<!--&lt;!&ndash;                         type="button">&ndash;&gt;-->
<!--&lt;!&ndash;                <p class="text-sm font-medium leading-none text-white">Добавить поставщика</p>&ndash;&gt;-->
<!--&lt;!&ndash;            </router-link>&ndash;&gt;-->
<!--        </div>-->
<!--    </div>-->

<!--</template>-->

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
<!--        &lt;!&ndash;        <div v-if="isFilterDropdownVisible" class="filter-dropdown">&ndash;&gt;-->
<!--        &lt;!&ndash;            <h3>Фильтр</h3>&ndash;&gt;-->
<!--        &lt;!&ndash;            <div class="filter-item">&ndash;&gt;-->
<!--        &lt;!&ndash;                <label for="name-filter">Название</label>&ndash;&gt;-->
<!--        &lt;!&ndash;                <select v-model="nameSort">&ndash;&gt;-->
<!--        &lt;!&ndash;                    <option value="asc">По возрастанию</option>&ndash;&gt;-->
<!--        &lt;!&ndash;                    <option value="desc">По убыванию</option>&ndash;&gt;-->
<!--        &lt;!&ndash;                </select>&ndash;&gt;-->
<!--        &lt;!&ndash;            </div>&ndash;&gt;-->
<!--        &lt;!&ndash;            <div class="filter-item">&ndash;&gt;-->
<!--        &lt;!&ndash;                <label for="rating-filter">Рейтинг</label>&ndash;&gt;-->
<!--        &lt;!&ndash;                <select v-model="ratingSort">&ndash;&gt;-->
<!--        &lt;!&ndash;                    <option value="asc">По возрастанию</option>&ndash;&gt;-->
<!--        &lt;!&ndash;                    <option value="desc">По убыванию</option>&ndash;&gt;-->
<!--        &lt;!&ndash;                </select>&ndash;&gt;-->
<!--        &lt;!&ndash;            </div>&ndash;&gt;-->
<!--        &lt;!&ndash;            <div class="filter-checkboxes">&ndash;&gt;-->
<!--        &lt;!&ndash;                <h4>Выбор опций</h4>&ndash;&gt;-->
<!--        &lt;!&ndash;                <label v-for="option in checkboxOptions" :key="option.id">&ndash;&gt;-->
<!--        &lt;!&ndash;                    <input type="checkbox" v-model="selectedOptions" :value="option.value" />&ndash;&gt;-->
<!--        &lt;!&ndash;                    {{ option.label }}&ndash;&gt;-->
<!--        &lt;!&ndash;                </label>&ndash;&gt;-->
<!--        &lt;!&ndash;            </div>&ndash;&gt;-->
<!--        &lt;!&ndash;            <ButtonUI @click="applyFilter">Применить</ButtonUI>&ndash;&gt;-->
<!--        &lt;!&ndash;        </div>&ndash;&gt;-->

<!--        &lt;!&ndash; Вторая строка: чекбокс выбора всех, настраиваемые заголовки колонок &ndash;&gt;-->
<!--        <table>-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th class="checkbox">-->
<!--                    <input type="checkbox" @change="toggleSelectAll" v-model="selectAll" />-->
<!--                </th>-->
<!--                <th v-for="(column, index) in columns" :key="index">{{ column }}</th>-->
<!--                <th>ФИО</th>-->
<!--                <th>Город</th>-->
<!--                <th>Телефон</th>-->
<!--                <th>Логин в телеграм</th>-->
<!--                <th>Заказов</th>-->
<!--                &lt;!&ndash;                <th>Пароль</th>&ndash;&gt;-->
<!--            </tr>-->
<!--            </thead>-->

<!--            &lt;!&ndash; Строки с данными &ndash;&gt;-->
<!--            <tbody>-->
<!--            <tr v-for="provider of providers" :key="provider.id" tabindex="0"-->
<!--                class="focus:outline-none h-12 border border-gray-50 rounded cursor-pointer"-->
<!--                @click="toDetail(user.id)">-->

<!--                <td class="text-center">-->
<!--                    <div class="flex items-center justify-center">-->
<!--                        <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ provider.id }}</p>-->
<!--                    </div>-->
<!--                </td>-->
<!--                <td class="text-center">-->
<!--                    <div class="flex items-center justify-center">-->
<!--                        <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ provider.name }}</p>-->
<!--                    </div>-->
<!--                </td>-->
<!--                <td class="text-center">-->
<!--                    <div class="flex items-center justify-center">-->
<!--                        <p class="text-sm leading-none text-gray-600 ml-2">{{ provider.city }}</p>-->
<!--                    </div>-->
<!--                </td>-->
<!--                <td class="text-center">-->
<!--                    <div class="flex items-center justify-center">-->
<!--                        <p class="text-sm leading-none text-gray-600 ml-2">{{ provider.telegram_login }}</p>-->
<!--                    </div>-->
<!--                </td>-->
<!--                &lt;!&ndash;                                    <td v-show="this.role === 'admin'" class="text-center">&ndash;&gt;-->
<!--                &lt;!&ndash;                                        <div class="flex items-center justify-center">&ndash;&gt;-->
<!--                &lt;!&ndash;                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.password_see }}</p>&ndash;&gt;-->
<!--                &lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--                &lt;!&ndash;                                    </td>&ndash;&gt;-->

<!--                &lt;!&ndash;                        <td class="text-center">&ndash;&gt;-->
<!--                &lt;!&ndash;                            <div class="flex justify-center">&ndash;&gt;-->
<!--                &lt;!&ndash;                                <router-link :to="{path: '/counterparties/detail/' + user.id}">&ndash;&gt;-->
<!--                &lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--                &lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="size-6">&ndash;&gt;-->
<!--                &lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />&ndash;&gt;-->
<!--                &lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />&ndash;&gt;-->
<!--                &lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--                &lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--                &lt;!&ndash;                                </router-link>&ndash;&gt;-->

<!--                &lt;!&ndash;                                <router-link :to="{path: '/counterparties/' + user.id}">&ndash;&gt;-->
<!--                &lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--                &lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--                &lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>&ndash;&gt;-->
<!--                &lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--                &lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--                &lt;!&ndash;                                </router-link>&ndash;&gt;-->

<!--                &lt;!&ndash;                                <button @click.stop="deleteUser(user.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">&ndash;&gt;-->
<!--                &lt;!&ndash;                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--                &lt;!&ndash;                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>&ndash;&gt;-->
<!--                &lt;!&ndash;                                    </svg>&ndash;&gt;-->
<!--                &lt;!&ndash;                                </button>&ndash;&gt;-->
<!--                &lt;!&ndash;                            </div>&ndash;&gt;-->
<!--                &lt;!&ndash;                        </td>&ndash;&gt;-->

<!--            </tr>-->
<!--            </tbody>-->
<!--&lt;!&ndash;            <tbody>&ndash;&gt;-->

<!--&lt;!&ndash;            <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex">&ndash;&gt;-->
<!--&lt;!&ndash;                <td><input type="checkbox" v-model="selectedRows" :value="row" /></td>&ndash;&gt;-->
<!--&lt;!&ndash;                &lt;!&ndash;                <td v-for="(column, index) in columns" :key="index">{{ row[column] }}</td>&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;            </tr>&ndash;&gt;-->
<!--&lt;!&ndash;            </tbody>&ndash;&gt;-->
<!--        </table>-->

<!--        &lt;!&ndash; Пагинация &ndash;&gt;-->
<!--                <div class="table-footer">-->
<!--                    <button @click="goToPreviousPage" :disabled="currentPage === 1"><Icon icon="ic:round-arrow-back" class="logo" />Назад</button>-->
<!--                    <div class="pagination-numbers">-->
<!--&lt;!&ndash;                        <button v-for="page in totalPagesArray" :key="page" :class="{ active: page === currentPage }" @click="goToPage(page)">&ndash;&gt;-->
<!--&lt;!&ndash;                            {{ page }}&ndash;&gt;-->
<!--&lt;!&ndash;                        </button>&ndash;&gt;-->
<!--                    </div>-->
<!--                    <button @click="goToNextPage" :disabled="currentPage === totalPages">Вперед<Icon icon="ic:round-arrow-forward" class="logo" /></button>-->
<!--                </div>-->
<!--    </div>-->
<!--</template>-->

<template>
    <div>
        <Header title="Поставщики">
            <ButtonUI @click="goToAdd">Добавить поставщика</ButtonUI>
        </Header>
        <hr>

        <Table
            :data="providers"
            :columns="columns"
            :rowsPerPageOptions="[5, 10, 25]"
            :path="'/providers/detail/'"
        />
    </div>
</template>

<script>
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import _ from "lodash";
import {ProvideService} from "../../services/ProvideService";
import Spinner from "../forms/Spinner.vue";
import ButtonUI from "../UI/ButtonUI.vue";
import Header from "../Header.vue";
import Table from "../forms/Table.vue";

export default {
    components: {Table, Header, ButtonUI, Spinner, Alert, TextInput},
    data: function () {
        return {
            providers: [],
            loading: false,
            errorMessage: null,
            // query: null,
            // limit: 5,
            // total: 1,

            // Названия колонок
            columns: [
                { label: 'ФИО', key: 'full_name' },
                { label: 'Город', key: 'city' },
                { label: 'Телефон', key: 'phone' },
                { label: 'Логин в телеграм', key: 'telegram_login' },
                { label: 'Заказов', key: '' },
            ],
        }
    },
    name: "ProvidersList",
    created: async function () {
        this.update()
    },
    methods: {
        update:  function () {
            this.loading = true
            ProvideService.getProvides(this.page, this.query)
                .then(response => {
                    this.providers = response.data.providers
                    // this.limit = response.data.limit
                    // this.total = response.data.total
                })
                .catch(error => this.errors = error.data.message || error)
                .finally(() => this.loading = false)
        },
        goToAdd() {
            this.$router.push({ path: '/providers/create'});
        },
    },
}
</script>
