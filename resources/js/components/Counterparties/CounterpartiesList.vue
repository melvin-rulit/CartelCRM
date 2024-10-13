<template>
    <Spinner v-show="this.loading"/>
    <Alert :errors="this.errorMessage"/>

<!--    <div class="main-content">-->
<!--        <div class="container-fluid">-->
<!--            <div class="row justify-content-center">-->
<!--                <div class="col-12">-->

<!--                    &lt;!&ndash; Header &ndash;&gt;-->
<!--                    <div class="header">-->
<!--                        <div class="header-body">-->
<!--                            <div class="row align-items-center">-->
<!--                                <div class="col">-->

<!--                                    &lt;!&ndash; Title &ndash;&gt;-->
<!--                                    <h1 class="header-title text-truncate">-->
<!--                                        Список контрагентов-->
<!--                                    </h1>-->

<!--                                </div>-->
<!--                                <div class="col-auto">-->

<!--                                    &lt;!&ndash; Navigation (button group) &ndash;&gt;-->
<!--                                    <div class="nav btn-group d-inline-flex" role="tablist">-->
<!--                                        <button class="btn btn-white active" id="contactsListTab" data-bs-toggle="tab" data-bs-target="#contactsListPane" role="tab" aria-controls="contactsListPane" aria-selected="true">-->
<!--                                            <span class="fe fe-list"></span>-->
<!--                                        </button>-->
<!--                                        <button class="btn btn-white" id="contactsCardsTab" data-bs-toggle="tab" data-bs-target="#contactsCardsPane" role="tab" aria-controls="contactsCardsPane" aria-selected="false">-->
<!--                                            <span class="fe fe-grid"></span>-->
<!--                                        </button>-->
<!--                                    </div> &lt;!&ndash; / .nav &ndash;&gt;-->

<!--                                    &lt;!&ndash; Buttons &ndash;&gt;-->
<!--                                    <a href="#!" class="btn btn-primary ms-2">-->
<!--                                        Add contact-->
<!--                                    </a>-->

<!--                                </div>-->
<!--                            </div> &lt;!&ndash; / .row &ndash;&gt;-->
<!--                            <div class="row align-items-center">-->
<!--                                <div class="col">-->

<!--                                    &lt;!&ndash; Nav &ndash;&gt;-->
<!--                                    <ul class="nav nav-tabs nav-overflow header-tabs">-->
<!--                                        <li class="nav-item">-->
<!--                                            <a href="#!" class="nav-link text-nowrap active">-->
<!--                                                All contacts <span class="badge rounded-pill bg-secondary-soft">823</span>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="nav-item">-->
<!--                                            <a href="#!" class="nav-link text-nowrap">-->
<!--                                                Your contacts <span class="badge rounded-pill bg-secondary-soft">231</span>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                        <li class="nav-item">-->
<!--                                            <a href="#!" class="nav-link text-nowrap">-->
<!--                                                Deleted <span class="badge rounded-pill bg-secondary-soft">22</span>-->
<!--                                            </a>-->
<!--                                        </li>-->
<!--                                    </ul>-->

<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    &lt;!&ndash; Cards &ndash;&gt;-->
<!--                    <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 9, "pagination": {"paginationClass": "list-pagination"}}' id="contactsCards">-->

<!--                        &lt;!&ndash; Header &ndash;&gt;-->
<!--                        <div class="row align-items-center mb-4">-->
<!--                            <div class="col">-->

<!--                                &lt;!&ndash; Form &ndash;&gt;-->
<!--                                <form>-->
<!--                                    <div class="input-group input-group-lg input-group-merge input-group-reverse">-->
<!--                                        <input class="form-control list-search" type="search" placeholder="Search">-->
<!--                                        <span class="input-group-text">-->
<!--                            <i class="fe fe-search"></i>-->
<!--                          </span>-->
<!--                                    </div>-->
<!--                                </form>-->

<!--                            </div>-->
<!--                            <div class="col-auto me-n3">-->

<!--                                &lt;!&ndash; Select &ndash;&gt;-->
<!--                                <form>-->
<!--                                    <select class="form-select form-select-sm form-control-flush" data-choices='{"searchEnabled": false}'>-->
<!--                                        <option>5 per page</option>-->
<!--                                        <option selected>10 per page</option>-->
<!--                                        <option>All</option>-->
<!--                                    </select>-->
<!--                                </form>-->

<!--                            </div>-->
<!--                        </div>-->

<!--                    </div>-->



<!--                </div>-->
<!--            </div>-->
<!--            </div>-->
<!--        </div>-->


    <div class="w-full">
        <div class="bg-white md:py-7 ">

            <div class="mt-3 overflow-x-auto">

                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-100">
                    <tr tabindex="0" class="focus:outline-none h-14 border border-gray-100 rounded divide-x">
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-700 mr-2">ФИО</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Город</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Телефон</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Telegram</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Заказов</p>
                            </div>
                        </td>
                        <td class="">

                        </td>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="counterpart of counterparties" :key="counterpart.id" tabindex="0"
                        class="focus:outline-none h-12 border border-gray-50 rounded cursor-pointer">

                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ counterpart.name }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.city }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.phone }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.telegram_login }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.telegram_login }}</p>
                            </div>
                        </td>

                        <td class="text-center">
                            <div class="flex justify-center">
                                <router-link :to="{path: '/counterparties/detail/' + counterpart.id}">
                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">
                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                </router-link>

                                <router-link :to="{path: '/counterparties/' + counterpart.id}">
                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">
                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                        </svg>
                                    </button>
                                </router-link>

                                <button @click.stop="deleteUser(counterpart.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">
                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>

                    </tr>
                    </tbody>

                </table>
                <!--                <Pagination @click="update(page)" url="users" :current-page="page" :limit="limit" :total="total" />-->
            </div>
        </div>
    </div>



