<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавление актива</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="store">
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
        </div>
    </div>
</template>

<script>
import {ActiveService} from "../../services/ActiveService";
import {BranchService} from "../../services/BranchService";
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Select from "../forms/Select.vue";
import Textarea from "../forms/Textarea.vue";
import NumberInput from "../forms/NumberInput.vue";
import DateInput from "../forms/DateInput.vue";
import {UserService} from "../../services/UserService";

export default {
    name: "ActiveCreateForm",
    components: {DateInput, NumberInput, Textarea, Select, Alert, TextInput, Success},
    data: function () {
        return {
            loading: false,
            currentUser: {
                roleId: null
            },
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
            errors: null,
            submitted: false,
            message: null
        }
    },
    mounted() {
        BranchService.dict()
            .then(response => this.branches = response.data.branches)
        UserService.currentUser()
            .then(response => this.currentUser = response.data.user)
        UserService.getInvestorsList()
            .then(response => this.investors = response.data.investors)
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            ActiveService.store(this.active)
                .then(response => {
                    this.active = response.data.active
                    this.$router.push({name: 'editActive', params: {id: this.active.id}})
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    },
    computed: {
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
