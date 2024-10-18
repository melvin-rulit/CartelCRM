<template>
    <div>
        <Header :title="order_create ? 'Заказы поставщикам' : 'Создание заказа поставщику'">
            <ButtonUI v-show="order_create" @click="goToAdd('order')">Создать заказ</ButtonUI>
            <ButtonUI v-if="!order_create" @click="cancelOrderCreation">Отмена</ButtonUI>
            <ButtonUI @click="goToAdd('provider')">Добавить поставщика</ButtonUI>
        </Header>
        <hr>
        <Table v-show="order_create"
            :data="orders"
            :columns="columns"
            :rowsPerPageOptions="[5, 10, 25]"
            :path="'/providers/order/detail/'"
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
import {ProvideService} from "../../../services/ProvideService";
import Header from "../../Header.vue";
import Table from "../../forms/Table.vue";
import ButtonUI from "../../UI/ButtonUI.vue";

export default {
  components: {ButtonUI, Table, Header, Spinner, DateInput, Alert, TextInput, Success, Checkbox},
    data: function () {
        return {
            loading: false,
            filters: {
                clientName: '',
                ownerName: '',
                activeName: '',
                dealDate: '',
            },
            orders: [],
            columns: [
                { label: 'Номер заказа', key: 'order_number' },
                { label: 'Дата заказа', key: 'order_date' },
                { label: 'Статус заказа', key: 'status' },
                { label: 'ФИО поставщика', key: 'provider.full_name_with_contacts' },
                { label: 'Состав заказа', key: 'order_details' },
                { label: 'Сумма заказа', key: 'order_price' },
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
        update() {
            this.loading = true;
            ProvideService.getOrders(this.filters)
                .then(response => {
                    this.orders = response.data.orders;
                })
                .catch(error => this.errorMessage = error)
                .finally(() => this.loading = false);
        },
        goToAdd(type) {
            if (type === 'order') {
                // this.$router.push({ path: '/providers/orders/create' });
                this.order_create = false;
            } else if (type === 'provider') {
                this.$router.push({ path: '/providers/create' });
            }
        },
        cancelOrderCreation() {
            this.order_create = true;
        },
    },


        deleteDeal: function(id) {
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
