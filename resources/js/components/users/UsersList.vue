<!--<template>-->
<!--    <Spinner v-show="this.loading"/>-->
<!--    <Alert :errors="this.errorMessage"/>-->

<!--    <div class="w-full">-->
<!--        <div class="bg-white md:py-7 ">-->

<!--            <div class="mt-3 overflow-x-auto">-->

<!--                <table class="w-full whitespace-nowrap">-->
<!--                    <thead class="bg-gray-100">-->
<!--                    <tr tabindex="0" class="focus:outline-none h-14 border border-gray-100 rounded divide-x">-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-700 mr-2">ФИО</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Дата рождения</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Email-адрес</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Серия паспорта</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Номер паспорта</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Кем выдан паспорт</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Дата выдачи паспорта</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Адрес регистрации</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Фактическое место жительства</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Телефон контактный</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Логин в телеграм</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td v-show="this.role === 'admin'" class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Пароль</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--&lt;!&ndash;                        <td class="">&ndash;&gt;-->

<!--&lt;!&ndash;                        </td>&ndash;&gt;-->
<!--                    </tr>-->
<!--                    </thead>-->

<!--                    <tbody>-->
<!--                    <tr v-for="user of users" :key="user.id" tabindex="0"-->
<!--                        class="focus:outline-none h-12 border border-gray-50 rounded cursor-pointer"-->
<!--                        @click="toDetail(user.id)">-->

<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ user.full_name }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.birthday }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.email }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_series }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_number }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_give }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_issuedByDate }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.registration_address }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.live_adress }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.phone_number }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.telegram }}</p>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                        <td v-show="this.role === 'admin'" class="text-center">-->
<!--                            <div class="flex items-center justify-center">-->
<!--                                <p class="text-sm leading-none text-gray-600 ml-2">{{ user.password_see }}</p>-->
<!--                            </div>-->
<!--                        </td>-->

<!--&lt;!&ndash;                        <td class="text-center">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="flex justify-center">&ndash;&gt;-->
<!--&lt;!&ndash;                                <router-link :to="{path: '/counterparties/detail/' + user.id}">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="size-6">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />&ndash;&gt;-->
<!--&lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />&ndash;&gt;-->
<!--&lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--&lt;!&ndash;                                </router-link>&ndash;&gt;-->

<!--&lt;!&ndash;                                <router-link :to="{path: '/counterparties/' + user.id}">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </button>&ndash;&gt;-->
<!--&lt;!&ndash;                                </router-link>&ndash;&gt;-->

<!--&lt;!&ndash;                                <button @click.stop="deleteUser(user.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">&ndash;&gt;-->
<!--&lt;!&ndash;                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>&ndash;&gt;-->
<!--&lt;!&ndash;                                    </svg>&ndash;&gt;-->
<!--&lt;!&ndash;                                </button>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </td>&ndash;&gt;-->

<!--                    </tr>-->
<!--                    </tbody>-->
<!--                    <router-link to="/users/create"-->
<!--                                 class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded"-->
<!--                                 type="button">-->
<!--                        <p class="text-sm font-medium leading-none text-white">Добавить пользователя</p>-->
<!--                    </router-link>-->
<!--                    <router-link :to="{path: '/users/7'}">-->
<!--                        <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 mr-2 rounded bg-gray-200 hover:bg-gray-300 focus:outline-none">-->
<!--                            Редактировать-->
<!--                        </button>-->

<!--                    </router-link>-->
<!--&lt;!&ndash;                    <router-link :to="{path: '/users/' + user.id}"&ndash;&gt;-->
<!--&lt;!&ndash;                                 class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded"&ndash;&gt;-->
<!--&lt;!&ndash;                                 type="button">&ndash;&gt;-->
<!--&lt;!&ndash;                        <p class="text-sm font-medium leading-none text-white">редактировать пользователя</p>&ndash;&gt;-->
<!--&lt;!&ndash;                    </router-link>&ndash;&gt;-->
<!--                </table>-->
<!--                &lt;!&ndash;                <Pagination @click="update(page)" url="users" :current-page="page" :limit="limit" :total="total" />&ndash;&gt;-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!--</template>-->




