<template>
    <div>
        <Header title="Детальная информация о пользователе">
            <ButtonUI color="green" @click="edit">Редактировать</ButtonUI>
            <ButtonUI @click="back">Назад</ButtonUI>
        </Header>
        <hr>

        <div class="content-user">

            <div class="user-settings">
                <div class="avatar" >
                    <img :src="avatar || defaultAvatar" alt="фото" class="avatar-image" />
                    <!--                <img v-if="avatar" :src="avatar" alt="фото" class="avatar-image" />-->
                    <!--                <div v-else class="avatar-placeholder">-->
                    <!--                    <span class="plus-sign">+</span>-->
                    <!--                </div>-->
                    <input type="file" ref="avatarInput" style="display: none;" />
                    <div>
                        <h2>{{ user.full_name }}</h2>
                        <p class="user-role">{{ user.role }}</p>

                    </div>
                </div>
            </div>
            {{ role }}
            <PageNav :tabs="['Личные данные', 'Документы и адрес']">
                <template #tab-0>
                    <div class="user-personal-info">
                        <h3>Личные данные</h3>
                        <hr>
                        <form>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="last_name">Фамилия</label>
                                    <input v-model="user.last_name" id="last_name" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">Имя</label>
                                    <input v-model="user.first_name" id="first_name" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                                <div class="form-group">
                                    <label for="middle_name">Отчество</label>
                                    <input v-model="user.middle_name" id="middle_name" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Дата рождения</label>
                                    <input v-model="user.birthday" id="birthday" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                            </div>

                            <h3>Контактная информация</h3>
                            <hr>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="user.email" id="email" type="email" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Номер телефона</label>
                                    <input v-model="user.phone_number" id="phone_number" type="tel"
                                           placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                                <div class="form-group">
                                    <label for="telegram">Telegram</label>
                                    <input v-model="user.telegram" id="telegram" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                            </div>

                            <h3>Вход для пользователя</h3>
                            <hr>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="new_password">Установленный пароль</label>
                                    <input v-model="user.password_see " id="new_password" type="text"
                                           placeholder="Не заданно"/>
                                </div>
                            </div>

                        </form>
                    </div>
                </template>

                <template #tab-1>
                    <div class="user-docs-address">
                        <h3>Паспортные данные</h3>
                        <hr>
                        <form @click="store">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="passport_series">Серия паспорта</label>
                                    <input v-model="user.passport_series" id="passport_series" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent>
                                </div>
                                <div class="form-group">
                                    <label for="passport_number">Номер паспорта</label>
                                    <input v-model="user.passport_number" id="passport_number" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="passport_give">Кем выдан паспорт</label>
                                    <input v-model="user.passport_give" id="passport_give" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                                <div class="form-group">
                                    <label for="passport_issuedByDate">Дата выдачи паспорта</label>
                                    <input v-model="user.passport_issuedByDate" id="passport_issuedByDate" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                            </div>

                            <h3>Адрес пользователя</h3>
                            <hr>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="registration_address">Адрес регистрации</label>
                                    <input v-model="user.registration_address" id="registration_address" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>

                                <div class="form-group">
                                    <label for="live_address">Адрес проживания</label>
                                    <input v-model="user.live_adress" id="live_address" type="text" placeholder="Не заданно" readonly
                                           @mousedown.prevent
                                           @copy.prevent
                                           @paste.prevent
                                           @selectstart.prevent/>
                                </div>
                            </div>

<!--                            <div class="buttons">-->
<!--                                <ButtonUI type="submit">Сохранить</ButtonUI>-->
<!--                            </div>-->
                        </form>
                    </div>
                </template>

            </PageNav>
        </div>
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
import {UserService} from "../../services/UserService";
import PageNav from "../UI/PageNav.vue";
import ButtonUI from "../UI/ButtonUI.vue";

export default {
    name: "UserDetail",
    components: {ButtonUI, PageNav, Table, Header, Textarea, DateInput, Select, Alert, TextOnly, Success, Checkbox},
    data: function () {
        return {
            id: this.$route.params.id,
            user: '',
            // role: '',

            loading: false,
            message: null,
            errors: null
        }
    },
    mounted() {
        this.update();
    },
    methods: {
        update: async function (event) {
            UserService.getById(this.id)
                .then(response => this.user = response.data.user)
                // .then(response => this.role = response.data.role)
                .catch(error => {
                    this.errors = error.response.data.message
                })
                .finally(() => this.loading = false)
        },
        back() {
            this.$router.push({ path: '/users' });
        },
        edit() {
            this.$router.push({ path: '/users/' + this.id });
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
