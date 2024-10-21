<template>
    <div>
        <Header title="Детальная информация заказа поставщику">
            <ButtonUI @click="back">Назад</ButtonUI>
        </Header>
        <hr>
    </div>

    <div class="content-user">


    <div class="user-personal-info">
        <h3>Технические данные заказа</h3>
        <hr>
        <form>
            <div class="form-row">
                <div class="form-group">
                    <label for="order_number">Номер заказа</label>
                    <input v-model="order.order_number" id="order_number" type="text" />
                </div>
                <div class="form-group">
                    <label for="order_date">Дата заказа</label>
                    <input v-model="order.order_date" id="order_date" type="text" />
                </div>
                <div class="form-group">
                    <label for="status">Статус заказа</label>
                    <select v-model="order.status" id="status" class="role-select">
                        <option v-for="status in statuses" :key="status.id" :value="status.value">
                            {{ status.label }}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="full_name">Ответственный менеджер</label>

                    <select v-model="order.manager.id" @change="updateManager" class="role-select">
                        <option :value="order.manager.id" disabled>
                            {{ order.manager.full_name }}
                        </option>
                        <option
                            v-for="manager in filteredManagers"
                            :key="manager.id"
                            :value="manager.id">
                            {{ manager.full_name }}
                        </option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="birthday">Исходящие платежы по заказу</label>
                    <input v-model="order.birthday" id="birthday" type="text" />
                </div>
            </div>

            <h3>Данные поставщика</h3>
            <hr>
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">ФИО</label>
                    <input v-model="order.provider.full_name" id="full_name" type="text" />
                </div>
                <div class="form-group">
                    <label for="phone">Телефон поставщика</label>
                    <input v-model="order.provider.phone" id="phone" type="text" />
                </div>
                <div class="form-group">
                    <label for="telegram">Логин в телеграм поставщика</label>
                    <input v-model="order.provider.telegram" id="telegram" type="text" />
                </div>
            </div>

            <h3>Информация о складских операциях</h3>
            <hr>

            <div class="form-row">

                <div class="form-group">
                    <label for="order_date_in_store">Дата поступления на склад</label>
                    <input v-model="order.order_date_in_store" id="order_date_in_store" type="text" />

                </div>
                <div class="form-group">
                    <label for="confirm_password">Статус поступления на склад</label>
                    <input v-model="order.password_see" id="confirm_password" type="text" placeholder="Подтвердите пароль" />
                </div>
            </div>

            <h3>   Состав заказа</h3>
            <hr>

                <Table
                    :data="order.order_sostavs"
                    :columns="columns"
                    :rowsPerPageOptions="[5, 10, 25]"
                    :path="'/providers/detail/'"
                />
        </form>
    </div>

    </div>


</template>

<script>
import {ProvideService} from "../../../services/ProvideService";
import Header from "../../Header.vue";
import Table from "../../forms/Table.vue";
import ButtonUI from "../../UI/ButtonUI.vue";
import {UserService} from "../../../services/UserService";

export default {
    name: "OrderDetail",
    components: {Table, ButtonUI, Header},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,

            order: {
                manager:{
                    id: '',
                    full_name: '',
                }

            },
            managers: [],
            columns: [
                { label: 'Номер позиции', key: 'id' },
                { label: 'Бренд', key: 'brand' },
                { label: 'Модель', key: 'phone' },
                { label: 'Состояние', key: 'state' },
                { label: 'Параметры модели', key: 'params_model' },
                { label: 'Цвет', key: 'color' },
                { label: 'Страна', key: 'city' },
                { label: 'Серийный номер', key: 'series_number' },
                { label: 'Цена вход', key: 'prise' },
                { label: 'Цена продажи', key: 'prise_pay' },
            ],
            statuses: [
                {id: 1, label: 'К оплате', value: 'for_payment'},
                {id: 2, label: 'Выполнен', value: 'Выполнен'},
                // { id: 3, label: 'Неактивные' },
                // { id: 4, label: 'Ожидающие' },
            ],

        }
    },
    created: async function () {
            ProvideService.getOrderById(this.id)
                .then(response => this.order = response.data.order)
                .catch(error => this.errorMessage = error)
                .finally(() => this.loading = false)

            // UserService.getRoles().then(response => this.userRoles = response.data.roles)
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
        back() {
            this.$router.push({ path: '/providers/orders' });
        },
    }
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

    .user-personal-info,
    .user-docs-address,
    .user-settings-info {
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

            select {
                width: 250px;
                padding: 0.5em;
                //margin-left: 9px;
                border: 1px solid #e3ebf6;
                border-radius: 5px;
                background-color: #fff;
                font-size: 14px;
                transition: border-color 0.3s;

                &:focus {
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
            justify-content: center;
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
}
</style>
