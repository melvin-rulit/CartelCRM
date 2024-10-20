<template>
    <div>
        <Header title="Детальная информация о поставщике">
            <template #errors>
                <div v-show="!orders.length">
                   Выполненных заказов нет
                </div>

            </template>
            <ButtonUI @click="back">Назад</ButtonUI>
        </Header>
        <hr>
        <div class="content-user">


            <div class="user-docs-address">

                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="passport_series">ФИО</label>
                            <input v-model="provider.full_name" id="passport_series" type="text" readonly
                                   @mousedown.prevent
                                   @copy.prevent
                                   @paste.prevent
                                   @selectstart.prevent/>
                        </div>
                        <div class="form-group">
                            <label for="passport_number">Город</label>
                            <input v-model="provider.city" id="passport_number" type="text" readonly
                                   @mousedown.prevent
                                   @copy.prevent
                                   @paste.prevent
                                   @selectstart.prevent/>
                        </div>
                        <div class="form-group">
                            <label for="passport_give">Телефон</label>
                            <input v-model="provider.phone" id="passport_give" type="text" readonly
                                   @mousedown.prevent
                                   @copy.prevent
                                   @paste.prevent
                                   @selectstart.prevent/>
                        </div>
                        <div class="form-group">
                            <label for="passport_issuedByDate">Логин в телеграм</label>
                            <input v-model="provider.telegram_login" id="passport_issuedByDate" type="text" readonly
                                   @mousedown.prevent
                                   @copy.prevent
                                   @paste.prevent
                                   @selectstart.prevent/>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <Table
            :data="orders"
            :columns="columns"
            :rowsPerPageOptions="[5, 10, 25]"
            :path="'/providers/order/detail/'"
        />
    </div>
</template>

<script>
import TextOnly from "../forms/TextOnly.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Select from "../forms/Select.vue";
import Checkbox from "../forms/Checkbox.vue";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import {ProvideService} from "../../services/ProvideService";
import Header from "../Header.vue";
import Table from "../forms/Table.vue";
import ButtonUI from "../UI/ButtonUI.vue";
import PageNav from "../UI/PageNav.vue";

export default {
    name: "ProviderDetail",
    components: {PageNav, ButtonUI, Table, Header, Textarea, DateInput, Select, Alert, TextOnly, Success, Checkbox},
    data: function () {
        return {
            id: this.$route.params.id,

            orders: [],
            provider: {
                'id': '',
                'full_name': '',
                'city': '',
                'phone': '',
                'telegram_login': '',
            },

            columns: [
                { label: 'Статус заказа', key: 'order_successful' },
                { label: 'Номер заказа', key: 'order_number' },
                { label: 'Дата заказа', key: 'order_date' },
                { label: 'Состав заказа', key: 'order_details' },
                { label: 'Сумма заказа', key: 'order_price' },
            ],
        }
    },
    mounted() {
        this.update();
    },
    methods: {
        update: async function (event) {
            ProvideService.getById(this.id)
                .then(response => this.provider = response.data.provider)
                .then(response => this.orders = response.data.provider.orders)
                .catch(error => {
                    this.errors = error.response.data.message
                })
                .finally(() => this.loading = false)

            ProvideService.getSuccessfulOrders(this.id)
                .then(response => this.orders = response.data.orders)
                .catch(error => {
                    this.errors = error.response.data.message
                })
                .finally(() => this.loading = false)

        },
        back() {
            this.$router.push({ path: '/providers' });
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
