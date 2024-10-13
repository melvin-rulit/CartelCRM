<template>
<!--  <Spinner v-show="this.loading"/>-->
<!--  <Alert :errors="this.errorMessage"/>-->
<!--  <Success :message="this.message"/>-->

    <div class="w-full">
        <div class="bg-white md:py-7 ">

            <div class="mt-3 overflow-x-auto">
                tyutyu
            </div>
        </div>
    </div>
</template>

<script>
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import _ from "lodash";
import DateInput from "../forms/DateInput.vue";
import Spinner from "../forms/Spinner.vue";
import Success from "../forms/Success.vue";
import Checkbox from "../forms/Checkbox.vue";

export default {
  components: {Spinner, DateInput, Alert, TextInput, Success, Checkbox},
    data: function () {
        return {
            loading: false,
            filters: {
                clientName: '',
                ownerName: '',
                activeName: '',
                dealDate: '',
                // arhives: '',
            },
            deals: [],
            errorMessage: null,
            query: null,
            // arhives: false,
        }
    },
    name: "OrderList",
    created: async function () {
        this.update()
    },
    methods: {
        navigateToDeal(dealId) {
            this.$router.push({ path: '/CounterpartiesOrders/' + dealId });
        },
            toDay() {
      const today = new Date();
      return today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
    },

    parseDate(dateString) {
      let [day, month, year] = dateString.split('.');
      return year + '/' + month + '/' + day;
    },

    isTodayPay(data) {
      if (this.parseDate(data) === this.toDay()) {
        return true
      }
    },

    isLostPay(data) {
      if (this.parseDate(data) < this.toDay()) {
        return true
      }
    },
        update: function () {
            this.loading = true;
            // CounterpartiesOrdersService.getDeals(this.filters)
            //     .then(response => this.deals = response.data.deals)
            //     .catch(error => this.errorMessage = error)
            //     .finally(() => this.loading = false)
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
    },
    watch: {
        'filters.clientName': _.debounce(function () {
            this.update()
        }, 500),
        'filters.ownerName': _.debounce(function () {
            this.update()
        }, 500),
        'filters.activeName': _.debounce(function () {
            this.update()
        }, 500),
        'filters.dealDate': _.debounce(function () {
            this.update()
        }, 500),
            'arhives': _.debounce(function () {
      // if (this.arhives === true) {
      //   this.filters.arhives = 1
      // } else {
      //   this.filters.arhives = ''
      // }
      // this.update()

    }, 500)
    }
}
</script>
