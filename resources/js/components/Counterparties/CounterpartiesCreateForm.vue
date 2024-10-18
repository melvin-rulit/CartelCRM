<!--<template>-->
<!--    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">-->
<!--        <div class="px-6 py-6 lg:px-8">-->

<!--            <Alert :errors="errors" />-->
<!--            <Success :message="message" />-->

<!--            <form @submit="store">-->

<!--                <div class="grid md:grid-cols-3 md:gap-6 mt-5">-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Имя" v-model:value="counterparties.firstName" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Отчество" v-model:value="counterparties.middleName" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Фамилия" v-model:value="counterparties.lastName" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Город" v-model:value="counterparties.city" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Телефон" v-model:value="counterparties.phone" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Телеграм" v-model:value="counterparties.telegram_login" type="text"/>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="mt-6 flex items-center justify-end gap-x-6">-->
<!--                    <router-link to="/counterparties" type="button"-->
<!--                                 class="text-sm font-semibold leading-6 text-gray-900">Отмена-->
<!--                    </router-link>-->
<!--                    <button type="submit"-->
<!--                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">-->
<!--                        Сохранить-->
<!--                    </button>-->
<!--                </div>-->

<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<template>
    <div>
        <Header title="Создание контрагента" />
        <hr>

    </div>
</template>

<script>
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Select from "../forms/Select.vue";
import Success from "../forms/Success.vue";
import Checkbox from "../forms/Checkbox.vue";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import {CounterpartiesService} from "../../services/CounterpartiesService";
import Header from "../Header.vue";

export default {
    name: "UserCreateForm",
    components: {Header, DateInput, Checkbox, Select, Alert, TextInput, Success, Textarea},
    data: function () {
        return {
            loading: false,
            userRoles: [],
            counterparties: {
                'firstName': '',
                'middleName': '',
                'lastName': '',
                'city': '',
                'phone': '',
                'telegram_login': '',
            },
            errors: null,
            message: null
        }
    },
    created: async function () {
        // UserService.getRoles().then(response => this.userRoles = response.data.roles)
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            CounterpartiesService.store(this.counterparties)
                .then(response => {
                    this.counterparties = response.data.counterparties
                    // this.$router.push({name: 'listCounterparties'})
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
            return true;
        }
    }
}
</script>
