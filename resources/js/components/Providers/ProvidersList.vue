<template>
    <Spinner v-show="this.loading" />
    <Alert :errors="this.errorMessage"/>

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
                    <tr v-for="provider of providers" :key="provider.id" tabindex="0"
                        class="focus:outline-none h-12 border border-gray-50 rounded cursor-pointer">

                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ provider.name }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ provider.city }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ provider.phone }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ provider.telegram_login }}</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ provider.telegram_login }}</p>
                            </div>
                        </td>

<!--                        <td class="text-center">-->
                        <td class="text-center w-20">
<!--                            <div class="flex justify-center">-->
                            <div class="">
                                <router-link :to="{path: '/providers/detail/' + provider.id}">
                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 mr-2 ml-4 rounded bg-gray-200 hover:bg-gray-300 focus:outline-none">
Перейти к заказу
                                    </button>
<!--                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">-->
<!--                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="size-6">-->
<!--                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />-->
<!--                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />-->
<!--                                        </svg>-->
<!--                                    </button>-->
                                </router-link>

                                <router-link :to="{path: '/providers/' + provider.id}">
                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 mr-2 rounded bg-gray-200 hover:bg-gray-300 focus:outline-none">
Редактировать
                                    </button>
<!--                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">-->
<!--                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">-->
<!--                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>-->
<!--                                        </svg>-->
<!--                                    </button>-->
                                </router-link>

                                <button @click.stop="deleteUser(provider.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 mr-4 rounded bg-red-100 hover:bg-red-200 focus:outline-none">
                                    Удалить
<!--                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">-->
<!--                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>-->
<!--                                    </svg>-->
                                </button>
                            </div>
                        </td>

                    </tr>
                    </tbody>

                </table>
                <!--                <Pagination @click="update(page)" url="users" :current-page="page" :limit="limit" :total="total" />-->
            </div>

<!--            <router-link to="/providers/create"-->
<!--                         class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded"-->
<!--                         type="button">-->
<!--                <p class="text-sm font-medium leading-none text-white">Добавить поставщика</p>-->
<!--            </router-link>-->
        </div>
    </div>

</template>

<script>
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import _ from "lodash";
import {ProvideService} from "../../services/ProvideService";
import Spinner from "../forms/Spinner.vue";

export default {
    components: {Spinner, Alert, TextInput},
    data: function () {
        return {
            loading: false,
            providers: [],
            errorMessage: null,
            query: null
        }
    },
    name: "ProvidersList",
    created: async function () {
        this.update()
    },
    methods: {

        update: function () {
            this.loading = true;
            ProvideService.getProvides(this.query)
                .then(response => this.providers = response.data.providers)
                .catch(error => this.errorMessage = error)
                .finally(() => this.loading = false)
        }
    },
    watch: {
        'query': _.debounce(function () {
            this.update()
        }, 500)
    }
}
</script>