<!--    <div class=" w-full">-->
<!--        <div class="bg-white py-1 ">-->

<!--&lt;!&ndash;            <div class="flex items-center justify-between">&ndash;&gt;-->
<!--&lt;!&ndash;                <h3 class="text-3xl font-extrabold dark:text-white">Контрагенты</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                <form class="flex-grow ml-4"> &lt;!&ndash; Добавлен класс ml-4 для отступа &ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="grid md:grid-cols-2 md:gap-6 rounded-full p-3">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="relative z-0 w-50 group rounded-full">&ndash;&gt;-->
<!--&lt;!&ndash;                            <TextInput @keyup="update()" v-model:value="query" title="" type="text" :placeholder="'Поиск'"/>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                </form>&ndash;&gt;-->
<!--&lt;!&ndash;            </div>&ndash;&gt;-->

<!--            <div class="mt-7 overflow-x-auto">-->

<!--                <table class="w-full whitespace-nowrap">-->
<!--                    <thead class="bg-gray-100">-->
<!--                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">-->
<!--                        <td class="">-->
<!--                            <div class="flex items-center pl-5">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-700 mr-2">ФИО</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="pl-24">-->
<!--                            <div class="flex items-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Город</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="pl-5">-->
<!--                            <div class="flex items-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Телефон</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="">-->
<!--                            <p class="text-base font-semibold leading-none text-gray-600 ml-2">Telegram</p>-->
<!--                        </td>-->
<!--                        <td class="">-->
<!--                            <p class="text-base font-semibold leading-none text-gray-600 ml-2">Заказов</p>-->
<!--                        </td>-->
<!--                        <td class="">-->

<!--                        </td>-->
<!--                    </tr>-->
<!--                    </thead>-->

<!--                    <tbody>-->
<!--                    <tr v-for="counterpart of counterparties" :key="counterpart.id" tabindex="0"-->
<!--                        class="focus:outline-none h-16 border border-gray-100 rounded hover:bg-gray-200 cursor-pointer"-->
<!--                        @click="goToCounterparty(counterpart.id)">-->

<!--                        <td class="">-->
<!--                            <div class="flex items-center pl-5">-->
<!--                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ counterpart.name }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="pl-24">-->
<!--                            <div class="flex items-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.city }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="">-->
<!--                            <div class="flex items-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.phone }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="">-->
<!--                            <div class="flex items-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.telegram_login }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="">-->
<!--                            <div class="flex items-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ counterpart.telegram_login }}</p>-->
<!--                            </div>-->
<!--                        </td>-->

<!--                        <td class="pl-4">-->
<!--                            <div class="flex">-->
<!--                                <router-link :to="{path: '/counterparties/' + counterpart.id}">-->
<!--                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">-->
<!--                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">-->
<!--                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>-->
<!--                                        </svg>-->
<!--                                    </button>-->
<!--                                </router-link>-->

<!--                                <button @click.stop="deleteUser(counterpart.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">-->
<!--                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">-->
<!--                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>-->
<!--                                    </svg>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                        </td>-->

<!--                    </tr>-->
<!--                    </tbody>-->

<!--                </table>-->
<!--&lt;!&ndash;                <Pagination @click="update(page)" url="users" :current-page="page" :limit="limit" :total="total" />&ndash;&gt;-->
<!--            </div>-->
<!--&lt;!&ndash;            <router-link to="/counterparties/create"&ndash;&gt;-->
<!--&lt;!&ndash;                         class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded"&ndash;&gt;-->
<!--&lt;!&ndash;                         type="button">&ndash;&gt;-->
<!--&lt;!&ndash;                <p class="text-sm font-medium leading-none text-white">Добавить контрагента</p>&ndash;&gt;-->
<!--&lt;!&ndash;            </router-link>&ndash;&gt;-->
<!--        </div>-->
<!--    </div>-->

</template>

<script>
import Pagination from "../forms/Pagination.vue";
import TextInput from "../forms/TextInput.vue";
import _ from "lodash"
import Spinner from "../forms/Spinner.vue";
import Alert from "../forms/Alert.vue";
import {CounterpartiesService} from "../../services/CounterpartiesService";

export default {
    components: {Alert, Spinner, TextInput, Pagination},
    data: function () {
        return {
            counterparties: [],
            loading: false,
            errorMessage: null,
            query: '',
            limit: 5,
            total: 1
        }
    },
    name: "CounterpartiesList",
    created:  function () {
        this.update(this.page)
    },
    methods: {
        update:  function () {
            this.loading = true
            CounterpartiesService.getCounterparties(this.page, this.query)
                .then(response => {
                this.counterparties = response.data.counterparties
                this.limit = response.data.limit
                this.total = response.data.total
            })
                .catch(error => this.errors = error.data.message || error)
                .finally(() => this.loading = false)
        },

        goToCounterparty(id) {
            this.$router.push({ path: '/counterparties/detail/' + id });
        },

        deleteUser: function(id) {
            if (confirm('Вы действительно хотите удалить пользователя?')) {
                CounterpartiesService.delete(id)
                    .then(() => this.update(this.page))
                    .catch(error => this.errorMessage = error.response.data.error)
            }
        }
    },
    computed: {
        page() {
            return Number(this.$route.query.page) ?? 1;
        }
    },
    watch: {
        'query': _.debounce(function () {
            this.update()
        }, 500)
    }
}
</script>
