<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">

            <Alert :errors="errors"/>
            <Success :message="message"/>
<h1>Создание провайдера</h1>
            <form @submit="store">
                <div class="grid md:grid-cols-3 md:gap-6 mt-5">

                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Имя" v-model:value="provider.firstName" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Отчество" v-model:value="provider.middleName" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Фамилия" v-model:value="provider.lastName" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Город" v-model:value="provider.city" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Телефон" v-model:value="provider.phone" type="text"/>
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <TextInput title="Телеграм" v-model:value="provider.telegram_login" type="text"/>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/providers" type="button"
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
import Textarea from "../forms/Textarea.vue";
import NumberInput from "../forms/NumberInput.vue";
import DateInput from "../forms/DateInput.vue";
import {ProvideService} from "../../services/ProvideService";

export default {
    name: "ProxyCreateForm",
    components: {DateInput, NumberInput, Textarea, Select, Alert, TextInput, Success},
    data: function () {
        return {
            loading: false,
            provider: {
                firstName: null,
                middleName: null,
                lastName: null,
                city: null,
                phone: null,
                telegram_login: null
            },

            errors: null,
            submitted: false,
            message: null
        }
    },
    mounted() {
        // UserService.getManagersList()
        //     .then(response => this.delegates = response.data.managers)
        // UserService.getAdminsList()
        //     .then(response => this.owners = response.data.admins)
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            ProvideService.store(this.provider)
                .then(response => {
                    this.provider = response.data.provider
                    // this.$router.push({name: 'proxiesList'})
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
