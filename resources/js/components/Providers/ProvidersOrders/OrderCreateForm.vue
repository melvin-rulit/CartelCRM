<template>
    <Alert ref="alertComponent" :message="alertMessage" :type="alertType" />

    <div>
        <Header title="Создание заказа поставщику">
<!--            <Info message="Перед тем, как заполнить состав заказа - создайте сам заказ"></Info>-->
            <ButtonUI v-show="!showCreateProvider" @click="addProvider(true)">Добавить поставщика</ButtonUI>
            <ButtonUI @click="cancelCreation" color="red">Отмена</ButtonUI>
        </Header>
        <hr>
    </div>

    <div class="content-user">

        <PageNav :tabs="['Технические данные заказа', 'Состав заказа']">
            <template #tab-0>
                <div class="order-personal-info">

                    <form>
                        <div v-show="!showCreateProvider" class="form-row">
                            <div class="form-group">
                                <label for="order_number">Номер заказа</label>
                                <input v-model="order.order_number" id="order_number" type="text" readonly
                                       @mousedown.prevent
                                       @copy.prevent
                                       @paste.prevent
                                       @selectstart.prevent/>
                            </div>
                            <div class="form-group">
                                <label for="order_date ">Дата заказа</label>
                                <input v-model="order.order_date " id="order_date " type="text" readonly
                                       @mousedown.prevent
                                       @copy.prevent
                                       @paste.prevent
                                       @selectstart.prevent/>
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Статус заказа</label>
                                <select v-model="order.status" id="order_status" class="status-select">
                                    <option value="for_payment">К приемке</option>
                                    <option value="used"></option>
                                </select>
                                <span v-if="!order.status" class="error-message">Заполните поле</span>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Ответственный менеджер</label>
                                <select v-model="order.manager" @change="updateManager" class="manager-select">
                                    <!--                                                <option :value="managers" disabled>-->
                                    <!--                                                    {{ order.manager.full_name }}-->
                                    <!--                                                </option>-->
                                    <option
                                        v-for="manager in managers"
                                        :key="manager.id"
                                        :value="manager.id">
                                        {{ manager.full_name }}
                                    </option>
                                </select>
                                <span v-if="!order.manager" class="error-message">Заполните поле</span>
                            </div>
                            <div class="form-group">
                                <label for="birthday">Исходящие платежы по заказу</label>
                                <input v-model="order.birthday" id="birthday" type="text"/>
                            </div>
                        </div>

                        <div v-show="!showCreateProvider">
                            <h4>Прикрепить поставщика</h4>
                            <hr>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Список поставщиков</label>

                                    <select v-model="selectedProviderId" @change="updateProviderDetails"
                                            class="provider-select">
                                        <!--                            <option value="" disabled>Выберите поставщика</option>-->
                                        <option v-for="provider in providers" :key="provider.id" :value="provider.id">
                                            {{ provider.full_name }}
                                        </option>
                                    </select>
                                    <span v-if="!selectedProviderId" class="error-message">Заполните поле</span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Телефон поставщика</label>
                                    <input v-model="order.provider.phone" id="phone" type="text" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                                <div class="form-group">
                                    <label for="telegram">Логин в телеграм поставщика</label>
                                    <input v-model="order.provider.telegram" id="telegram" type="text" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                            </div>
                        </div>

