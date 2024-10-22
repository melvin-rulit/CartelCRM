<template>
    <div>
        <Header :title="order_create ? 'Заказы контрагентов' : 'Создание заказа контрагенту'">
            <Info v-show="filter" :message="filter === 'for_payment' ? 'Текущие заказы' :
                filter === 'completed' ? 'Архивные заказы' :
                filter === 'all' ? 'Все заказы' :
                ''"/>
            <ButtonUI v-show="order_create" @click="goToAdd('order')">Создать заказ</ButtonUI>
        </Header>
        <hr>

        <Table v-show="order_create"
               :data="orders"
               :columns="columns"
               :rowsPerPageOptions="[5, 10, 25]"
               :path="'/counterparties/order/detail/'"
               @filterApplied="handleFilter"
        />
    </div>
</template>
<script>
import TextInput from "../../forms/TextInput.vue";
import Alert from "../../forms/Alert.vue";
import _ from "lodash";
import DateInput from "../../forms/DateInput.vue";
import Spinner from "../../forms/Spinner.vue";
import Success from "../../forms/Success.vue";
import Checkbox from "../../forms/Checkbox.vue";
import {CounterpartiesService} from "../../../services/CounterpartiesService";
import Header from "../../Header.vue";
import Table from "../../forms/Table.vue";
import ButtonUI from "../../UI/ButtonUI.vue";
import Info from "../../forms/Info.vue";

export default {
    components: {Info, ButtonUI, Table, Header, Spinner, DateInput, Alert, TextInput, Success, Checkbox},
    data: function () {
        return {
            loading: false,
            filter: '',
            orders: [],
            columns: [
                {label: 'Номер заказа', key: 'order_number'},
                {label: 'ФИО контрагента', key: 'counterpart.full_name'},
                {label: 'Состав заказа', key: 'order_details'},
                {label: 'Статус заказа', key: 'status'},
                {label: 'Адрес доставки', key: 'delivery_address'},
                {label: 'Сумма заказа', key: 'order_price'},
            ],
            order_create: true,
            errorMessage: null,
            query: null,
        }
    },
    name: "OrderList",
    created: async function () {
        this.update()
    },
    methods: {
        update: function () {
            this.loading = true;
            CounterpartiesService.getOrders(this.filter)
                .then(response => this.orders = response.data.orders)
                .catch(error => this.errorMessage = error)
                .finally(() => this.loading = false)
        },
        goToAdd(type) {
            this.$store.dispatch('saveRoute', this.$route.path); // Сохраняем текущий маршрут
            // this.$router.push({ path: type === 'provider' ? '/providers/create' : '/providers/orders/create' });
            if (type === 'order') {
                this.$router.push({path: '/counterparties/orders/create'});
                this.order_create = false;
            } else if (type === 'provider') {
                this.$router.push({path: '/providers/create'});
            }
        },
        handleFilter(type) {
            this.filter = type;
            if (type === 'all'){
                this.filter = '';
                CounterpartiesService.getOrders(this.filter)
                    .then(response => this.orders = response.data.orders)
                    .catch(error => this.errorMessage = error)
                    .finally(() => this.loading = false)
            }else{
                this.update()
            }
        },
        cancelCreation() {
            this.order_create = true;
        },

        deleteDeal: function (id) {
            // if (confirm('Вы действительно хотите удалить сделку?')) {
            //     CounterpartiesOrdersService.delete(id)
            //         .then(() => this.update(this.page))
            //         .catch(error => this.errorMessage = error.response.data.error)
            // }
        },
        archiveDeal: function (id) {
            // if (confirm('Вы действительно хотите переместить сделку в архив?')) {
            //   CounterpartiesOrdersService.arhive(id)
            //       .then(() => this.update(this.page))
            //       .catch(error => this.errorMessage = error.response.data.error)
            //   this.message = 'Сделка перенесена в архив'
            //   setTimeout(() => {
            //     this.message = ''
            //   }, 2000)
            // }
        }
    },
    // watch: {
    //     'filters.clientName': _.debounce(function () {
    //         this.update()
    //     }, 500),
    //     'filters.ownerName': _.debounce(function () {
    //         this.update()
    //     }, 500),
    //     'filters.activeName': _.debounce(function () {
    //         this.update()
    //     }, 500),
    //     'filters.dealDate': _.debounce(function () {
    //         this.update()
    //     }, 500),
    //         'arhives': _.debounce(function () {
    //   // if (this.arhives === true) {
    //   //   this.filters.arhives = 1
    //   // } else {
    //   //   this.filters.arhives = ''
    //   // }
    //   // this.update()
    //
    // }, 500)
    // }
}
</script>
