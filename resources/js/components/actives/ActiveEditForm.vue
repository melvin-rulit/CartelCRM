<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование актива</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="update">
                <div class="grid md:grid-cols-5 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Марка и модель" v-model:value="active.model" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Номер кузова" v-model:value="active.bodyNumber" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Регистрационный номер" v-model:value="active.regNumber" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <NumberInput title="Год выпуска" v-model:value="active.year"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <Select title="Цвет" v-model:value="active.colorId" :values="colors"/>
                    </div>
                </div>
                <div v-if="currentUser.roleId === 1" class="relative z-0 w-full mb-6 group">
                    <Select title="Филиал" v-model:value="active.branchId" :values="branches"/>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <NumberInput title="Стоимость актива" v-model:value="active.cost" step="0.01" min="0.01"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <Select title="Источник финансирования" v-model:value="active.investorId" :values="investors"/>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <NumberInput title="Стоимость аренды (неделя)" v-model:value="active.costOfRent" step="1" min="0"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <NumberInput title="Стоимость выкупа (неделя)" v-model:value="active.costOfBuyout" step="1" min="0"/>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Номер страхового полиса ОСАГО" v-model:value="active.osagoNumber" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <DateInput title="Дата действия страхового полиса ОСАГО" v-model:value="active.osago" type="date"/>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <NumberInput title="Серия свидетельства о регистрации" v-model:value="active.documentSeries"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <NumberInput title="Номер свидетельства о регистрации" v-model:value="active.documentNumber"/>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Код подразделения" v-model:value="active.documentNotes"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <DateInput title="Дата выдачи" v-model:value="active.documentDate" type="date"/>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/actives" type="button"
                                 class="text-sm font-semibold leading-6 text-gray-900">Отмена
                    </router-link>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Сохранить
                    </button>
                </div>
            </form>
            <hr class="mt-[20px]"/>
            <div class="mt-[20px]">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Финансовые операции по активу (только
                    расход)</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <td>Дата</td>
                        <td>Статья расхода</td>
                        <td>Сумма</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="operations.length > 0" v-for="operation in operations">
                        <td>{{ operation.date }}</td>
                        <td>{{ operation.name }}</td>
                        <td>{{ operation.amount }}</td>
                    </tr>
                    <tr v-else>
                        <td colspan="3">Операций еще нет</td>
                    </tr>
                    </tbody>
                </table>
                <div>Итого: {{ total }} руб.</div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <!-- Modal toggle -->
                    <button @click="showModal"
                            class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            type="button">
                        Добавить операцию
                    </button>

                    <!-- Main modal -->
                    <div v-show="!isHidden" tabindex="-1"
                         class="fixed flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button @click="closeModal" type="button"
                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавление
                                        операции</h3>
                                    <form class="space-y-6" @submit="storeOperation" action="#">
                                        <div class="">
                                            <DateInput title="" v-model:value="operation.date" placeholder="Дата"
                                                       type="date"/>
                                        </div>
                                        <div class="">
                                            <TextInput type="text" title="" v-model:value="operation.name"
                                                       placeholder="Статья расходов"/>
                                        </div>
                                        <div class="">
                                            <Select type="text" title="" v-model:value="operation.type"
                                                    placeholder="Тип" :values="types"/>
                                        </div>
                                        <div>
                                            <NumberInput title="" v-model:value="operation.amount" placeholder="Сумма"
                                                         min="0.01" step="0.01"/>
                                        </div>
                                        <button type="submit"
                                                class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Сохранить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-[20px]"/>
            <div class="mt-[20px]">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">История использования актива</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <td>ФИО клиента</td>
                        <td>Номер сделки</td>
                        <td>Дата с</td>
                        <td>Дата по</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="deal in deals">
                        <td>{{ deal.client.fullName }}</td>
                        <td><router-link :to="{path: '/CounterpartiesOrders/' + this.id}">{{ deal.id }}</router-link></td>
                        <td>{{ deal.createdAtPrintable }}</td>
                        <td>{{ deal.validUntilPrintable }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import {ActiveService} from "../../services/ActiveService";
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Select from "../forms/Select.vue";
import Textarea from "../forms/Textarea.vue";
import NumberInput from "../forms/NumberInput.vue";
import DateInput from "../forms/DateInput.vue";
import {BranchService} from "../../services/BranchService";
import {OperationService} from "../../services/OperationService";
import {UserService} from "../../services/UserService";

export default {
    name: "ActiveEditForm",
    components: {NumberInput, Textarea, Select, Alert, TextInput, Success, DateInput},
    data: function () {
        return {
            isHidden: true,
            loading: false,
            currentUser: {
                roleId: null
            },
            id: this.$route.params.id,
            active: {
                'model': '',
                'bodyNumber': '',
                'regNumber': '',
                'year': '',
                'colorId': '',
                'cost': '',
                'costOfRent': '',
                'costOfBuyout': '',
                'investorId': '',
                'branchId': '',
                'osago': '',
                'osagoNumber': '',
                'documentSeries': '',
                'documentNumber': '',
                'documentDate': '',
                'documentNotes': '',
            },
            branches: [],
            investors: [],
            operations: [],
            operation: {
                date: null,
                name: null,
                type: null,
                amount: null
            },
            deals: [],
            total: 0,
            errors: null,
            message: null
        }
    },
    created() {
        ActiveService.getById(this.id)
            .then(response => this.active = response.data.active)
            .catch(error => this.errors = error.response.data.message)
        BranchService.dict()
            .then(response => this.branches = response.data.branches)
        ActiveService.creditsByActive(this.id)
            .then(response => {
                this.operations = response.data.operations
                this.total = response.data.total
            })
        CounterpartiesOrdersService.getByActiveId(this.id)
            .then(response => this.deals = response.data.deals)
        UserService.currentUser()
            .then(response => this.currentUser = response.data.user)
        UserService.getInvestorsList()
            .then(response => this.investors = response.data.investors)
    },
    methods: {
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            ActiveService.update(this.active)
                .then(response => {
                    this.active = response.data.active
                    this.message = 'Изменения сохранены'
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        storeOperation: function (event) {
            event.preventDefault()
            let operation = this.operation
            operation.activeId = this.active.id
            OperationService.store(operation)
                .then(response => {
                    this.operations.push(response.data.operation)
                    this.total += response.data.operation.amount
                    this.message = 'Операция добавлена'
                    this.isHidden = true
                })
        },
        showModal: function () {
            this.isHidden = false
        },
        closeModal: function () {
            this.isHidden = true
        },
    },
    computed: {
        types: function () {
            return [
                {id: 1, name: 'Приход'},
                {id: 2, name: 'Расход'}
            ];
        },
        colors: function () {
            return [
                {id: 1, name: 'Белый'},
                {id: 2, name: 'Черный'},
                {id: 3, name: 'Красный'},
                {id: 4, name: 'Серый'},
                {id: 5, name: 'Голубой'},
                {id: 6, name: 'Коричневый'},
                {id: 7, name: 'Зеленый'},
                {id: 8, name: 'Желтый'},
            ];
        }
    }
}
</script>
