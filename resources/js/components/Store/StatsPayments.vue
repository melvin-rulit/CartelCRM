<template>
    <Spinner v-show="this.loading"/>
    <Alert :errors="this.errorMessage"/>
    <div class="sm:px-6 w-full">
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <h3 class="text-4xl font-extrabold dark:text-white">Отчет по финансовым операциям</h3>
            <div class="mt-7 overflow-x-auto">
                <form>
                    <div class="rounded-full p-4 border border-gray-100 mb-10 rounded-0">
                        <div class="grid md:grid-cols-3 md:gap-6 mt-4">
                            <div>
                                <DateInput @keyup="update()" v-model:value="filters.dateFrom" title="Дата с" type="date"/>
                            </div>
                            <div>
                                <DateInput @keyup="update()" v-model:value="filters.dateTo" title="Дата по" type="date"/>
                            </div>
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.branchName" title="Наименование филиала" type="text"/>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-3 md:gap-6 mt-10">
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.investorName" title="ФИО инвестора" type="text"/>
                            </div>
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.clientName" title="ФИО клиента" type="text"/>
                            </div>
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.activeName" title="Наименование актива" type="text"/>
                            </div>
                        </div>
                        <div class="mt-4">
                            <Checkbox v-model:checked="filters.incomes" title="Приход" />
                        </div>
                        <div class="mt-2">
                            <Checkbox v-model:checked="filters.outgoings" title="Расход" />
                        </div>
                    </div>
                </form>
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-100 border">
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <div class="flex items-center pl-5">
                                <Checkbox @update:checked="selectAll()" v-model:checked="this.checkedAll" />
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-700 mr-2">Дата операции</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Тип операции</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Сумма</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Статья расхода</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Наименование актива</p>
                            </div>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Филиал</p>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">ФИО клиента</p>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payment of payments" :key=payment.id tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm font-medium leading-none text-gray-700 mr-2">
                                    <Checkbox @update:checked="toggle(payment.id, payment.kind)" name="toggler" />
                                </p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm font-medium leading-none text-gray-700 mr-2">{{ payment.createdAt }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ payment.type }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ payment.amount }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ payment.operationName }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ payment.activeName }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ payment.branchName }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ payment.clientName }}</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sm:flex items-center justify-between">
                <a v-show="selectedPayments.length  > 0 || selectedOperations.length > 0" @click="exportStats" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Выгрузить отчет</p>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import Checkbox from "../forms/Checkbox.vue";
import Alert from "../forms/Alert.vue";
import {StatsService} from "../../services/StatsService";
import TextInput from "../forms/TextInput.vue";
import DateInput from "../forms/DateInput.vue";
import _ from "lodash";
import fileDownload from "js-file-download";
import Spinner from "../forms/Spinner.vue";

export default {
    name: "StatsPayments",
    components: {Spinner, DateInput, TextInput, Alert, Checkbox},
    data: function () {
        return {
            loading: false,
            errorMessage: null,
            payments: [],
            selectedPayments: [],
            selectedOperations: [],
            checkedAll: false,
            filters: {
                dateFrom: '',
                dateTo: '',
                branchName: '',
                investorName: '',
                activeName: '',
                clientName: '',
                incomes: false,
                outgoings: false
            }
        }
    },
    created() {
        this.update()
    },
    methods: {
        update: function () {
            this.loading = true
            StatsService.getPayments(this.filters)
                .then(response => this.payments = response.data.payments)
                .finally(() => this.loading = false)
        },
        toggle: function (id, kind) {
            if (kind === 'operation') {
                if (this.selectedOperations.indexOf(id) >= 0) {
                    this.selectedOperations.splice(this.selectedOperations.indexOf(id), 1);
                } else {
                    this.selectedOperations.push(id)
                }
            } else {
                if (this.selectedPayments.indexOf(id) >= 0) {
                    this.selectedPayments.splice(this.selectedPayments.indexOf(id), 1);
                } else {
                    this.selectedPayments.push(id)
                }
            }
        },
        exportStats: function () {
            console.log(this.selectedPayments, this.selectedOperations)
            StatsService.exportPayments(this.selectedPayments, this.selectedOperations)
                .then(response => fileDownload(response.data, `payments2.xlsx`))
        },
        selectAll: function () {
            let elems = document.getElementsByName('toggler')
            if (!this.checkedAll) {
                elems.forEach(function (elem) {
                    elem.checked = true
                })
                this.payments.forEach(payment => {
                    if (payment.kind === 'operation') {
                        this.selectedOperations.push(payment.id)
                    } else {
                        this.selectedPayments.push(payment.id)
                    }
                })
            } else {
                elems.forEach(elem => {
                    elem.checked = false
                    this.selectedPayments = []
                    this.selectedOperations = []
                })
            }
        }
    },
    watch: {
        'filters.dateFrom': _.debounce(function () {
            this.update()
        }, 500),
        'filters.dateTo': _.debounce(function () {
            this.update()
        }, 500),
        'filters.branchName': _.debounce(function () {
            this.update()
        }, 500),
        'filters.investorName': _.debounce(function () {
            this.update()
        }, 500),
        'filters.activeName': _.debounce(function () {
            this.update()
        }, 500),
        'filters.clientName': _.debounce(function () {
            this.update()
        }, 500),
        'filters.incomes': _.debounce(function () {
            this.update()
        }, 500),
        'filters.outgoings': _.debounce(function () {
            this.update()
        }, 500)
    }
}
</script>

<style scoped>

</style>
