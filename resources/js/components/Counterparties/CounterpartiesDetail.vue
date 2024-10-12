<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Детальная информация контрагента</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>

                <div class="grid md:grid-cols-3 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <TextOnly title="Фамилия" v-model:value="counterparties.lastName" type="text"  :isEditable="false"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextOnly title="Имя" v-model:value="counterparties.firstName" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextOnly title="Отчество" v-model:value="counterparties.middleName" type="text"/>
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <TextOnly title="Город" v-model:value="counterparties.city" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextOnly title="Телефон" v-model:value="counterparties.phone" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextOnly title="Телеграм" v-model:value="counterparties.telegram_login" type="text"/>
                    </div>
                </div>

            <h3 class="mb-4 mt-4 text-xl font-medium text-gray-900 dark:text-white">Заказы контрагента</h3>

            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-100">
                <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-semibold leading-none text-gray-700 mr-2">Номер заказа</p>
                        </div>
                    </td>
                    <td class="pl-24">
                        <div class="flex items-center">
                            <p class="text-base font-semibold leading-none text-gray-600 ml-2">Дата заказа</p>
                        </div>
                    </td>
                    <td class="pl-5">
                        <div class="flex items-center">
                            <p class="text-base font-semibold leading-none text-gray-600 ml-2">Статус заказа</p>
                        </div>
                    </td>
                    <td class="">
                        <p class="text-base font-semibold leading-none text-gray-600 ml-2">Состав заказа</p>
                    </td>
                    <td class="">
                        <p class="text-base font-semibold leading-none text-gray-600 ml-2">Сумма заказа
                        </p>
                    </td>
                    <td class="">

                    </td>
                </tr>
                </thead>

                <tbody>
                <tr v-for="order of orders" :key="order.id" tabindex="0"
                    class="focus:outline-none h-16 border border-gray-100 rounded hover:bg-gray-200 cursor-pointer"
                    @click="goToOrder(order.id)">

                    <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ order.order_number }}</p>
                        </div>
                    </td>
                    <td class="pl-24">
                        <div class="flex items-center">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.order_date }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.status }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.order_details }}</p>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.order_price }}</p>
                        </div>
                    </td>

                    <td class="pl-4">
                        <div class="flex">
                            <router-link :to="{path: '/orders/detail' + order.id}">
                                <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">
                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                    </svg>
                                </button>
                            </router-link>

                            <button @click.stop="order(order.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">
                                <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                </svg>
                            </button>
                        </div>
                    </td>

                </tr>
                </tbody>

            </table>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/counterparties" type="button"
                                 class="text-sm font-semibold leading-6 text-gray-900">Назад
                    </router-link>
                </div>

        </div>
    </div>
</template>

<script>
import TextOnly from "../forms/TextOnly.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Select from "../forms/Select.vue";
import Checkbox from "../forms/Checkbox.vue";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import {CounterpartiesService} from "../../services/CounterpartiesService";

export default {
    name: "CounterpartiesDetail",
    components: {Textarea, DateInput, Select, Alert, TextOnly, Success, Checkbox},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            userRoles: [],
            branches: [],
            counterparties: {
                'firstName': '',
                'middleName': '',
                'lastName': '',
                'city': '',
                'phone': '',
                'telegram_login': '',
            },
            orders: {
                'order_number': '',
                'order_date': '',
                'status': '',
                'order_details': '',
                'order_price': '',
            },
            errors: null,
            submitted: false,
            message: null
        }
    },
    created() {
        CounterpartiesService.getById(this.id)
            .then(response => this.counterparties = response.data.counterparties)
            .catch(error => {
                this.errors = error.response.data.message
            })
        // UserService.getRoles().then(response => this.userRoles = response.data.roles)
        CounterpartiesService.getOrders()
            .then(response => this.orders = response.data.orders)
    },
    methods: {
        goToOrder(id) {
            this.$router.push({ path: '/orders/detail/' + id });
        },

        // update: async function (event) {
        //     event.preventDefault()
        //     this.errors = null
        // }
    }
}
</script>
