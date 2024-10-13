<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">

            <Alert :errors="errors"/>
            <Success :message="message"/>

            <form @submit="update">
                <div class="grid md:grid-cols-3 md:gap-6 mt-5">
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Фамилия" v-model:value="counterparties.lastName" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Имя" v-model:value="counterparties.firstName" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Отчество" v-model:value="counterparties.middleName" type="text"/>
                    </div>

                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Город" v-model:value="counterparties.city" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Телефон" v-model:value="counterparties.phone" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Телеграм" v-model:value="counterparties.telegram_login" type="text"/>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/counterparties" type="button"
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
import Checkbox from "../forms/Checkbox.vue";
import {BranchService} from "../../services/BranchService";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import {CounterpartiesService} from "../../services/CounterpartiesService";

export default {
    name: "UserEditForm",
    components: {Textarea, DateInput, Select, Alert, TextInput, Success, Checkbox},
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
        // BranchService.getBranches()
        //     .then(response => this.branches = response.data.branches)
    },
    methods: {
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            CounterpartiesService.update(this.user)
                .then(response => {
                    this.user = response.data.user
                    this.message = 'Изменения сохранены'
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
