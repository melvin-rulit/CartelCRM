<!--<template>-->
<!--    <div class="flex bg-gray-50 dark:bg-gray-900">-->
<!--        <aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-90 h-full  font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">-->
<!--            <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">-->
<!--                <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">-->
<!--                    <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">-->
<!--                        <ul class="pb-2 space-y-2">-->
<!--                            <li>-->
<!--                                <form action="#" method="GET" class="lg:hidden">-->
<!--                                    <label for="mobile-search" class="sr-only">Search</label>-->
<!--                                    <div class="relative">-->
<!--                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">-->
<!--                                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>-->
<!--                                        </div>-->
<!--                                        <input type="text" name="email" id="mobile-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'admin' || this.role === 'manager'">-->
<!--                                <router-link to="/users" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.656 12.115a3 3 0 0 1 5.682-.015M13 5h3m-3 3h3m-3 3h3M2 1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm6.5 4.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Пользователи</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'cashier' || this.role === 'admin' || this.role === 'manager'">-->
<!--                                <router-link to="/providers" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.656 12.115a3 3 0 0 1 5.682-.015M13 5h3m-3 3h3m-3 3h3M2 1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Zm6.5 4.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Поставщики</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'admin' || this.role === 'manager'">-->
<!--                                <router-link to="/providers/orders" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.5 10.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm0 0a2.225 2.225 0 0 0-1.666.75H12m3.5-.75a2.225 2.225 0 0 1 1.666.75H19V7m-7 4V3h5l2 4m-7 4H6.166a2.225 2.225 0 0 0-1.666-.75M12 11V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v9h1.834a2.225 2.225 0 0 1 1.666-.75M19 7h-6m-8.5 3.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Заказы поставщикам</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--&lt;!&ndash;                            <li>&ndash;&gt;-->
<!--&lt;!&ndash;                                <router-link to="/counterparties" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3a3 3 0 1 1-1.614 5.53M15 12a4 4 0 0 1 4 4v1h-3.348M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <span class="ml-3" sidebar-toggle-item="">Контрагенты</span>&ndash;&gt;-->
<!--&lt;!&ndash;                                   </router-link>&ndash;&gt;-->
<!--&lt;!&ndash;                                <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>&ndash;&gt;-->

<!--&lt;!&ndash;                            </li>&ndash;&gt;-->
<!--                            <li v-show="this.role === 'cashier' || this.role === 'admin' || this.role === 'manager'" class="flex items-center justify-between">-->
<!--                                <router-link to="/counterparties" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 3a3 3 0 1 1-1.614 5.53M15 12a4 4 0 0 1 4 4v1h-3.348M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3">Контрагенты</span>-->
<!--                                </router-link>-->

<!--                                <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">-->
<!--                                    <svg class="w-6 h-6 ml-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">-->
<!--                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>-->
<!--                                    </svg>-->
<!--                                </button>-->

<!--                            </li>-->

<!--                            <li v-show="this.role === 'admin' || this.role === 'manager'">-->
<!--                                <router-link to="/counterparties/orders" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.5 10.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm0 0a2.225 2.225 0 0 0-1.666.75H12m3.5-.75a2.225 2.225 0 0 1 1.666.75H19V7m-7 4V3h5l2 4m-7 4H6.166a2.225 2.225 0 0 0-1.666-.75M12 11V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v9h1.834a2.225 2.225 0 0 1 1.666-.75M19 7h-6m-8.5 3.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Заказы контрагентов</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'admin' || this.role === 'manager'">-->
<!--                                <router-link to="/deals" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Склады</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'admin' || this.role === 'manager' || this.role === 'courier'">-->
<!--                                <router-link to="/deals" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Курьеры</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'admin' || this.role === 'cashier'">-->
<!--                                <router-link to="/deals" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Кассир</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'admin'">-->
<!--                                <router-link to="/deals" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">Инвестиции</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                            <li v-show="this.role === 'admin'">-->
<!--                                <router-link to="/deals" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">-->
<!--                                    <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">-->
<!--                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1M2 5h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>-->
<!--                                    </svg>-->
<!--                                    <span class="ml-3" sidebar-toggle-item="">График работы</span>-->
<!--                                </router-link>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </aside>-->

<!--        <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>-->

<!--        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">-->
<!--            <Body/>-->
<!--            <Footer/>-->
<!--        </div>-->

<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--// import {UserService} from "../services/UserService";-->
<!--// import Body from "./Body.vue";-->
<!--// import Footer from "./Footer.vue";-->

<!--export default {-->
<!--    components: {Body, Footer},-->
<!--    data: function () {-->
<!--        return {-->
<!--            user: {-->
<!--                name: 'loading',-->
<!--                email: null,-->
<!--                roleId: null-->
<!--            },-->
<!--            role: ''-->
<!--        }-->
<!--    },-->
<!--    created: async function () {-->
<!--        UserService.currentUser().then(response => {-->
<!--            this.user = response.data.user-->
<!--            this.role = response.data.role-->
<!--        })-->
<!--    },-->
<!--    name: "Navigation",-->
<!--}-->
<!--</script>-->

