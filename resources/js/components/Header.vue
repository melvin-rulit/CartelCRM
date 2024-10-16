<template>
    <div>
        <h1>{{ title }}</h1> <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'Напишите заголовок' // Текст по умолчанию
        }
    }
}
</script>

<!--<template>-->
<!--    <nav class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">-->
<!--        <div class="px-3 py-1 lg:px-5 lg:pl-3">-->
<!--            <div class="flex items-center justify-between">-->
<!--                <div class="flex items-center justify-start">-->
<!--&lt;!&ndash;                    <button id="toggleSidebarMobile" @click="toggle" aria-expanded="true" aria-controls="sidebar"&ndash;&gt;-->
<!--&lt;!&ndash;                            class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&ndash;&gt;-->
<!--&lt;!&ndash;                        <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"&ndash;&gt;-->
<!--&lt;!&ndash;                             xmlns="http://www.w3.org/2000/svg">&ndash;&gt;-->
<!--&lt;!&ndash;                            <path fill-rule="evenodd"&ndash;&gt;-->
<!--&lt;!&ndash;                                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"&ndash;&gt;-->
<!--&lt;!&ndash;                                  clip-rule="evenodd"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                        </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                        <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor"&ndash;&gt;-->
<!--&lt;!&ndash;                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">&ndash;&gt;-->
<!--&lt;!&ndash;                            <path fill-rule="evenodd"&ndash;&gt;-->
<!--&lt;!&ndash;                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"&ndash;&gt;-->
<!--&lt;!&ndash;                                  clip-rule="evenodd"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                        </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                    </button>&ndash;&gt;-->
<!--&lt;!&ndash;                                        <div class="flex items-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                <button type="button"&ndash;&gt;-->
<!--&lt;!&ndash;                                                        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"&ndash;&gt;-->
<!--&lt;!&ndash;                                                        id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <span class="sr-only">Open user menu</span>&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <img class="w-8 h-8 rounded-full"&ndash;&gt;-->
<!--&lt;!&ndash;                                                         src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"&ndash;&gt;-->
<!--&lt;!&ndash;                                                         alt="user photo">&ndash;&gt;-->
<!--&lt;!&ndash;                                                </button>&ndash;&gt;-->
<!--&lt;!&ndash;                                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                            <ul class="py-1" role="none">&ndash;&gt;-->
<!--&lt;!&ndash;                                                <li>&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <a href="" @click="logout"&ndash;&gt;-->
<!--&lt;!&ndash;                                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"&ndash;&gt;-->
<!--&lt;!&ndash;                                                       role="menuitem">Выйти из системы</a>&ndash;&gt;-->
<!--&lt;!&ndash;                                                </li>&ndash;&gt;-->
<!--&lt;!&ndash;                                            </ul>&ndash;&gt;-->
<!--&lt;!&ndash;                                            <div&ndash;&gt;-->
<!--&lt;!&ndash;                                                class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"&ndash;&gt;-->
<!--&lt;!&ndash;                                                id="dropdown-2" data-popper-placement="bottom"&ndash;&gt;-->
<!--&lt;!&ndash;                                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(2476px, 61px);">&ndash;&gt;-->
<!--&lt;!&ndash;                                                <div class="px-4 py-3" role="none">&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <p class="text-sm text-gray-900 dark:text-white" role="none">&ndash;&gt;-->
<!--&lt;!&ndash;                                                        {{ user.name }}&ndash;&gt;-->
<!--&lt;!&ndash;                                                    </p>&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">&ndash;&gt;-->
<!--&lt;!&ndash;                                                        {{ user.email }}&ndash;&gt;-->
<!--&lt;!&ndash;                                                    </p>&ndash;&gt;-->
<!--&lt;!&ndash;                                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                <ul class="py-1" role="none">&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <li>&ndash;&gt;-->
<!--&lt;!&ndash;                                                        <a href="" @click="logout"&ndash;&gt;-->
<!--&lt;!&ndash;                                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"&ndash;&gt;-->
<!--&lt;!&ndash;                                                           role="menuitem">Выйти из системы</a>&ndash;&gt;-->
<!--&lt;!&ndash;                                                    </li>&ndash;&gt;-->
<!--&lt;!&ndash;                                                </ul>&ndash;&gt;-->
<!--&lt;!&ndash;                                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--<div></div>-->



