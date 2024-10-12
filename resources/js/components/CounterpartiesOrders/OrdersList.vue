<template>
  <Spinner v-show="this.loading"/>
  <Alert :errors="this.errorMessage"/>
  <Success :message="this.message"/>
    <div class="sm:px-6 w-full">
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <h3 class="text-4xl font-extrabold dark:text-white">Сделки</h3>
            <div class="mt-7 overflow-x-auto">
                <form>
                    <div class="grid md:grid-cols-4 md:gap-6 mt-4 rounded-full p-4 mb-10 border border-gray-100 rounded-0">
                        <div>
                            <TextInput @keyup="update()" v-model:value="filters.clientName" title="ФИО Клиента" type="text"/>
                        </div>
                        <div>
                            <TextInput @keyup="update()" v-model:value="filters.ownerName" title="ФИО арендодателя" type="text"/>
                        </div>
                        <div>
                            <TextInput @keyup="update()" v-model:value="filters.activeName" title="Наименование актива" type="text"/>
                        </div>
                        <div>
                            <DateInput @keyup="update()" v-model:value="filters.dealDate" title="Дата договора" type="date"/>
                        </div>
                    </div>
                </form>
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-100 border">
                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Дата платежа</p>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Источник финансирования</p>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Актив</p>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Клиент</p>
                            </div>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Остаток ОД</p>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Аренда</p>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Выкуп</p>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Дата окончания страховки</p>
                        </td>
                        <td class="">
                            <div class="flex items-center pl-5">
                                <p class="text-base leading-none text-gray-600 ml-2">Дата заключения договора</p>
                            </div>
                        </td>
                        <td class="">
                            <p class="text-base leading-none text-gray-600 ml-2 pl-5">Действия</p>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="deal of deals" :key=deal.id tabindex="0"
                        class="focus:outline-none h-16 border border-gray-100 rounded cursor-pointer hover:bg-blue-100"
                        @click="navigateToDeal(deal.id)" :class="{  'bg-green-200': isTodayPay(deal.nextPayday), 'bg-red-200': isLostPay(deal.nextPayday) }">
                      <td>
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ deal.nextPayday }}</p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ deal.active.investor.name }}</p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ deal.active.model }}
                              ({{ deal.active.regNumber }})</p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p v-if="deal.client" class="text-sm leading-none text-gray-600 ml-2">{{ deal.client.fullName }}</p>
                            <p v-else class="text-sm leading-none text-gray-600 ml-2"> Удален </p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ realRemain(deal) }}</p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ deal.costOfRent }}</p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ deal.costOfBuyout }}</p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ deal.active.osagoPrintable }}</p>
                        </div>
                      </td>

                      <td class="">
                        <div class="flex items-center pl-5">
                            <p class="text-sm leading-none text-gray-600 ml-2">{{ deal.createdAtPrintable }}</p>
                        </div>
                      </td>
                        <td class="pl-4">
                            <div class="flex">
                                    <svg  @click="navigateToDeal(deal.id)" fill="none" height="25" width=25 stroke="currentColor" stroke-width="1.5"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                    </svg>
                                <button @click="deleteDeal(deal.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">
                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                    </svg>
                                </button>

                                <button @click="archiveDeal(deal.id)"
                                            class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-700 text-sm leading-none py-2 px-2 rounded hover:bg-green-200 focus:outline-none">
                                    <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 2.5c.651 0 .977 0 1.241.083a1.8 1.8 0 0 1 1.176 1.176c.083.264.083.59.083 1.241v11.62c0 1.008 0 1.512-.196 1.897a1.8 1.8 0 0 1-.787.787c-.385.196-.889.196-1.897.196H6.38c-1.008 0-1.512 0-1.897-.196a1.8 1.8 0 0 1-.787-.787c-.196-.385-.196-.889-.196-1.897V5c0-.651 0-.977.083-1.241A1.8 1.8 0 0 1 4.76 2.583C5.023 2.5 5.349 2.5 6 2.5"
                                            stroke="#222"/>
                                        <path
                                            d="M20.5 12.5h-2.558c-.696 0-1.044 0-1.306.189-.262.188-.372.518-.592 1.178l-.088.265c-.22.66-.33.99-.592 1.18-.262.188-.61.188-1.306.188H9.943c-.696 0-1.044 0-1.306-.189-.262-.188-.372-.518-.592-1.178l-.088-.265c-.22-.66-.33-.99-.592-1.18-.262-.188-.61-.188-1.306-.188H3.5m12.667 1H7.833m12.667-6h-2.558c-.696 0-1.044 0-1.306.189s-.372.519-.592 1.179l-.088.264c-.22.66-.33.99-.592 1.18-.262.188-.61.188-1.306.188H9.943c-.696 0-1.044 0-1.306-.189-.262-.188-.372-.519-.592-1.179l-.088-.264c-.22-.66-.33-.99-.592-1.18-.262-.188-.61-.188-1.306-.188H3.5m12.667 1H7.833m10.667-6h-.558c-.696 0-1.044 0-1.306.189s-.372.519-.592 1.179l-.088.264c-.22.66-.33.99-.592 1.18-.262.188-.61.188-1.306.188H9.943c-.696 0-1.044 0-1.306-.189s-.372-.519-.592-1.179l-.088-.264c-.22-.66-.33-.99-.592-1.18-.262-.188-.61-.188-1.306-.188H5.5m10.667 1H7.833"
                                            stroke="#222"/>
                                    </svg>
                                </button>

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sm:flex items-center justify-between">
                <router-link to="/deals/create"
                             class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Добавить сделку</p>
                </router-link>
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
// import {UserService} from "../../services/UserService";

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
                arhives: '',
            },
            deals: [],
            errorMessage: null,
            query: null,
            arhives: false,
        }
    },
    name: "DealsList",
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
            CounterpartiesOrdersService.getDeals(this.filters)
                .then(response => this.deals = response.data.deals)
                .catch(error => this.errorMessage = error)
                .finally(() => this.loading = false)
        },
        realRemain: function (deal) {
            let remain = deal.remain
            const payments = deal.payments

            payments.forEach(function (payment) {
                remain -= payment.buyout
            })

            return remain;
        },
        deleteDeal: function(id) {
            if (confirm('Вы действительно хотите удалить сделку?')) {
                CounterpartiesOrdersService.delete(id)
                    .then(() => this.update(this.page))
                    .catch(error => this.errorMessage = error.response.data.error)
            }
        },
            archiveDeal: function (id) {
      if (confirm('Вы действительно хотите переместить сделку в архив?')) {
        CounterpartiesOrdersService.arhive(id)
            .then(() => this.update(this.page))
            .catch(error => this.errorMessage = error.response.data.error)
        this.message = 'Сделка перенесена в архив'
        setTimeout(() => {
          this.message = ''
        }, 2000)
      }
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
      if (this.arhives === true) {
        this.filters.arhives = 1
      } else {
        this.filters.arhives = ''
      }
      this.update()

    }, 500)
    }
}
</script>
