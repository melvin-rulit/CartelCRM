<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавление источника финансирования</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="store">
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Наименование" v-model:value="source.name" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <NumberInput title="Сумма" v-model:value="source.amount" min="0.01" step="0.01"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <NumberInput title="Процент" v-model:value="source.percent" min="0" step="0"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Select title="Инвестор" v-model:value="source.investor.id" :values="investors"/>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/sources" type="button"
                                 class="text-sm font-semibold leading-6 text-gray-900">Отмена
                    </router-link>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Select from "../forms/Select.vue";
import NumberInput from "../forms/NumberInput.vue";
import {UserService} from "../../services/UserService";
import {SourceService} from "../../services/SourceService";

export default {
    name: "SourceCreateForm",
    components: {NumberInput, Select, Alert, TextInput, Success},
    data: function () {
        return {
            loading: false,
            source: {
                name: null,
                amount: null,
                percent: null,
                investor: {
                    id: null
                }
            },
            investors: [],
            errors: null,
            submitted: false,
            message: null
        }
    },
    mounted() {
        UserService.getInvestorsList()
            .then(response => this.investors = response.data.investors)
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            SourceService.store(this.source)
                .then(response => {
                    this.source = response.data.source
                    this.$router.push({name: 'sourcesList'})
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
