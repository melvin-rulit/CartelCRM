<template>
    <div>
        <Header title="Детальная информация о контрагенте">
            <template #errors>
                <div v-show="!orders.length">
                    Выполненных заказов нет
                </div>

            </template>
            <ButtonUI color="green" @click="edit">Редактировать</ButtonUI>
            <ButtonUI @click="back">Назад</ButtonUI>
        </Header>
        <hr>
        <div class="content-user">


            <div class="user-docs-address">

                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">ФИО</label>
                            <input v-model="counterpart.full_name" id="full_name" type="text" readonly
                                   @mousedown.prevent
                                   @copy.prevent
                                   @paste.prevent
                                   @selectstart.prevent/>
                        </div>
                        <div class="form-group">
                            <label for="city">Город</label>
                            <input v-model="counterpart.city" id="city" type="text" readonly
                                   @mousedown.prevent
                                   @copy.prevent
                                   @paste.prevent
                                   @selectstart.prevent/>
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input v-model="counterpart.phone" id="phone" type="text" readonly
                                   @mousedown.prevent
                                   @copy.prevent
                                   @paste.prevent
                                   @selectstart.prevent/>
                        </div>
                        <div class="form-group">
                            <label for="telegram">Логин в телеграм</label>
                            <input v-model="counterpart.telegram" id="telegram" type="text" readonly
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
import {CounterpartiesService} from "../../services/CounterpartiesService";
import Header from "../Header.vue";
import ButtonUI from "../UI/ButtonUI.vue";
import Table from "../forms/Table.vue";

export default {
    name: "CounterpartiesDetail",
    components: {Table, ButtonUI, Header},
    data: function () {
        return {
            id: this.$route.params.id,
            orders: [],
            counterpart: {
                'id': '',
                'full_name': '',
                'city': '',
                'phone': '',
                'telegram': '',
            },

            columns: [
                { label: 'Статус заказа', key: 'status' },
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
            CounterpartiesService.getById(this.id)
                .then(response => this.counterpart = response.data.counterpart)
                .then(response => this.orders = response.data.provider.orders)
                .catch(error => {
                    this.errors = error.response.data.message
                })
                .finally(() => this.loading = false)

            CounterpartiesService.getOrdersForCounterpart(this.id)
                .then(response => this.orders = response.data.orders)
                .catch(error => {
                    this.errors = error.response.data.message
                })
                .finally(() => this.loading = false)
        },
        back() {
            this.$router.push({ path: '/counterparties' });
        },
        edit() {
            this.$router.push({ path: '/counterparties/' + this.id });
        },
    }
}
</script>

<style lang="scss" scoped>
.content-user {
    max-width: 1400px;
    margin: auto;
    user-select: none;

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
    .error-message {
        color: #ff4d4d; /* Красный цвет текста */
        //background-color: #ffe6e6; /* Светло-красный фон */
        //border: 1px solid #ff4d4d; /* Красная граница */
        //padding: 10px; /* Отступы вокруг текста */
        //border-radius: 5px; /* Закругленные углы */
        padding-top: 15px; /* Отступ сверху */
    }
    .error-role {
        color: #ff4d4d; /* Красный цвет текста */
        margin-left: 10px;
    }
}
</style>
