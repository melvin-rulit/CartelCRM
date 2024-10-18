<template>
    <div>
        <Header title="Заказы поставщикам">
            <ButtonUI @click="goToAdd">Создать заказ</ButtonUI>
            <ButtonUI @click="goToAdd">Добавить поставщика</ButtonUI>
        </Header>
        <hr>

        <Table
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
        goToAdd() {
            this.$router.push({ path: '/providers/create'});
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
