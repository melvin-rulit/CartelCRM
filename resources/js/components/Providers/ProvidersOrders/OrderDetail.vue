<!--<template>-->
<!--    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">-->
<!--        <div class="px-6 py-6 lg:px-8">-->
<!--            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Детальная информация заказа</h3>-->
<!--            <Alert :errors="errors"/>-->
<!--            <Success :message="message"/>-->

<!--&lt;!&ndash;                <div class="grid md:grid-cols-3 md:gap-6">&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="relative z-0 w-full mb-6 group">&ndash;&gt;-->
<!--&lt;!&ndash;                        <TextInput title="Фамилия" v-model:value="counterparties.lastName" type="text"  :isEditable="false"/>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="relative z-0 w-full mb-6 group">&ndash;&gt;-->
<!--&lt;!&ndash;                        <TextInput title="Имя" v-model:value="counterparties.firstName" type="text"/>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="relative z-0 w-full mb-6 group">&ndash;&gt;-->
<!--&lt;!&ndash;                        <TextInput title="Отчество" v-model:value="counterparties.middleName" type="text"/>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->

<!--&lt;!&ndash;                    <div class="relative z-0 w-full mb-6 group">&ndash;&gt;-->
<!--&lt;!&ndash;                        <TextInput title="Город" v-model:value="counterparties.city" type="text"/>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="relative z-0 w-full mb-6 group">&ndash;&gt;-->
<!--&lt;!&ndash;                        <TextInput title="Телефон" v-model:value="counterparties.phone" type="text"/>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    <div class="relative z-0 w-full mb-6 group">&ndash;&gt;-->
<!--&lt;!&ndash;                        <TextInput title="Телеграм" v-model:value="counterparties.telegram_login" type="text"/>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                </div>&ndash;&gt;-->

<!--&lt;!&ndash;            <h3 class="mb-4 mt-4 text-xl font-medium text-gray-900 dark:text-white">Заказы контрагента</h3>&ndash;&gt;-->

<!--&lt;!&ndash;            <table class="w-full whitespace-nowrap">&ndash;&gt;-->
<!--&lt;!&ndash;                <thead class="bg-gray-100">&ndash;&gt;-->
<!--&lt;!&ndash;                <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center pl-5">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-base font-semibold leading-none text-gray-700 mr-2">Номер заказа</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="pl-24">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-base font-semibold leading-none text-gray-600 ml-2">Дата заказа</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="pl-5">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-base font-semibold leading-none text-gray-600 ml-2">Статус заказа</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->
<!--&lt;!&ndash;                        <p class="text-base font-semibold leading-none text-gray-600 ml-2">Состав заказа</p>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->
<!--&lt;!&ndash;                        <p class="text-base font-semibold leading-none text-gray-600 ml-2">Сумма заказа&ndash;&gt;-->
<!--&lt;!&ndash;                        </p>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->

<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                </tr>&ndash;&gt;-->
<!--&lt;!&ndash;                </thead>&ndash;&gt;-->

<!--&lt;!&ndash;                <tbody>&ndash;&gt;-->
<!--&lt;!&ndash;                <tr v-for="order of orders" :key="order.id" tabindex="0"&ndash;&gt;-->
<!--&lt;!&ndash;                    class="focus:outline-none h-16 border border-gray-100 rounded hover:bg-gray-200 cursor-pointer">&ndash;&gt;-->

<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center pl-5">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ order.order_number }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="pl-24">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.order_date }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.status }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.order_details }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->
<!--&lt;!&ndash;                    <td class="">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex items-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <p class="text-sm leading-none text-gray-600 ml-2">{{ order.order_price }}</p>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->

<!--&lt;!&ndash;                    <td class="pl-4">&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="flex">&ndash;&gt;-->
<!--&lt;!&ndash;                            <router-link :to="{path: '/orders/' + order.id}">&ndash;&gt;-->
<!--&lt;!&ndash;                                <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                </button>&ndash;&gt;-->
<!--&lt;!&ndash;                            </router-link>&ndash;&gt;-->

<!--&lt;!&ndash;                            <button @click.stop="order(order.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                                </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                            </button>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                    </td>&ndash;&gt;-->

<!--&lt;!&ndash;                </tr>&ndash;&gt;-->
<!--&lt;!&ndash;                </tbody>&ndash;&gt;-->

<!--&lt;!&ndash;            </table>&ndash;&gt;-->

<!--                <div class="mt-6 flex items-center justify-end gap-x-6">-->
<!--                    <router-link to="/counterparties" type="button"-->
<!--                                 class="text-sm font-semibold leading-6 text-gray-900">Назад-->
<!--                    </router-link>-->
<!--                </div>-->

<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<template>
    <div>
        <Header title="Детальная информация заказа" />
        <hr>
    </div>
</template>

<script>
import TextInput from "../../forms/TextInput.vue";
import Alert from "../../forms/Alert.vue";
import Success from "../../forms/Success.vue";
import Select from "../../forms/Select.vue";
import Checkbox from "../../forms/Checkbox.vue";
import DateInput from "../../forms/DateInput.vue";
import Textarea from "../../forms/Textarea.vue";
import Header from "../../Header.vue";
import Table from "../../forms/Table.vue";
import {ProvideService} from "../../../services/ProvideService";

export default {
    name: "OrderDetail",
    components: {Header, Textarea, DateInput, Select, Alert, TextInput, Success, Checkbox},
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
    created: async function () {
        this.update()
    },
    // created() {
    //     CounterpartiesService.getById(this.id)
    //         .then(response => this.counterparties = response.data.counterparties)
    //         .catch(error => {
    //             this.errors = error.response.data.message
    //         })
    //     // UserService.getRoles().then(response => this.userRoles = response.data.roles)
    //     CounterpartiesOrdersService.getOrders()
    //         .then(response => this.orders = response.data.orders)
    // },
    methods: {
        update: function () {
            this.loading = true;
            ProvideService.getOrderById(this.id)
                .then(response => this.order = response.data.order)
                .catch(error => this.errorMessage = error)
                .finally(() => this.loading = false)
        },
    }
}
</script>
