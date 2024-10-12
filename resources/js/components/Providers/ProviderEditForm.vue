<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование постовщика</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="update">
                <div class="grid md:grid-cols-3 md:gap-6">
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
import Textarea from "../forms/Textarea.vue";
import NumberInput from "../forms/NumberInput.vue";
import DateInput from "../forms/DateInput.vue";
import {UserService} from "../../services/UserService";
import {ProvideService} from "../../services/ProvideService";

export default {
    name: "ProxyCreateForm",
    components: {DateInput, NumberInput, Textarea, Select, Alert, TextInput, Success},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            provider: {
                delegateId: null,
                ownerId: null,
                number: null,
                validUntil: null,
                issuedBy: null,
                issuedNumber: null
            },
            delegates: [],
            owners: [],
            errors: null,
            submitted: false,
            message: null
        }
    },
    mounted() {
        ProvideService.getById(this.id)
            .then(response => this.provider = response.data.provider)
    },
    methods: {
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            // ProvideService.update(this.proxy)
            //     .then(response => {
            //         this.proxy = response.data.proxy
            //         this.message = 'Доверенность обновлена'
            //     })
            //     .catch(error => {
            //         this.errors = error.response.data.message
            //     })
        }
    }
}
</script>
