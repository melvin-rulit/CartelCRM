import './bootstrap';
import 'flowbite';

import {createApp} from 'vue'
import {createRouter, createWebHashHistory} from 'vue-router'

import App from './components/App.vue'
import UsersList from "./components/users/UsersList.vue";
import UserCreateForm from "./components/users/UserCreateForm.vue";
import UserEditForm from "./components/users/UserEditForm.vue";

import ProvidersList from "./components/Providers/ProvidersList.vue";
import ProviderDetail from "./components/Providers/ProviderDetail.vue";
import ProviderCreateForm from "./components/Providers/ProviderCreateForm.vue";
import ProviderEditForm from "./components/Providers/ProviderEditForm.vue";

import CounterpartiesList from "./components/Counterparties/CounterpartiesList.vue";
import CounterpartiesDetail from "./components/Counterparties/CounterpartiesDetail.vue";
import CounterpartiesCreateForm from "./components/Counterparties/CounterpartiesCreateForm.vue";
import CounterpartiesEditForm from "./components/Counterparties/CounterpartiesEditForm.vue";

import OrderList from "./components/CounterpartiesOrders/OrdersList.vue";
import OrderDetail from "./components/CounterpartiesOrders/OrderDetail.vue";
import OrderCreateForm from "./components/CounterpartiesOrders/OrderCreateForm.vue";
import OrderEditForm from "./components/CounterpartiesOrders/OrderEditForm.vue";

import BranchesList from "./components/branches/BranchesList.vue";
import BranchCreateForm from "./components/branches/BranchCreateForm.vue";
import BranchEditForm from "./components/branches/BranchEditForm.vue";
import ActivesList from "./components/actives/ActivesList.vue";
import ActiveCreateForm from "./components/actives/ActiveCreateForm.vue";
import ActiveEditForm from "./components/actives/ActiveEditForm.vue";



import SourcesList from "./components/sourcees/SourcesList.vue";
import SourceCreateForm from "./components/sourcees/SourceCreateForm.vue";
import SourceEditForm from "./components/sourcees/SourceEditForm.vue";
import StatsPayments from "./components/stats/StatsPayments.vue";
import StatsActives from "./components/stats/StatsActives.vue";

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            component: UsersList
        },
        //Пользователи
        {
            name: 'listUsers',
            path: '/users',
            component: UsersList
        },
        {
            name: 'createUser',
            path: '/users/create',
            component: UserCreateForm
        },
        {
            name: 'editUser',
            path: '/users/:id',
            component: UserEditForm
        },
        //Поставщики
        {
            name: 'providersList',
            path: '/providers',
            component: ProvidersList
        },
        {
            name: 'DetailProvider',
            path: '/providers/detail/:id',
            component: ProviderDetail
        },
        {
            name: 'createProvider',
            path: '/providers/create',
            component: ProviderCreateForm
        },
        {
            name: 'editProvider',
            path: '/providers/:id',
            component: ProviderEditForm
        },
        //Контрагенты
        {
            name: 'listCounterparties',
            path: '/counterparties',
            component: CounterpartiesList
        },
        {
            name: 'DetailCounterparties',
            path: '/counterparties/detail/:id',
            component: CounterpartiesDetail
        },
        {
            name: 'createCounterparties',
            path: '/counterparties/create',
            component: CounterpartiesCreateForm
        },
        {
            name: 'editCounterparties',
            path: '/counterparties/:id',
            component: CounterpartiesEditForm
        },
        //Заказы
        {
            name: 'ordersList',
            path: '/orders',
            component: OrderList
        },
        {
            name: 'DetailOrder',
            path: '/orders/detail/:id',
            component: OrderDetail
        },
        {
            name: 'createOrder',
            path: '/orders/create',
            component: OrderCreateForm
        },
        {
            name: 'editOrder',
            path: '/orders/:id',
            component: OrderEditForm
        },
        //Филиалы
        {
            name: 'listBranches',
            path: '/branches',
            component: BranchesList
        },
        {
            name: 'createBranch',
            path: '/branches/create',
            component: BranchCreateForm
        },
        {
            name: 'editBranch',
            path: '/branches/:id',
            component: BranchEditForm
        },
        //Активы
        {
            name: 'activesList',
            path: '/actives',
            component: ActivesList
        },
        {
            name: 'createActive',
            path: '/actives/create',
            component: ActiveCreateForm
        },
        {
            name: 'editActive',
            path: '/actives/:id',
            component: ActiveEditForm
        },
        //Источники финансирования
        {
            name: 'sourcesList',
            path: '/sources',
            component: SourcesList
        },
        {
            name: 'createSource',
            path: '/sources/create',
            component: SourceCreateForm
        },
        {
            name: 'editSource',
            path: '/sources/:id',
            component: SourceEditForm
        },
        //Отчет по финансовым операциям
        {
            name: 'statsPayments',
            path: '/stats-payments',
            component: StatsPayments
        },
        //Отчет по остаточной стоимости актива
        {
            name: 'statsActives',
            path: '/stats-actives',
            component: StatsActives
        }
    ],
    linkActiveClass: 'bg-gray-200'
})

createApp(App).use(router).mount('#app')
