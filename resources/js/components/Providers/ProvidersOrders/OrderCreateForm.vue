<template>
    <div>
        <Header title="Создание заказа поставщику">
            <ButtonUI @click="cancelCreation" color="red">Отмена</ButtonUI>
        </Header>
        <hr>
    </div>

    <div class="content-user">


        <div class="user-personal-info">
            <h4>Технические данные заказа</h4>
            <hr>
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="last_name">Номер заказа</label>
                        <input v-model="orders.last_name" id="last_name" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="first_name">Дата заказа</label>
                        <input v-model="orders.first_name" id="first_name" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Статус заказа</label>
                        <input v-model="orders.middle_name" id="middle_name" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="birthday">Ответственный менеджер</label>
                        <input v-model="orders.birthday" id="birthday" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="birthday">Исходящие платежы по заказу</label>
                        <input v-model="orders.birthday" id="birthday" type="text" />
                    </div>
                </div>

                <h4>Данные поставщика</h4>
                <hr>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Название контрагента</label>
                        <input v-model="orders.email" id="email" type="email" />
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Телефон контрагента</label>
                        <input v-model="orders.phone_number" id="phone_number" type="tel" placeholder="(___)___-____" />
                    </div>
                    <div class="form-group">
                        <label for="telegram">Логин в телеграм контрагента</label>
                        <input v-model="orders.telegram" id="telegram" type="text" />
                    </div>
                </div>

                <h4>Информация о складских операциях</h4>
                <hr>

                <div class="form-row">

                    <div class="form-group">
                        <label for="new_password">Дата поступления на склад</label>
                        <input v-model="orders.password " id="new_password" type="text" placeholder="Введите новый пароль" />

                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Статус поступления на склад</label>
                        <input v-model="orders.password_see" id="confirm_password" type="text" placeholder="Подтвердите пароль" />
                    </div>
                </div>

                <h4>   Состав заказа</h4>
                <hr>

            </form>
        </div>

    </div>


</template>

<script>


import Header from "../../Header.vue";
import PageNav from "../../UI/PageNav.vue";
import ButtonUI from "../../UI/ButtonUI.vue";
import {ProvideService} from "../../../services/ProvideService";
import Table from "../../forms/Table.vue";

export default {
  name: "DealCreateForm",
  components: {Table, ButtonUI, PageNav, Header},
  data: function () {
    const createdAt = new Date().toISOString().slice(0, 16)
    return {
      loading: false,

        orders: {
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

        submitted: false,
        errors: null,
        message: null,
    }
  },

  mounted() {

  },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            ProvideService.store(this.provider)
                .then(response => {
                    this.provider = response.data.provider
                    this.$router.push({name: 'providersList'})
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                })
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

    .user-personal-info{
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
        color: #ff4d4d;
        font-size: 0.75em;
    }
}
</style>