<!--&lt;!&ndash;                    <div class="flex items-center justify-between">&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteUsers" class="text-2xl font-extrabold dark:text-white md:ml-56">Список пользователей</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteProviders" class="text-2xl font-extrabold dark:text-white md:ml-56">Список поставщиков</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteProvidersDetail" class="text-2xl font-extrabold dark:text-white md:ml-56 py-4">Детальная информация поставщика</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteProvidersCreate" class="text-2xl font-extrabold dark:text-white md:ml-56 py-4">Добавление поставщика</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteProvidersEdit" class="text-2xl font-extrabold dark:text-white md:ml-56 py-4">Редактирование постовщика</h3>&ndash;&gt;-->

<!--&lt;!&ndash;                        <h3 v-if="isThisRouteCounterparties" class="text-2xl font-extrabold dark:text-white md:ml-56">Список контрагентов</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteCounterpartiesDetail" class="text-2xl font-extrabold dark:text-white md:ml-56 py-4">Детальная информация контрагента</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteCounterpartiesCreate" class="text-2xl font-extrabold dark:text-white md:ml-56 py-4">Добавление контрагента</h3>&ndash;&gt;-->
<!--&lt;!&ndash;                        <h3 v-if="isThisRouteCounterpartiesEdit" class="text-2xl font-extrabold dark:text-white md:ml-56 py-4">Редактирование контрагента</h3>&ndash;&gt;-->



<!--&lt;!&ndash;                        <form v-if="!isThisRouteProvidersCreate & !isThisRouteCounterpartiesCreate & !isThisRouteProvidersDetail &&ndash;&gt;-->
<!--&lt;!&ndash;                        !isThisRouteCounterpartiesDetail & !isThisRouteProvidersEdit & !isThisRouteCounterpartiesEdit" class="flex-grow ml-4"> &lt;!&ndash; Добавлен класс ml-4 для отступа &ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="grid md:grid-cols-2 md:gap-6 rounded-full p-3">&ndash;&gt;-->
<!--&lt;!&ndash;                                <div class="relative z-0 w-50 group rounded-full">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <TextInput @keyup="update()" v-model:value="query" title="" type="text" :placeholder="'Поиск'"/>&ndash;&gt;-->
<!--&lt;!&ndash;                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </form>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->



<!--&lt;!&ndash;                                        <form action="#" method="GET" class="hidden lg:block lg:pl-3.5">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <label for="topbar-search" class="sr-only">Search</label>&ndash;&gt;-->
<!--&lt;!&ndash;                                            <div class="relative mt-1 lg:w-96">&ndash;&gt;-->
<!--&lt;!&ndash;                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                                <input type="text" name="email" id="topbar-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">&ndash;&gt;-->
<!--&lt;!&ndash;                                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </form>&ndash;&gt;-->


<!--                </div>-->
<!--&lt;!&ndash;                <div  class="flex items-center">&ndash;&gt;-->

<!--&lt;!&ndash;                    <router-link v-if="isThisRouteProviders" to="/providers/create"&ndash;&gt;-->
<!--&lt;!&ndash;                                 class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-500 hover:bg-indigo-600 focus:outline-none rounded"&ndash;&gt;-->
<!--&lt;!&ndash;                                 type="button">&ndash;&gt;-->
<!--&lt;!&ndash;                        <p class="text-sm font-medium leading-none text-white">Добавить поставщика</p>&ndash;&gt;-->
<!--&lt;!&ndash;                    </router-link>&ndash;&gt;-->
<!--&lt;!&ndash;                    <router-link v-if="isThisRouteCounterparties" to="/counterparties/create"&ndash;&gt;-->
<!--&lt;!&ndash;                                 class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded"&ndash;&gt;-->
<!--&lt;!&ndash;                                 type="button">&ndash;&gt;-->
<!--&lt;!&ndash;                        <p class="text-sm font-medium leading-none text-white">Добавить контрагента</p>&ndash;&gt;-->
<!--&lt;!&ndash;                    </router-link>&ndash;&gt;-->

<!--&lt;!&ndash;                </div>&ndash;&gt;-->

<!--            </div>-->
<!--        </div>-->
<!--    </nav>-->
<!--</template>-->