<div v-show="showCreateProvider">
    <h3>Инициалы</h3>
    <hr>
    <form>
        <div class="form-row">
            <div class="form-group">
                <label for="first_name">Фамилия</label>
                <input v-model="provider.first_name" id="first_name" type="text" />
                <span v-if="!provider.first_name" class="error-message">{{ 'Заполните поле' }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">Имя</label>
                <input v-model="provider.middle_name" id="middle_name" type="text" />
                <span v-if="!provider.middle_name" class="error-message">{{ 'Заполните поле' }}</span>
            </div>
            <div class="form-group">
                <label for="last_name">Отчество</label>
                <input v-model="provider.last_name" id="last_name" type="text" />
                <span v-if="!provider.last_name" class="error-message">{{ 'Заполните поле' }}</span>
            </div>
        </div>

        <h3>Контактная информация</h3>
        <hr>
        <div class="form-row">
            <div class="form-group">
                <label for="city">Город</label>
                <input v-model="provider.city" id="city" type="text" />
                <span v-if="!provider.city" class="error-message">{{ 'Заполните поле' }}</span>
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона</label>
                <input v-model="provider.phone" id="phone" type="text" />
                <span v-if="!provider.phone" class="error-message">{{ 'Заполните поле' }}</span>
            </div>
            <div class="form-group">
                <label for="telegram">Логин телеграм</label>
                <input v-model="provider.telegram" id="telegram" type="text" />
                <span v-if="!provider.telegram" class="error-message">{{ 'Заполните поле' }}</span>
            </div>
        </div>

        <div v-show="showCreateProvider" class="buttons">
            <ButtonUI @click="addProvider(false)" color="red" class="if-create-provider" >Отмена</ButtonUI>
            <ButtonUI @click="storeProvider" :disabled=" !provider.first_name || !provider.middle_name || !provider.last_name || !provider.city || !provider.phone || !provider.telegram">Сохранить поставщика</ButtonUI>
        </div>
    </form>
</div>


<!--                        <h4>Информация о складских операциях</h4>-->
<!--                        <hr>-->

<!--                        <div class="form-row">-->

<!--                            <div class="form-group">-->
<!--                                <label for="new_password">Дата поступления на склад</label>-->
<!--                                <input v-model="order.password " id="new_password" type="text"/>-->

<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="confirm_password">Статус поступления на склад</label>-->
<!--                                <input v-model="order.password_see" id="confirm_password" type="text"/>-->
<!--                            </div>-->
<!--                        </div>-->

                        <div v-show="!showCreateProvider" class="buttons">
                            <ButtonUI @click="store" :disabled=" !selectedProviderId || !order.status || !order.manager" type="submit">Сохранить заказ</ButtonUI>
                        </div>
                    </form>
                </div>
            </template>

            <template #tab-1>
                <div class="order-sostav">

                    <h4>Добавить состав</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="brand">Бренд</label>
                            <input v-model="newOrderSostav.brand" id="brand" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="model">Модель</label>
                            <input v-model="newOrderSostav.model" id="model" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="state">Состояние</label>
                            <select v-model="newOrderSostav.state" id="order_status" class="state-select">
                                <option value="new">Новый</option>
                                <option value="used">Б/У</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="params_model">Параметры модели</label>
                            <input v-model="newOrderSostav.params_model" id="params_model" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="color">Цвет</label>
                            <input v-model="newOrderSostav.color" id="color" type="text"/>
                        </div>

                    </div>

                        <div class="form-row">
                        <div class="form-group">
                            <label for="city">Страна</label>
                            <input v-model="newOrderSostav.city" id="city" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="series_number">Серийный номер</label>
                            <input v-model="newOrderSostav.series_number" id="series_number" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="price_in">Цена вход (руб)</label>
                            <input v-model="newOrderSostav.prise" id="prise" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="price_out">Цена продажи (руб)</label>
                            <input v-model="newOrderSostav.prise_pay" id="prise_pay" type="text"/>
                        </div>
                    </div>

                    <div class="buttons">
                        <button @click.prevent="addOrderSostav">Добавить состав</button>
<!--                        <ButtonUI @click.prevent="addOrderSostav">Добавить состав</ButtonUI>-->
                    </div>

                    <h4>Список, который будет добавлен к заказу</h4>


                    <Table
                        :data="orderSostavs"
                        :columns="columns"
                        :rowsPerPageOptions="[5, 10, 25]"
                        :rowSelect=false
                    />
<!--                    <ul>-->
<!--                        <li v-for="(sostav, index) in orderSostavs" :key="index">-->
<!--                            {{ sostav.brand }} - {{ sostav.model }} ({{ sostav.state }})-->
<!--                            <ButtonUI @click="removeOrderSostav(index)">Удалить</ButtonUI>-->
<!--                        </li>-->
<!--                    </ul>-->
                </div>

            </template>

        </PageNav>
    </div>

</template>

<script>


import Header from "../../Header.vue";
import PageNav from "../../UI/PageNav.vue";
import ButtonUI from "../../UI/ButtonUI.vue";
import {ProvideService} from "../../../services/ProvideService";
import Table from "../../forms/Table.vue";
import {UserService} from "../../../services/UserService";
import Info from "../../forms/Info.vue";
import Alert from "../../forms/Alert.vue";

export default {
    name: "DealCreateForm",
    components: {Alert, Info, Table, ButtonUI, PageNav, Header},
    data: function () {
        const createdAt = new Date().toISOString().slice(0, 16)
        return {
            // loading: false,
            selectedProviderId: null,
            providers: [],
            managers: [],
            order: {

                manager: null,
                order_number: null,
                order_date: new Date().toISOString().split('T')[0],
                provider: {
                    id: '',
                    phone: '',
                    telegram: '',
                }
            },
            showCreateProvider: false,
            provider: {
                first_name: null,
                middle_name: null,
                last_name: null,
                city: null,
                phone: null,
                telegram: null
            },
            orderSostavs: [], // Массив для составов заказа
            newOrderSostav: {
                brand: '',
                model: '',
                state: '',
                params_model: '',
                color: '',
                city: '',
                series_number: '',
                prise: '',
                prise_pay: ''
            },
            columns: [
                { label: 'Бренд', key: 'brand' },
                { label: 'Модель', key: 'model' },
                { label: 'Состояние', key: 'state' },
                { label: 'Параметры модели', key: 'params_model' },
                { label: 'Цвет', key: 'color' },
                { label: 'Страна', key: 'city' },
                { label: 'Серийный номер', key: 'series_number' },
                { label: 'Цена вход', key: 'prise' },
                { label: 'Цена продажи', key: 'prise_pay' },
            ],

            alertMessage: '',
            alertType: 'success',
            submitted: false,
            errors: '',
            message: null,
        }
    },

    created: async function () {
        ProvideService.getUniqueOrderNumber()
            .then(response => this.order.order_number = response.data)
            .catch(error => this.errorMessage = error)

        ProvideService.getProvides()
            .then(response => this.providers = response.data.providers)
            .catch(error => this.errorMessage = error)

        UserService.getManagers()
            .then(response => this.managers = response.data.managers)
    },

    computed: {
        filteredManagers() {
            return this.managers.filter(manager => manager.id !== this.order.manager.id);
        }
    },

    methods: {
        updateManager() {
            const selectedManager = this.managers.find(manager => manager.id === this.order.manager.id);
            if (selectedManager) {
                this.order.manager.full_name = selectedManager.full_name; // Обновляем имя менеджера
            }
        },
        updateProviderDetails() {
            const selectedProvider = this.providers.find(provider => provider.id === this.selectedProviderId);
            if (selectedProvider) {
                this.order.provider.id = selectedProvider.id; // Подставляем id
                this.order.provider.phone = selectedProvider.phone; // Подставляем телефон
                this.order.provider.telegram = selectedProvider.telegram; // Подставляем логин в Telegram
            }
        },
        addOrderSostav() {
            this.orderSostavs.push({...this.newOrderSostav}); // Добавляем новый состав
            this.newOrderSostav = { // Сбрасываем поля ввода
                brand: '',
                model: '',
                state: '',
                params_model: '',
                color: '',
                country: '',
                series_number: '',
                price_in: '',
                price_out: ''
            };
        },
        triggerSuccessAlert(type) {
            if (type === 'provide'){
                this.alertMessage = 'Поставщик был успешно создан';
            }else if(type === 'order'){
                this.alertMessage = 'Заказ поставщику был успешно создан';
            }

            this.alertType = 'success';
            this.$refs.alertComponent.showAlert();
        },
        triggerErrorAlert() {
            this.alertMessage = 'Состав заказа не может быть пустым!';
            this.alertType = 'error';
            this.$refs.alertComponent.showAlert();
        },

        removeOrderSostav(index) {
            this.orderSostavs.splice(index, 1); // Удаляем состав по индексу
        },

        store: async function (event) {
            event.preventDefault()
            if (this.orderSostavs.length === 0) {
                this.triggerErrorAlert(); // Вызов функции для отображения сообщения
                return; // Прерываем выполнение метода
            }
            const orderData = {
                order: {
                    ...this.order,
                    orderSostavs: this.orderSostavs // Добавляем массив составов к заказу
                }
            };
            ProvideService.orderStore(orderData)
                .then(response => {
                    this.triggerSuccessAlert('order');
                })
                .catch(error => {
                    // this.errors = error.response.data.errors
                })
        },
        storeProvider: async function (event) {
            event.preventDefault()
            this.errors = null
            ProvideService.store(this.provider)
                .then(response => {
                    this.showCreateProvider = false
                    this.triggerSuccessAlert('provide');

                    ProvideService.getProvides()
                        .then(response => this.providers = response.data.providers)
                        .catch(error => this.errorMessage = error)
                })
                .catch(error => {
                    this.errors = error.response.data.errors.first_name
                })
        },

        addProvider(type) {
            if (type){
                this.showCreateProvider = true;
            }else {
                this.showCreateProvider = false;
            }

        },

        cancelCreation() {
            this.$router.push({name: 'ordersProviderList'})
        },
    },
}
</script>

<style lang="scss" scoped>
.content-user {
    max-width: 1400px;
    margin: auto;

    .user-settings {
        max-width: 600px;
        background-color: #ffffff;
        padding: 1.5em;
        margin: 1em auto 4em;
        border: 1px solid #e3ebf6;
        box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.1);
        border-radius: 12px;

        h2 {
            text-align: center;
            margin-bottom: 0.5em;
            color: #333;
        }

        .avatar {
            text-align: center;
            display: flex;
            justify-content: space-around;

            .user-role {
                font-size: 14px;
                color: #777;
                margin-bottom: 0.5em;
            }

            .avatar-image {
                width: 100px;
                height: 100px;
                border: 1px solid #e3ebf6;
                box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.1);
                border-radius: 50%;
                object-fit: cover;
                cursor: pointer;
            }

            .avatar-placeholder {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%;
                height: 100%;
                font-size: 30px; /* Размер значка «+» */
                color: #aaa; /* Цвет значка «+» */
            }
        }
    }

    .order-personal-info,
    .order-sostav {
        margin-top: 1.5em;

        h3 {
            margin-bottom: 1em;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
            margin-bottom: 20px;

            label {
                display: block;
                font-size: 13px;
                margin-bottom: 5px;
                font-weight: bold;
            }

            input {
                width: 100%;
                padding: 8px;
                font-size: 14px;
                border: 1px solid #e3ebf6;
                border-radius: 4px;
                box-sizing: border-box;
                transition: border-color 0.3s;
                outline: none;

                &:focus {
                    border-color: #569afa;
                }

                &::placeholder {
                    color: #b1c2d9;
                }
            }

            .status-select,
            .manager-select,
            .state-select {
                width: 250px;
                //width: 460px;
                padding: 0.5em;
                border: 1px solid #e3ebf6;
                border-radius: 5px;
                background-color: #fff;
                font-size: 14px;
                transition: border-color 0.3s;

                &:focus {
                    border-color: #569afa;
                }

                &:hover {
                    cursor: pointer;
                    border-color: #569afa;
                }

                option {
                    padding: 0.5em;
                }
            }

            .provider-select {
                width: 460px;
                padding: 0.5em;
                border: 1px solid #e3ebf6;
                border-radius: 5px;
                background-color: #fff;
                font-size: 14px;
                transition: border-color 0.3s;

                &:focus {
                    border-color: #569afa;
                }

                &:hover {
                    cursor: pointer;
                    border-color: #569afa;
                }

                option {
                    padding: 0.5em;
                }
            }

        }

        .form-group:last-child {
            margin-right: 0;
        }

        .buttons {
            display: flex;
            justify-content: end;
            margin-top: 2em;
        }
    }

    .user-settings-info {
        .role-select {
            max-width: 200px;
            margin-top: 0.5em;
            padding: 0.5em;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            font-size: 14px;
            background-color: #ffffff;
            color: #333;
            transition: border-color 0.3s, box-shadow 0.3s;

            // Стили для фокуса
            &:focus {
                border-color: #569afa;
                box-shadow: 0 0 5px rgba(86, 154, 250, 0.5);
                outline: none;
            }

            // Стили для выпадающего списка
            option {
                padding: 8px;
                background-color: #ffffff;
                color: #333;

                &:hover {
                    background-color: #f0f0f0; // Цвет фона при наведении
                }
            }
        }
    }
.if-create-provider {
    margin-right: 10px;
}
    .error-message {
        color: #ff4d4d;
        font-size: 0.75em;
    }
}
</style>
