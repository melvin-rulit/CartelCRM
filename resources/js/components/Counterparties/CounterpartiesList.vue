<template>
    <div>
        <Header title="Контрагенты" />
        <hr>

        <Table
            :data="counterparties"
            :columns="columns"
            :rowsPerPageOptions="[5, 10, 25]"
            :path="'/counterparties/detail/'"
        />
    </div>
</template>

<script>
import Pagination from "../forms/Pagination.vue";
import TextInput from "../forms/TextInput.vue";
import _ from "lodash"
import Spinner from "../forms/Spinner.vue";
import Alert from "../forms/Alert.vue";
import {CounterpartiesService} from "../../services/CounterpartiesService";
import Header from "../Header.vue";
import Table from "../forms/Table.vue";

export default {
    components: {Table, Header, Alert, Spinner, TextInput, Pagination},
    data: function () {
        return {
            counterparties: [],
            loading: false,
            errorMessage: null,
            query: '',
            limit: 5,
            total: 1,

            // Названия колонок
            columns: [
                { label: 'ФИО', key: 'full_name' },
                { label: 'Город', key: 'city' },
                { label: 'Телефон', key: 'phone' },
                { label: 'Логин в телеграм', key: 'telegram_login' },
                { label: 'Заказов', key: '' },
            ],
        }
    },
    name: "CounterpartiesList",
    created:  function () {
        this.update(this.page)
    },
    methods: {
        update:  function () {
            this.loading = true
            CounterpartiesService.getCounterparties(this.page, this.query)
                .then(response => {
                this.counterparties = response.data.counterparties
                this.limit = response.data.limit
                this.total = response.data.total
            })
                .catch(error => this.errors = error.data.message || error)
                .finally(() => this.loading = false)
        },

        // deleteUser: function(id) {
        //     if (confirm('Вы действительно хотите удалить пользователя?')) {
        //         CounterpartiesService.delete(id)
        //             .then(() => this.update(this.page))
        //             .catch(error => this.errorMessage = error.response.data.error)
        //     }
        // }
    },
    // computed: {
    //     page() {
    //         return Number(this.$route.query.page) ?? 1;
    //     }
    // },
    // watch: {
    //     'query': _.debounce(function () {
    //         this.update()
    //     }, 500)
    // }
}
</script>
