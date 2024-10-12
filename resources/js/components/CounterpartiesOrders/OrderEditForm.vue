<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактрование сделки</h3>
                    <form @submit="update">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <Select title="Тип сделки" v-model:value="deal.type" :values="types"/>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <Select title="Способ оформления сделки" v-model:value="deal.kind" :values="kinds"/>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div v-show="deal.kind === 'proxy'" class="relative z-0 w-full mb-6 group">
                                <Select title="Доверенность" v-model:value="deal.proxyId" :values="proxies"/>
                            </div>
                            <div v-show="deal.kind === 'owner'" class="relative z-0 w-full mb-6 group">
                                <Select title="Арендодатель" v-model:value="deal.ownerId" :values="owners"/>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <Select title="Филиал" v-model:value="deal.branchId" :values="branches"/>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <Select title="Арендополучатель" v-model:value="deal.clientId" :values="clients"/>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <Select title="Актив" v-model:value="deal.activeId" :values="activesList"
                                        />
                            </div>
                        </div>
                        <div class="grid md:grid-cols-1 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <TextInput title="Гражданство арендополучателя" v-model:value="deal.citizenship" type="text"/>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-1 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <DateInput title="Дата/время договора" v-model:value="deal.createdAt" type="datetime-local"/>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <NumberInput title="Стоимость аренды" v-model:value="deal.costOfRent" min="0"
                                             step="0.01"/>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <NumberInput title="Стоимость выкупа" v-model:value="deal.costOfBuyout"
                                             min="0"
                                             step="0.01"/>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-1 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <div v-show="this.deal.type === 'credit'" class="relative z-0 w-full mb-6 group">
                                    <NumberInput title="Сумма первоначального взноса" v-model:value="deal.initial" min="0" step="0.01"/>
                                </div>
                            </div>
                        </div>
                      <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group">
                          <TextInput title="Сумма основного долга" v-model:value="deal.remain" type="text"/>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <NumberInput title="Срок выкупа (мес)" v-model:value="deal.redemption_period" min="1" max="12" step="1"/>
                        </div>
                      </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <Textarea title="Комментарий" v-model:value="deal.comment"/>
                        </div>
                        <a href="#" @click="downloadContract" class="text-blue-600 font-medium">Скачать договор</a>
                        <a href="#" @click="downloadAct" class="text-blue-600 font-medium ml-[40px]">Скачать акт</a>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <router-link to="/deals" type="button"
                                         class="text-sm font-semibold leading-6 text-gray-900">Отмена
                            </router-link>
                            <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
                <div class="">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Финансовая информация</h3>
                    <div>
                        <h2 class="mb-2 text-2xl font-medium">Остаток основного долга: {{ remains }} руб</h2>
                        <h2 class="mb-4 text-2xl font-medium">Дата платежа: {{ deal.nextPayday }}</h2>
                        <div class="mb-4 grid md:grid-cols-3 md:gap-6">
                            <div class="relative z-0 w-full mb-6 group">
                                <DateInput title="Дата с" v-model:value="filter.from" type="date"/>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <DateInput title="Дата по" v-model:value="filter.to" type="date"/>
                            </div>
                            <div class="relative z-0 w-full mb-6 mt-[30px] group">
                                <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Найти
                                </button>
                            </div>
                        </div>
                        <div>
                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Платежи фактические</h3>
                            <div class="mb-[10px]">
                                <a href="#" @click="showAllPayments" class="text-blue-600 font-medium">Показать все</a>
                            </div>
                            <table class="table border">
                                <thead>
                                    <tr>
                                        <td>Номер</td>
                                        <td>Дата платежа</td>
                                        <td>Сумма аренды</td>
                                        <td>Сумма выкупа</td>
                                        <td>Действия</td>
                                    </tr>
                                </thead>
                                <tbody v-if="payments.length > 0">
                                <tr v-for="payment in payments" key="payment.id">
                                    <td>{{ payment.id }}</td>
                                    <td>{{ payment.datePrintable }}</td>
                                    <td>{{ payment.rent }}</td>
                                    <td>{{ payment.buyout }}</td>
                                    <td>
                                        <button @click="deletePayment(payment.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none rounded hover:bg-red-200 focus:outline-none">
                                            <svg fill="none" height="20" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tbody v-else>
                                <tr>
                                    <td colspan="4">Операций пока нет</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#" @click="downloadPayments" class="text-blue-600 font-medium">Скачать график платежей</a>
                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <!-- Modal toggle -->
                                <button @click="showModal"
                                        class="mt-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                        type="button">
                                    Добавить платеж
                                </button>

                                <!-- Main modal -->
                                <div v-show="!isHidden" tabindex="-1"
                                     class="fixed flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button @click="closeModal" type="button"
                                                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="px-6 py-6 lg:px-8">
                                                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">
                                                    Добавление платежа</h3>
                                                <form class="space-y-6" @submit="storePayment" action="#">
                                                    <div class="">
                                                        <DateInput title="Дата платежа" v-model:value="payment.date"
                                                                   placeholder="Дата" type="date"/>
                                                    </div>
                                                    <div>
                                                        <NumberInput title="Сумма аренды" v-model:value="payment.rent"
                                                                     placeholder="Аренда" min="0" step="0.01"/>
                                                    </div>
                                                    <div>
                                                        <NumberInput title="Сумма выкупа" v-model:value="payment.buyout"
                                                                     placeholder="Выкуп" min="0" step="0.01"/>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Select from "../forms/Select.vue";
