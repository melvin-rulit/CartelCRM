<!--<template>-->
<!--    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">-->
<!--        <div class="px-6 py-6 lg:px-8">-->
<!--            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавление пользователя</h3>-->
<!--            <Alert :errors="errors" />-->
<!--            <Success :message="message" />-->
<!--            <form @submit="store">-->
<!--                <div class="grid md:grid-cols-3 md:gap-6">-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Фамилия пользователя" v-model:value="user.lastName" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Имя пользователя" v-model:value="user.firstName" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Отчество пользователя" v-model:value="user.middleName" type="text"/>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="relative z-0 w-full mb-6 group">-->
<!--                    <Checkbox title="Пользователь активен?" name="enabled" v-model:checked="user.enabled"-->
<!--                              :checked="user.enabled" type="checkbox"/>-->
<!--                </div>-->
<!--                <div class="grid md:grid-cols-5 md:gap-6">-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <Select name="roleId" v-model:value="user.roleId" title="Роль" :values="userRoles"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <Select name="branchId" v-model:value="user.branchId" title="Филиал" :values="branches"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Email" v-model:value="user.email" type="email"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Номер телефона" v-model:value="user.phoneNumber" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Пароль" v-model:value="user.password" type="password"/>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="relative z-0 w-100 mb-6 group">-->
<!--                    <DateInput title="Дата рождения" v-model:value="user.birthday" type="date"/>-->
<!--                </div>-->
<!--                <div class="grid md:grid-cols-2 md:gap-6">-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Серия паспорта" v-model:value="user.passportSeries" type="text"/>-->
<!--                    </div>-->
<!--                    <div class="relative z-0 w-full mb-6 group">-->
<!--                        <TextInput title="Номер паспорта" v-model:value="user.passportNumber" type="text"/>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="relative z-0 w-full mb-6 group">-->
<!--                    <TextInput title="Кем выдан паспорт" v-model:value="user.passportNotes" type="text"/>-->
<!--                </div>-->
<!--                <div class="relative z-0 w-full mb-6 group">-->
<!--                    <TextInput title="Адрес регистрации" v-model:value="user.registrationAddress" type="text"/>-->
<!--                </div>-->
<!--&lt;!&ndash;                <div class="relative z-0 w-full mb-6 group">&ndash;&gt;-->
<!--&lt;!&ndash;                    <Textarea title="Комментарий" v-model:value="user.comment"/>&ndash;&gt;-->
<!--&lt;!&ndash;                </div>&ndash;&gt;-->
<!--                <div class="mt-6 flex items-center justify-end gap-x-6">-->
<!--                    <router-link to="/users" type="button"-->
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
        <Header title="Создание пользователя" />
        <hr>

    </div>
</template>

<script>
import {UserService} from "../../services/UserService";
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Select from "../forms/Select.vue";
import Success from "../forms/Success.vue";
import Checkbox from "../forms/Checkbox.vue";
import {BranchService} from "../../services/BranchService";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import Header from "../Header.vue";

export default {
    name: "UserCreateForm",
    components: {Header, DateInput, Checkbox, Select, Alert, TextInput, Success, Textarea},
    data: function () {
        return {
            loading: false,
            userRoles: [],
            branches: [],
            user: {
                'firstName': '',
                'middleName': '',
                'lastName': '',
                'birthday': null,
                'passportSeries': '',
                'passportNumber': '',
                'passportNotes': '',
                'registrationAddress': '',
                'comment': '',
                'phoneNumber': '',
                'email': '',
                'enabled': '',
                'password': null,
                'roleId': 0,
                'branchId': 0
            },
            errors: null,
            message: null
        }
    },
    created: async function () {
        UserService.getRoles().then(response => this.userRoles = response.data.roles)
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            UserService.store(this.user)
                .then(response => {
                    this.user = response.data.user
                    this.$router.push({name: 'listUsers'})
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
            return true;
        }
    }
}
</script>