<template>
<!--    <div class="container">-->
    <div class="">

        <!-- Первая строка: поиск, выпадающий список для количества строк, кнопка фильтр -->
        <div class="header">
            <Icon icon="ic:baseline-search" class="bottom-icon" />
            <input
                class="form-control"
                v-model="searchQuery"
                @input="handleSearch"
                type="text"
                placeholder="Поиск"
            />
            <select v-model="rowsPerPage" @change="handleRowsChange">
                <option
                    v-for="option in rowsPerPageOptions"
                    :key="option"
                    :value="option"
                >
                    {{ option }} на стр.
                </option>
            </select>
            <ButtonUI
                color="white"
                fontSize="11px"
                padding="5px 10px"
                fontWeight="500"
                @click="toggleFilterDropdown"
            >
                <Icon icon="jam:settings-alt" class="ico" />Фильтр
            </ButtonUI>
        </div>

        <!-- Выпадающее окно фильтрации -->
<!--        <div v-if="isFilterDropdownVisible" class="filter-dropdown">-->
<!--            <h3>Фильтр</h3>-->
<!--            <div class="filter-item">-->
<!--                <label for="name-filter">Название</label>-->
<!--                <select v-model="nameSort">-->
<!--                    <option value="asc">По возрастанию</option>-->
<!--                    <option value="desc">По убыванию</option>-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="filter-item">-->
<!--                <label for="rating-filter">Рейтинг</label>-->
<!--                <select v-model="ratingSort">-->
<!--                    <option value="asc">По возрастанию</option>-->
<!--                    <option value="desc">По убыванию</option>-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="filter-checkboxes">-->
<!--                <h4>Выбор опций</h4>-->
<!--                <label v-for="option in checkboxOptions" :key="option.id">-->
<!--                    <input type="checkbox" v-model="selectedOptions" :value="option.value" />-->
<!--                    {{ option.label }}-->
<!--                </label>-->
<!--            </div>-->
<!--            <ButtonUI @click="applyFilter">Применить</ButtonUI>-->
<!--        </div>-->

        <!-- Вторая строка: чекбокс выбора всех, настраиваемые заголовки колонок -->
        <table>
            <thead>
            <tr>
                <th class="checkbox"><input type="checkbox" @change="toggleSelectAll" v-model="selectAll" /></th>
                <th v-for="(column, index) in columns" :key="index">{{ column }}</th>
            </tr>
                    <tr tabindex="0" class="focus:outline-none h-14 border border-gray-100 rounded divide-x">
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-700 mr-2">ФИО</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Дата рождения</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Email-адрес</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Серия паспорта</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Номер паспорта</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Кем выдан паспорт</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Дата выдачи паспорта</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Адрес регистрации</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Фактическое место жительства</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Телефон контактный</p>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Логин в телеграм</p>
                            </div>
                        </td>
                        <td v-show="this.role === 'admin'" class="text-center">
                            <div class="flex items-center justify-center">
                                <p class="text-base font-semibold leading-none text-gray-600 ml-2">Пароль</p>
                            </div>
                        </td>
<!--                        <td class="">-->

<!--                        </td>-->
                    </tr>
            </thead>

            <!-- Строки с данными -->
                                <tbody>
                                <tr v-for="user of users" :key="user.id" tabindex="0"
                                    class="focus:outline-none h-12 border border-gray-50 rounded cursor-pointer"
                                    @click="toDetail(user.id)">

                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">{{ user.full_name }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.birthday }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.email }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_series }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_number }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_give }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.passport_issuedByDate }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.registration_address }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.live_adress }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.phone_number }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.telegram }}</p>
                                        </div>
                                    </td>
                                    <td v-show="this.role === 'admin'" class="text-center">
                                        <div class="flex items-center justify-center">
                                            <p class="text-sm leading-none text-gray-600 ml-2">{{ user.password_see }}</p>
                                        </div>
                                    </td>

            <!--                        <td class="text-center">-->
            <!--                            <div class="flex justify-center">-->
            <!--                                <router-link :to="{path: '/counterparties/detail/' + user.id}">-->
            <!--                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">-->
            <!--                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" class="size-6">-->
            <!--                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />-->
            <!--                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />-->
            <!--                                        </svg>-->
            <!--                                    </button>-->
            <!--                                </router-link>-->

            <!--                                <router-link :to="{path: '/counterparties/' + user.id}">-->
            <!--                                    <button class="text-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-sm leading-none py-2 px-2 rounded hover:bg-gray-200 focus:outline-none">-->
            <!--                                        <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">-->
            <!--                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>-->
            <!--                                        </svg>-->
            <!--                                    </button>-->
            <!--                                </router-link>-->

            <!--                                <button @click.stop="deleteUser(user.id)" class="text-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none py-2 px-2 rounded hover:bg-red-200 focus:outline-none">-->
            <!--                                    <svg fill="none" height="25" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">-->
            <!--                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>-->
            <!--                                    </svg>-->
            <!--                                </button>-->
            <!--                            </div>-->
            <!--                        </td>-->

                                </tr>
                                </tbody>
