<template>
  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
    <div class="px-6 py-6 lg:px-8">
      <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Добавление сделки</h3>
      <Alert :errors="errors"/>
      <Success :message="message"/>
      <form @submit="store">
        <div class="relative z-0 w-full mb-6 group">
          <Select title="Тип сделки" v-model:value="deal.type" :values="types"/>
        </div>
        <div v-if="currentUser.roleId === 1" class="relative z-0 w-full mb-6 group">
          <Select title="Филиал" v-model:value="deal.branchId" :values="branches"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <Select title="Способ оформления сделки" v-model:value="deal.kind" :values="kinds"/>
        </div>
        <div v-show="deal.kind === 'proxy'" class="relative z-0 w-full mb-6 group">
          <Select title="Доверенность" v-model:value="deal.proxyId" :values="proxies"/>
        </div>
        <div v-show="deal.kind === 'owner'" class="relative z-0 w-full mb-6 group">
          <Select title="Арендодатель" v-model:value="deal.ownerId" :values="owners"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <Select title="Арендополучатель" v-model:value="deal.clientId" :values="clients"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <Select title="Актив" v-model:value="deal.activeId" :values="activesList"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <TextInput title="Гражданство арендополучателя" v-model:value="deal.citizenship" type="text"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <NumberInput title="Сумма основного долга" v-model:value="deal.remain" min="0" step="0.01"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <DateInput title="Дата/время договора" v-model:value="deal.createdAt" type="datetime-local"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <NumberInput title="Стоимость аренды" v-model:value="deal.costOfRent" min="0" step="0.01"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <NumberInput title="Стоимость выкупа" v-model:value="deal.costOfBuyout" min="0" step="0.01"/>
        </div>
          <div class="relative z-0 w-full mb-6 group">
              <NumberInput title="Срок выкупа (мес)" v-model:value="deal.redemption_period" min="1" max="12" step="1"/>
        </div>
        <div v-show="this.deal.type === 'credit'" class="relative z-0 w-full group">
          <NumberInput title="Сумма первоначального взноса" v-model:value="deal.initial" min="0" step="0.01"/>
        </div>
        <div class="relative z-0 w-full mb-6 group">
          <Textarea title="Комментарий" v-model:value="deal.comment"/>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <router-link to="/deals" type="button"
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
import TextInput from "../../forms/TextInput.vue";
import Alert from "../../forms/Alert.vue";
import Success from "../../forms/Success.vue";
import Select from "../../forms/Select.vue";
import Textarea from "../../forms/Textarea.vue";
import NumberInput from "../../forms/NumberInput.vue";
import DateInput from "../../forms/DateInput.vue";
import {UserService} from "../../../services/UserService";
import {ProvideService} from "../../../services/ProvideService";
import {ClientService} from "../../../services/ClientService";
import {BranchService} from "../../../services/BranchService";
import {ActiveService} from "../../../services/ActiveService";

export default {
  name: "DealCreateForm",
  components: {DateInput, NumberInput, Textarea, Select, Alert, TextInput, Success},
  data: function () {
    const createdAt = new Date().toISOString().slice(0, 16)
    return {
      loading: false,
      currentUser: {
        roleId: null
      },
      deal: {
        type: null,
        kind: null,
        proxyId: null,
        ownerId: null,
        branchId: null,
        clientId: null,
        activeId: null,
        remain: null,
        createdAt: createdAt,
        validUntil: null,
        costOfRent: null,
        costOfBuyout: null,
        initial: null,
        comment: null,
        redemption_period: null,
        citizenship: null,
      },
      clients: [],
      owners: [],
      branches: [],
      actives: [],
      activesList: [],
      proxies: [],
      types: [],
      kinds: [],
      errors: null,
      submitted: false,
      message: null,
    }
  },

  mounted() {
    CounterpartiesOrdersService.types()
        .then(response => {
          this.types = response.data.types
          this.deal.type = this.types.at(0).id
        })
        .catch(error => this.errors = error)
    CounterpartiesOrdersService.kinds()
        .then(response => {
          this.kinds = response.data.kinds
          this.deal.kind = this.kinds.at(0).id
        })
        .catch(error => this.errors = error)
    ClientService.getClients()
        .then(response => {
          const clients = response.data.clients
          let list = []
          clients.forEach(function (value, key) {
            list.push({'id': Number(value.id), 'name': value.firstName + ' ' + value.lastName})
          })
          this.clients = list
        })
        .catch(error => this.errors = error)
    UserService.currentUser()
        .then(response => this.currentUser = response.data.user)
        .then(() => console.log(this.currentUser))
    UserService.getAdminsList()
        .then(response => {
          const owners = response.data.admins
          let list = []
          owners.forEach(function (value, key) {
            list.push({'id': Number(value.id), 'name': value.name})
          })
          this.owners = list
        })
        .catch(error => this.errors = error)
    BranchService.dict()
        .then(response => this.branches = response.data.branches)
        .catch(error => this.errors = error)
    ActiveService.getActives()
        .then(response => {
          const actives = response.data.actives
          this.actives = actives
          let list = []
          actives.forEach(function (value, key) {
            list.push({'id': Number(value.id), 'name': value.model + ' ' + value.regNumber})
          })
          this.activesList = list
        })
        .catch(error => this.errors = error)
    ProvideService.dict()
        .then(response => this.proxies = response.data.proxies)
        .catch(error => this.errors = error)
  },
  methods: {
    store: async function (event) {
      event.preventDefault()
      this.errors = null
      CounterpartiesOrdersService.store(this.deal)
          .then(response => {
            this.deal = response.data.deal
            this.message = 'Сделка добавлена'
            this.$router.push({name: 'editDeal', params: {id: this.deal.id}})
          })
          .catch(error => {
            this.errors = error.response.data.message
          })
    },
      handleTypeChange() {
          switch (this.deal.type) {
              case 'rent':
                  this.deal.redemption_period = 9;
                  break;
              case 'credit':
                  this.deal.redemption_period = 12;
                  break;
              default:
                  break;
          }
      },
  },
  watch: {
    'deal.activeId': function (newId) {
      let active = null
      this.actives.forEach(function (value) {
        if (Number(value.id) === Number(newId)) {
          active = value
        }
      })
      if (active) {
        this.deal.remain = active.cost
        this.deal.costOfRent = active.costOfRent
        this.deal.costOfBuyout = active.costOfBuyout
      }
    },
      'deal.type': function(newType) {
          this.handleTypeChange()
      }
  },

}
</script>
