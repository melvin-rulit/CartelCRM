<template>
    <div>
        <Header title="Создание контрагента">
            <ButtonUI color="red" @click="cancelCreation">Отмена</ButtonUI>
        </Header>
        <hr>

    </div>

    <div class="content-user">


        <PageNav :tabs="['Личные данные']">
            <template #tab-0>
                <div class="user-personal-info">
                    <h3>Инициалы</h3>
                    <hr>
                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">Фамилия</label>
                                <input v-model="counterpart.first_name" id="first_name" type="text" />
                                <span v-if="errors" class="error-message">{{ errors.first_name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Имя</label>
                                <input v-model="counterpart.middle_name" id="middle_name" type="text" />
                                <span v-if="errors" class="error-message">{{ errors.middle_name[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Отчество</label>
                                <input v-model="counterpart.last_name" id="last_name" type="text" />
                                <span v-if="errors" class="error-message">{{ errors.last_name[0] }}</span>
                            </div>
                        </div>

                        <h3>Контактная информация</h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">Город</label>
                                <input v-model="counterpart.city" id="city" type="text" />
                                <span v-if="errors" class="error-message">{{ errors.city[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Номер телефона</label>
                                <input v-model="counterpart.phone" id="phone" type="text" />
                                <span v-if="errors" class="error-message">{{ errors.phone[0] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="telegram_login">Логин телеграм</label>
                                <input v-model="counterpart.telegram_login" id="phone" type="text" />
                                <span v-if="errors" class="error-message">{{ errors.telegram_login[0] }}</span>
                            </div>
                        </div>

                        <div class="buttons">
                            <ButtonUI @click="store" type="submit">Сохранить</ButtonUI>
                        </div>
                    </form>
                </div>
            </template>


        </PageNav>
    </div>
</template>

<script>
import {CounterpartiesService} from "../../services/CounterpartiesService";
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Select from "../forms/Select.vue";
import Success from "../forms/Success.vue";
import Checkbox from "../forms/Checkbox.vue";
import DateInput from "../forms/DateInput.vue";
import Textarea from "../forms/Textarea.vue";
import Header from "../Header.vue";
import ButtonUI from "../UI/ButtonUI.vue";
import PageNav from "../UI/PageNav.vue";

export default {
    name: "UserCreateForm",
    components: {PageNav, ButtonUI, Header, DateInput, Checkbox, Select, Alert, TextInput, Success, Textarea},
    data: function () {
        return {
            loading: false,
            userRoles: [],
            counterpart: {
                'firstName': '',
                'middleName': '',
                'lastName': '',
                'city': '',
                'phone': '',
                'telegram_login': '',
            },
            errors: null,
            message: null
        }
    },
    created: async function () {
        // UserService.getRoles().then(response => this.userRoles = response.data.roles)
    },
    methods: {
        store: async function (event) {
            event.preventDefault()
            this.errors = null
            CounterpartiesService.store(this.counterpart)
                .then(response => {
                    // this.counterparties = response.data.counterparties
                    this.$router.push({name: 'listCounterparties'})
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                })
            return true;
        },
        cancelCreation() {
            this.$router.push({ path: '/counterparties'});
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
