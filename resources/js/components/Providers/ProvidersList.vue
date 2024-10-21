<template>
    <div>
        <Header title="Список поставщиков">
            <ButtonUI @click="goToAdd">Добавить поставщика</ButtonUI>
        </Header>
        <hr>

        <Table
            :data="providers"
            :columns="columns"
            :rowsPerPageOptions="[5, 10, 25]"
            :path="'/providers/detail/'"
        />
    </div>
</template>

<script>
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import _ from "lodash";
import {ProvideService} from "../../services/ProvideService";
import Spinner from "../forms/Spinner.vue";
import ButtonUI from "../UI/ButtonUI.vue";
import Header from "../Header.vue";
import Table from "../forms/Table.vue";

export default {
    components: {Table, Header, ButtonUI, Spinner, Alert, TextInput},
    data: function () {
        return {
            providers: [],
            loading: false,
            errorMessage: null,
            // query: null,
            // limit: 5,
            // total: 1,

            // Названия колонок
            columns: [
                { label: 'ФИО', key: 'full_name' },
                { label: 'Город', key: 'city' },
                { label: 'Телефон', key: 'phone' },
                { label: 'Логин в телеграм', key: 'telegram' },
                { label: 'Заказов', key: '' },
            ],
        }
    },
    name: "ProvidersList",
    created: async function () {
        this.update()
    },
    methods: {
        update:  function () {
            this.loading = true
            ProvideService.getProvides(this.page, this.query)
                .then(response => {
                    this.providers = response.data.providers
                    // this.limit = response.data.limit
                    // this.total = response.data.total
                })
                .catch(error => this.errors = error.data.message || error)
                .finally(() => this.loading = false)
        },
        goToAdd() {
            this.$store.dispatch('saveRoute', this.$route.path); // Сохраняем текущий маршрут
            this.$router.push({ path: '/providers/create'});
        },
    },
}
</script>
