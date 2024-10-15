<template>
    <Spinner v-show="this.loading"/>
    <Alert :errors="this.errorMessage"/>
    <div class="sm:px-6 w-full">
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <h3 class="text-4xl font-extrabold dark:text-white">Отчет по активам</h3>
            <div class="mt-7 overflow-x-auto">
                <form>
                    <div class="rounded-full p-4 border border-gray-100 mb-10 rounded-0">
                        <div class="grid md:grid-cols-4 md:gap-6 mt-4">
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.branchName"
                                           title="Наименование филиала" type="text"/>
                            </div>
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.activeName"
                                           title="Наименование актива" type="text"/>
                            </div>
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.investorName" title="ФИО инвестора"
                                           type="text"/>
                            </div>
                            <div>
                                <TextInput @keyup="update()" v-model:value="filters.clientName" title="ФИО клиента"
                                           type="text"/>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-100 border">
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-700 mr-2">
                                    Выбрать
                                </p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-700 mr-2">Наименование актива</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">ФИО инвестора</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Остаток основного долга</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Филиал</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">ФИО клиента</p>
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="active of actives" :key=active.id tabindex="0"
                        class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm font-medium leading-none text-gray-700 mr-2">
                                    <Checkbox @update:checked="toggle(active.id)" />
                                </p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm font-medium leading-none text-gray-700 mr-2">{{
                                        active.name
                                    }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ active.investor.name }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ active.remain }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-sm leading-none text-gray-600 ml-2">{{ active.branch.name }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p v-if="active.client" class="text-sm leading-none text-gray-600 ml-2">{{ active.client.fullName }}</p>
                                <p v-else class="text-sm leading-none text-gray-600 ml-2"> - </p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sm:flex items-center justify-between">
                <a @click="exportStats"
                   class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
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
    name: "StatsActives",
    components: {Spinner, DateInput, TextInput, Alert, Checkbox},
    data: function () {
        return {
            loading: false,
            errorMessage: null,
            actives: [],
            selected: [],
            filters: {
                branchName: '',
                investorName: '',
                activeName: '',
                clientName: ''
            }
        }
    },
    created() {
        this.update()
    },
    methods: {
        update: function () {
            this.loading = true
            StatsService.getActives(this.filters)
                .then(response => this.actives = response.data.actives)
                .catch(error => this.errorMessage = error.response.data.error)
                .finally(() => this.loading = false)
        },
        exportStats: function () {
            StatsService.exportActives(this.selected)
                .then(response => fileDownload(response.data, `actives2.xlsx`))
        },
        toggle: function (id) {
            if (this.selected.indexOf(id) >= 0) {
                this.selected.splice(this.selected.indexOf(id), 1);
            } else {
                this.selected.push(id)
            }
        },
    },
    watch: {
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
    }
}
</script>

<style scoped>

</style>
