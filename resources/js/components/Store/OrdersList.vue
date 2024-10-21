<template>
    <div>
        <Header title="Заказы на складе">
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
import Header from "../Header.vue";
import Table from "../forms/Table.vue";
import ButtonUI from "../UI/ButtonUI.vue";

export default {
  components: {ButtonUI, Table, Header},
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
                { label: 'Статус оплаты', key: 'is_paid' },
                { label: 'Номер заказа', key: 'order_number' },
                { label: 'Дата заказа', key: 'order_date' },
                { label: 'Статус заказа', key: 'status' },
                { label: 'ФИО поставщика', key: 'provider.full_name_with_contacts' },
                { label: 'Состав заказа', key: 'order_details' },
                { label: 'Сумма заказа', key: 'order_price' },
            ],
            previousRoute: '',
            order_create: true,
            errorMessage: null,
            query: null,
        }
    },
    name: "OrderList",
    // mounted() {
    //     this.previousRoute = this.$route.path; // сохраняем маршрут при монтировании
    // },
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
            this.$store.dispatch('saveRoute', this.$route.path); // Сохраняем текущий маршрут
            // this.$router.push({ path: type === 'provider' ? '/providers/create' : '/providers/orders/create' });
            if (type === 'order') {
                this.$router.push({ path: '/providers/orders/create' });
                this.order_create = false;
            } else if (type === 'provider') {
                this.$router.push({ path: '/providers/create' });
            }
        },
        cancelCreation() {
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