import Textarea from "../forms/Textarea.vue";
import NumberInput from "../forms/NumberInput.vue";
import DateInput from "../forms/DateInput.vue";
import {UserService} from "../../services/UserService";
import {ProvideService} from "../../services/ProvideService";
import {ClientService} from "../../services/ClientService";
import {BranchService} from "../../services/BranchService";
import {ActiveService} from "../../services/ActiveService";
import {PaymentService} from "../../services/PaymentService";
import fileDownload from "js-file-download";

export default {
    name: "DealEditForm",
    components: {DateInput, NumberInput, Textarea, Select, Alert, TextInput, Success},
    data: function () {
        const now = new Date()
        const today = now.toISOString().slice(0, 20)

        return {
            isHidden: true,
            loading: false,
            id: this.$route.params.id,
            deal: {
                type: null,
                kind: null,
                proxyId: null,
                ownerId: null,
                branchId: null,
                clientId: null,
                activeId: null,
                remain: null,
                createdAt: null,
                validUntil: null,
                costOfRent: null,
                redemption_period: null,
                costOfBuyout: null,
                initial: null,
                comment: null,
                nextPayday: null,
                citizenship: null
            },
            filter: {
                from: null,
                to: null,
            },
            payment: {
                id: null,
                date: today,
                rent: null,
                buyout: null
            },
            clients: [],
            owners: [],
            branches: [],
            actives: [],
            activesList: [],
            proxies: [],
            types: [],
            kinds: [],
            payments: [],
            allPayments: [],
            paymentTypes: [],
            errors: null,
            submitted: false,
            message: null
        }
    },
    mounted() {
        CounterpartiesOrdersService.getById(this.id)
            .then(response => this.deal = response.data.deal)
        CounterpartiesOrdersService.types()
            .then(response => {
                this.types = response.data.types
            })
            .catch(error => this.errors = error)
        CounterpartiesOrdersService.kinds()
            .then(response => {
                this.kinds = response.data.kinds
            })
            .catch(error => this.errors = error)
        ClientService.getClients()
            .then(response => {
                const clients = response.data.clients
                let list = []
                clients.forEach(function (value, key) {
                    list.push({'id': Number(value.id), 'name': value.firstName + ' ' + value.lastName})
                })
                this.clients = list
            })
            .catch(error => this.errors = error)
        UserService.getAdminsList()
            .then(response => {
                const owners = response.data.admins
                let list = []
                owners.forEach(function (value, key) {
                    list.push({'id': Number(value.id), 'name': value.name})
                })
                this.owners = list
            })
            .catch(error => this.errors = error)
        BranchService.dict()
            .then(response => this.branches = response.data.branches)
            .catch(error => this.errors = error)
        ActiveService.getActives()
            .then(response => {
                const actives = response.data.actives
                this.actives = actives
                let list = []
                actives.forEach(function (value, key) {
                    list.push({'id': Number(value.id), 'name': value.model + ' ' + value.regNumber})
                })
                this.activesList = list
            })
            .catch(error => this.errors = error)
        ProvideService.dict()
            .then(response => this.proxies = response.data.proxies)
            .catch(error => this.errors = error)
        PaymentService.getPayments(this.id)
            .then(response => {
                let payments = response.data.payments.reverse()
                this.allPayments = payments
                this.payments = payments.slice(0, 5)
            })
        PaymentService.getTypes()
            .then(response => this.paymentTypes = response.data.types)
    },
    methods: {
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            CounterpartiesOrdersService.update(this.deal)
                .then(response => {
                    this.deal = response.data.deal
                    this.message = 'Сделка обновлена'
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        showModal: function () {
            this.isHidden = false
        },
        closeModal: function () {
            this.isHidden = true
        },
        storePayment: function (event) {
            event.preventDefault()
            this.errors = null;
            PaymentService.store(this.payment, this.id)
                .then(response => {
                    this.payments.push(response.data.payment)
                    this.isHidden = true
                })
                .catch(error => this.errors = error)
        },
        deletePayment: function(id) {
            if (confirm('Вы действительно хотите удалить платеж?')) {
                PaymentService.delete(id)
                    .then(response => this.payments = response.data.payments)
                    .catch(error => this.errors = error.response.data.error)
            }
        },
        downloadContract: function(event) {
            event.preventDefault()
            CounterpartiesOrdersService.downloadContract(this.id)
                .then(response => fileDownload(response.data, `${this.id}-contract.docx`))
                .catch(error => this.errors = error)
        },
        downloadAct: function(event) {
            event.preventDefault()
            CounterpartiesOrdersService.downloadAct(this.id)
                .then(response => fileDownload(response.data, `${this.id}-act.docx`))
                .catch(error => this.errors = error)
        },
        downloadPayments: function(event) {
            event.preventDefault()
            CounterpartiesOrdersService.downloadPayments(this.id)
                .then(response => fileDownload(response.data, `${this.id}-payments.docx`))
                .catch(error => this.errors = error)
        },
        showAllPayments: function (event) {
            event.preventDefault()
            if (this.allPayments.length === this.payments.length) {
                event.currentTarget.innerHTML = 'Показать все'
                this.payments = this.allPayments.slice(0, 5)
            } else {
                event.currentTarget.innerHTML = 'Скрыть лишние'
                this.payments = this.allPayments
            }
        },
        handleSelectChange() {
            switch (this.deal.type) {
                case 'rent':
                    this.deal.redemption_period = 9;
                    break;
                case 'credit':
                    this.deal.redemption_period = 12;
                    break;
                default:
                    break;
            }
        },
    },
    computed: {
        remains: function () {
            let incomes = 0;

            this.allPayments.forEach(function (payment) {
                incomes += payment.buyout
            })

            return this.deal.remain - incomes
        }
    },
    watch: {
        'deal.activeId': function (newId) {
            let active = null
            this.actives.forEach(function (value) {
                if (Number(value.id) === Number(newId)) {
                    active = value
                }
            })
            if (active) {
                this.deal.remain = active.cost
            }
        },
        'deal.type': function(newType) {
            this.handleSelectChange()
        }
    }
}
</script>