<template>
<aside class="sidebar">
<!--<a href="/" class="logo"><img src="@/assets/ico/logo.svg" alt="logo"></a>-->
<!--    <img src="{{ asset('assets/ico/logo.svg') }}" alt="logo">-->
<!--    <img :src="logo" alt="logo">-->
<nav>
    <ul>

        <li><router-link to="/dashboard"><Icon class="ico" icon="lucide:home" /> Панель управления</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/users"><Icon class="ico" icon="lucide:users" /> Пользователи</router-link></li>
        <li v-show="this.role === 'cashier' || this.role === 'admin' || this.role === 'manager'"><router-link to="/suppliers"><Icon class="ico" icon="lucide:truck" /> Поставщики</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/supplier-orders"><Icon class="ico" icon="lucide:shopping-cart" /> Заказы поставщикам</router-link></li>
        <li v-show="this.role === 'cashier' || this.role === 'admin' || this.role === 'manager'"><router-link to="/contractors"><Icon class="ico" icon="lucide:briefcase" /> Контрагенты</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/contractor-orders"><Icon class="ico" icon="lucide:file-text" /> Заказы контрагентов</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/warehouses"><Icon class="ico" icon="lucide:package" /> Склады</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager' || this.role === 'courier'"><router-link to="/funding-sources"><Icon class="ico" icon="lucide:hand-coins" /> Курьеры</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'cashier'"><router-link to="/branches"><Icon class="ico" icon="lucide:waypoints" /> Кассир</router-link></li>
        <li v-show="this.role === 'admin'"><router-link to="/financial-reports"><Icon class="ico" icon="lucide:archive-restore" /> Инвестиции</router-link></li>
        <li v-show="this.role === 'admin'"><router-link to="/assets-reports"><Icon class="ico" icon="lucide:pie-chart" /> График работы</router-link></li>
    </ul>
</nav>
<div class="sidebar-bottom">
    <ButtonUI><Icon icon="jam:settings-alt" class="ico" /> Настройки</ButtonUI>
    <div class="bottom-icons">
        <Icon icon="mdi:bell-outline" class="bottom-icon" />
        <div class="avatar"></div>
        <Icon icon="ic:baseline-search" class="bottom-icon" />
    </div>
</div>
</aside>
            <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>

            <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
                <Body/>
                <Footer/>
            </div>


</template>
<script>
import { Icon } from '@iconify/vue';
import ButtonUI from "./UI/ButtonUI.vue";
import Body from "./Body.vue";
import Footer from "./Footer.vue";
import {UserService} from "../services/UserService";

export default {
    name: "Navigation",
    components: {ButtonUI, Icon, Body, Footer},
    data: function () {
        return {
            user: {
                name: 'loading',
                email: null,
                roleId: null
            },
            role: ''
        }
    },
    created: async function () {
        UserService.currentUser().then(response => {
            this.user = response.data.user
            this.role = response.data.role
        })
    },
};
</script>

<style scoped lang="scss">
.sidebar {
    position: fixed;
    width: 250px;
    max-height: 100vh;
    background-color: #ffffff;
    color: #fff;
    padding: 20px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Добавлено для распределения пространства между элементами */
    border-right: 1px solid #e3ebf6;

    .ico {
        font-size: 18px;
        margin-right: 10px; /* Отступ между иконкой и текстом */
    }

    .logo {
        padding: 1rem 0;
        margin: 0 auto;

        img {
            width: 50px;
            height: 50px;
        }
    }

    nav {
        font-size: 1rem;
        line-height: 1.4rem;
        padding-bottom: .125em;

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 1em;

            li {
                margin-bottom: 15px;

                a {
                    display: flex;
                    align-items: center;
                    color: #6e84a3;
                    text-decoration: none;
                    font-size: 16px;
                    transition: color 0.3s ease;

                    &:hover {
                        color: #111;
                    }
                }

                .router-link-active {
                    color: #111;
                }
            }
        }
    }

    /* Стили для нижнего блока */
    .sidebar-bottom {
        margin-top: auto; /* Прижимает к низу */
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;

        /* Стили для нижнего ряда иконок */
        .bottom-icons {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            padding: 20px 0 10px;
            border-top: 1px solid #e3ebf6;;
            margin-top: 1.5em;

            .bottom-icon {
                font-size: 20px; /* Размер иконок */
                color: #6e84a3; /* Изменение цвета при наведении */
                cursor: pointer;

                &:hover {
                    color: #111; /* Изменение цвета при наведении */
                }
            }

            .avatar {
                width: 40px; /* Размер аватарки */
                height: 40px;
                border-radius: 50%; /* Круглая форма */
                background-color: #6e84a3; /* Цвет фона для аватарки */
            }
        }
    }
}
</style>