<!--            <tbody>-->

<!--&lt;!&ndash;            <tr v-for="(row, rowIndex) in paginatedData" :key="rowIndex">&ndash;&gt;-->
<!--&lt;!&ndash;                <td><input type="checkbox" v-model="selectedRows" :value="row" /></td>&ndash;&gt;-->
<!--&lt;!&ndash;                <td v-for="(column, index) in columns" :key="index">{{ row[column] }}</td>&ndash;&gt;-->
<!--&lt;!&ndash;            </tr>&ndash;&gt;-->
<!--            </tbody>-->
        </table>

        <!-- Пагинация -->
<!--        <div class="table-footer">-->
<!--            <button @click="goToPreviousPage" :disabled="currentPage === 1"><Icon icon="ic:round-arrow-back" class="logo" />Назад</button>-->
<!--            <div class="pagination-numbers">-->
<!--                <button v-for="page in totalPagesArray" :key="page" :class="{ active: page === currentPage }" @click="goToPage(page)">-->
<!--                    {{ page }}-->
<!--                </button>-->
<!--            </div>-->
<!--            <button @click="goToNextPage" :disabled="currentPage === totalPages">Вперед<Icon icon="ic:round-arrow-forward" class="logo" /></button>-->
<!--        </div>-->
    </div>
</template>

<script>
import {UserService} from "../../services/UserService";
import Pagination from "../forms/Pagination.vue";
import TextInput from "../forms/TextInput.vue";
import _ from "lodash"
import Spinner from "../forms/Spinner.vue";
import Alert from "../forms/Alert.vue";
import { Icon } from '@iconify/vue';
import ButtonUI from "../UI/ButtonUI.vue";