<!--<script>-->
<!--import {UserService} from "../services/UserService";-->
<!--import {ActiveService} from "../services/ActiveService";-->
<!--import TextInput from "./forms/TextInput.vue";-->

<!--export default {-->
<!--    name: "Header",-->
<!--    components: {TextInput},-->
<!--    data: function () {-->
<!--        return {-->
<!--            'user': {-->
<!--                'email': null,-->
<!--                'name': null-->
<!--            },-->
<!--            sidebarVisible: false,-->
<!--            actives:[],-->
<!--        }-->
<!--    },-->
<!--    computed: {-->
<!--        isThisRouteUsers() {-->
<!--            return this.$route.name === 'listUsers';-->
<!--        },-->

<!--        isThisRouteProviders() {-->
<!--            return this.$route.name === 'providersList';-->
<!--        },-->
<!--        isThisRouteProvidersDetail() {-->
<!--            return this.$route.name === 'DetailProvider';-->
<!--        },-->
<!--        isThisRouteProvidersCreate() {-->
<!--            return this.$route.name === 'createProvider';-->
<!--        },-->
<!--        isThisRouteProvidersEdit() {-->
<!--            return this.$route.name === 'editProvider';-->
<!--        },-->


<!--        isThisRouteCounterparties() {-->
<!--            return this.$route.name === 'listCounterparties';-->
<!--        },-->
<!--        isThisRouteCounterpartiesDetail() {-->
<!--            return this.$route.name === 'DetailCounterparties';-->
<!--        },-->
<!--        isThisRouteCounterpartiesCreate() {-->
<!--            return this.$route.name === 'createCounterparties';-->
<!--        },-->
<!--        isThisRouteCounterpartiesEdit() {-->
<!--            return this.$route.name === 'editCounterparties';-->
<!--        },-->

<!--    },-->

<!--    mounted() {-->
<!--        UserService.currentUser()-->
<!--            .then(response => this.user = response.data.user)-->
<!--    },-->

<!--    methods: {-->
<!--        logout: function (event) {-->
<!--            event.preventDefault()-->
<!--            axios.post('/logout', {})-->
<!--                .then(response => {-->
<!--                    // Здесь можно проверить ответ, если нужно-->
<!--                    if (response.status === 200) {-->
<!--                        document.location.href = '/login';-->
<!--                    }-->
<!--                })-->
<!--                .catch(error => {-->
<!--                    console.error('Logout error:', error);-->
<!--                    // Здесь можно обработать ошибку, если нужно-->
<!--                });-->
<!--        },-->
<!--        toggle: function () {-->
<!--            if (this.sidebarVisible == false) {-->
<!--                document.getElementById('sidebar').style.display = 'block'-->
<!--                document.getElementById('toggleSidebarMobileHamburger').style.display = 'none'-->
<!--                document.getElementById('toggleSidebarMobileClose').style.display = 'block'-->
<!--                this.sidebarVisible = true-->
<!--            } else {-->
<!--                document.getElementById('sidebar').style.display = 'none'-->
<!--                document.getElementById('toggleSidebarMobileHamburger').style.display = 'block'-->
<!--                document.getElementById('toggleSidebarMobileClose').style.display = 'none'-->
<!--                this.sidebarVisible = false-->
<!--            }-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<style>-->
<!--.custom-button {-->
<!--  display: inline-block;-->
<!--  position: relative;-->
<!--  padding: 2px 25px 5px 8px;-->
<!--  background-color: #b3d7ff; /* Primary button color */-->
<!--  /*color: #fff; !* Text color *!*/-->
<!--  border: none;-->
<!--  border-radius: 4px;-->
<!--  cursor: pointer;-->
<!--  transition: background-color 0.3s ease;-->
<!--}-->
<!--.badge {-->
<!--  position: absolute;-->
<!--  top: 50%;-->
<!--  right: 2px;-->
<!--  transform: translate(0%, -50%);-->
<!--  background-color: #f8f9fa; /* Badge background color */-->
<!--  color: #000; /* Badge text color */-->
<!--  padding: 4px 6px;-->
<!--  /*border-radius: 50%;*/-->
<!--  font-size: 12px;-->
<!--  font-weight: bold;-->
<!--}-->
<!--</style>-->