export default {
    components: {Icon, Alert, Spinner, TextInput, Pagination, ButtonUI},
    props: {
        data: {
            type: Array,
            required: true,
        },
        columns: {
            type: Array,
            required: true,
        },
        rowsPerPageOptions: {
            type: Array,
            default: () => [10, 25, 50, 100],
        },
    },
    data: function () {
        return {
            users: [],
            role: '',
            loading: false,
            errorMessage: null,
            query: '',
            limit: 5,
            total: 1,
            searchQuery: "",
            rowsPerPage: 10,
            filteredData: this.data,
            selectedRows: [],
            selectAll: false,
            currentPage: 1,
            isFilterDropdownVisible: false, // Состояние видимости выпадающего окна
            nameSort: "asc", // Для сортировки названия
            ratingSort: "asc", // Для сортировки рейтинга
            checkboxOptions: [
                { id: 1, label: 'Опция 1', value: 'option1' },
                { id: 2, label: 'Опция 2', value: 'option2' },
                { id: 3, label: 'Опция 3', value: 'option3' },
                { id: 4, label: 'Опция 4', value: 'option4' },
                { id: 5, label: 'Опция 5', value: 'option5' },
                { id: 6, label: 'Опция 6', value: 'option6' },
                { id: 7, label: 'Опция 7', value: 'option7' },
                { id: 8, label: 'Опция 8', value: 'option8' },
            ],
            selectedOptions: [], // Для выбранных чекбоксов
        }
    },
    name: "UsersList",
    created:  function () {
        this.update(this.page)
    },
    methods: {
        update:  function () {
            this.loading = true
            UserService.currentUser().then(response => {
                this.role = response.data.role
            })
            UserService.getUsers(this.page, this.query)
                .then(response => {
                    console.log(response);
                this.users = response.data.users
                // this.limit = response.data.limit
                // this.total = response.data.total
            })
                .catch(error => this.errors = error.data.message || error)
                .finally(() => this.loading = false)
        },
        handleSearch() {
            this.filteredData = this.data.filter((row) =>
                this.columns.some((col) =>
                    String(row[col])
                        .toLowerCase()
                        .includes(this.searchQuery.toLowerCase())
                )
            );
            this.currentPage = 1; // сбрасываем на первую страницу после поиска
        },
        handleRowsChange() {
            this.currentPage = 1; // сбрасываем на первую страницу при изменении количества строк
        },
        toggleFilterDropdown() {
            this.isFilterDropdownVisible = !this.isFilterDropdownVisible; // Переключаем видимость выпадающего окна
            console.log('Toggle filter dropdown', this.isFilterDropdownVisible);
        },
        applyFilter() {
            // Логика для применения фильтров
            // Например, сортировка по названию и рейтингу
            this.filteredData = this.data.filter(row => {
                return this.selectedOptions.includes(row.option); // Предполагается, что есть поле "option" в данных
            });

            // Здесь можно добавить логику сортировки по nameSort и ratingSort

            this.isFilterDropdownVisible = false; // Закрываем выпадающее окно после применения фильтров
        },
        toggleSelectAll() {
            if (this.selectAll) {
                this.selectedRows = [...this.paginatedData];
            } else {
                this.selectedRows = [];
            }
        },
        goToPage(page) {
            this.currentPage = page;
        },
        goToPreviousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        goToNextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        toDetail: function(id) {
            this.$router.push({ path: '/users/' + id });
        },

        deleteUser: function(id) {
            if (confirm('Вы действительно хотите удалить пользователя?')) {
                UserService.delete(id)
                    .then(() => this.update(this.page))
                    .catch(error => this.errorMessage = error.response.data.error)
            }
        }
    },
    computed: {
        page() {
            return Number(this.$route.query.page) ?? 1;
        },
        totalPages() {
            return Math.ceil(this.filteredData.length / this.rowsPerPage);
        },
        totalPagesArray() {
            // Отображаем максимум 3 страницы
            const pages = [];
            for (let i = 1; i <= this.totalPages && i <= 3; i++) {
                pages.push(i);
            }
            return pages;
        },
        paginatedData() {
            const startIndex = (this.currentPage - 1) * this.rowsPerPage;
            return this.filteredData.slice(startIndex, startIndex + this.rowsPerPage);
        },
    },
    watch: {
        'query': _.debounce(function () {
            this.update()
        }, 500),
        // data: {
        //     handler(newData) {
        //         this.filteredData = newData;
        //     },
        //     deep: true,
        // },
    }
}
</script>
<style lang="scss" scoped>
.container {
    width: 100%;
    background-color: #fff;
    box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.03);
    border: 1px solid hsl(215, 50%, 95%);
    border-radius: 6px;
    overflow: hidden;

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #b1c2d9;
        padding: 0 1em;

        .form-control {
            border: none;
            width: 100%;
            outline: none;
            padding: 1.5em 1em 1.5em 0.5em;
            border-radius: 6px;
            &::placeholder {
                color: #b1c2d9;
            }
        }

        select {
            cursor: pointer;
            margin: 0 1em;
            padding: 0.5em;
            border: none;
            font-size: 12px;
            color: black;
            background-color: unset;
        }

        .bottom-icon {
            font-size: 18px;
            margin-right: 0;
        }

        .ico {
            font-size: 16px;
            margin-right: 0.4em;
        }
    }

    table {
        width: 100%;
        border-collapse: collapse;

        thead {
            background-color: #f9fbfd;
            color: #95aac9;
            text-transform: uppercase;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            border-top: 1px solid #edf2f9;

            .checkbox {
                text-align: center;
            }

            th {
                padding: 1em;
                border-bottom: 1px solid #edf2f9;
                vertical-align: middle; // Добавлено
                &:first-child {
                    width: 3%;
                }
            }
        }

        tbody {
            tr {
                transition: background-color 0.3s;

                &:hover {
                    background-color: #f1f3f5;
                }

                td {
                    padding: 0.75em;
                    border-top: 1px solid #edf2f9;
                    text-align: left;
                    vertical-align: middle; // Добавлено

                    &:first-child {
                        text-align: center;
                        width: 3%;
                    }

                    input[type="checkbox"] {
                        cursor: pointer;
                        height: 1rem;
                        width: 1rem;
                        margin: 0;
                    }
                }
            }
        }
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        // padding: 1em;
        background-color: #f9fbfd;
        border-top: 1px solid #edf2f9;

        button {
            display: flex;
            align-items: center;
            padding: 1.3em 3em;
            border: unset;
            border-left: 1px solid #edf2f9;
            border-right: 1px solid #edf2f9;
            background-color: #ffffff;
            color: #b1c2d9;
            cursor: pointer;
            transition: 0.3s;
            &:disabled {
                cursor: unset;
            }

            &:disabled:hover {
                color: #b1c2d9;
            }

            &:hover {
                transition: 0.3s;
                color: black;
            }

            .ico {
                width: 2em;
            }
        }

        .pagination-numbers {
            display: flex;
            gap: 0.5em;

            button {
                padding: 0.5em;
                background-color: #f9fbfd;
                border: none;
                color: #b1c2d9;
                cursor: pointer;

                &.active {
                    color: black;
                }

                &:hover {
                    color: black;
                }
            }
        }
    }
}
</style>
