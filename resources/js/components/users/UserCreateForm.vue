<template>
    <div>
        <Header title="Создание пользователя">
            <template #errors>
                <div v-if="!user.email || !user.password || !user.role">
             При создании пользователя обязательно укажите email, пароль и роль
                </div>
            </template>

            <ButtonUI color="red" @click="cancelCreation">Отмена</ButtonUI>
        </Header>
        <hr>

    </div>

    <div class="content-user">

        <div class="user-settings">
            <div class="avatar" @click="triggerAvatarUpload">
                <img :src="avatar || defaultAvatar" alt="фото" class="avatar-image" />
<!--                <img v-if="avatar" :src="avatar" alt="фото" class="avatar-image" />-->
<!--                <div v-else class="avatar-placeholder">-->
<!--                    <span class="plus-sign">+</span>-->
<!--                </div>-->
                <input type="file" ref="avatarInput" @change="onAvatarChange" style="display: none;" />
                <div>
                    <h2>{{ fullName }}</h2>
                    <p class="user-role">{{ user.role || 'Роль не указана' }}</p>
                </div>
            </div>
        </div>

        <PageNav :tabs="['Личные данные', 'Документы и адрес']">
            <template #tab-0>
                <div class="user-personal-info">
                    <h3>Личные данные</h3>
                    <hr>
                    <form>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="last_name">Фамилия</label>
                                <input v-model="user.last_name" id="last_name" type="text" />
                            </div>
                            <div class="form-group">
                                <label for="first_name">Имя</label>
                                <input v-model="user.first_name" id="first_name" type="text" />
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Отчество</label>
                                <input v-model="user.middle_name" id="middle_name" type="text" />
                            </div>
                                                        <div class="form-group">
                                                            <label for="birthday">Дата рождения</label>
                                                            <input v-model="user.birthday" id="birthday" type="date" />
                                                        </div>
                        </div>

                        <h3>Контактная информация</h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input v-model="user.email" id="email" type="email" />
                                <span v-if="errorEmail" class="error-message">{{ errorEmail }}</span>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Номер телефона</label>
                                <input v-model="user.phone_number" id="phone_number" type="tel" placeholder="(___)___-____" />
                            </div>
                            <div class="form-group">
                                <label for="telegram">Telegram</label>
                                <input v-model="user.telegram" id="telegram" type="text" />
                            </div>
                        </div>

                        <h3>Вход для пользователя</h3>
                        <hr>

                        <div class="form-row">

                            <div class="form-group">
                                <select v-model="user.role" id="role" class="role-select">
                                    <option v-for="role in roles" :key="role.id" :value="role.id">{{  roleTranslations[role.name] }}</option>
                                </select>
                                <span v-if="!user.role" class="error-role">{{ "Укажите роль" }}</span>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Новый пароль</label>
                                <input v-model="user.password " id="new_password" type="text" placeholder="Введите новый пароль" />
                                <span v-if="errorPssword" class="error-message">{{ errorPssword }}</span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Подтвердите пароль</label>
                                <input v-model="user.password_see" id="confirm_password" type="text" placeholder="Подтвердите пароль" />
                            </div>
                        </div>

                        <div class="buttons">
                            <ButtonUI @click="store" type="submit">Сохранить</ButtonUI>
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
                                <input v-model="user.passport_series" id="passport_series" type="text" />
                            </div>
                            <div class="form-group">
                                <label for="passport_number">Номер паспорта</label>
                                <input v-model="user.passport_number" id="passport_number" type="text" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="passport_give">Кем выдан паспорт</label>
                                <input v-model="user.passport_give" id="passport_give" type="text" />
                            </div>
                            <div class="form-group">
                                <label for="passport_issuedByDate">Дата выдачи паспорта</label>
                                <input v-model="user.passport_issuedByDate" id="passport_issuedByDate" type="date" />
                            </div>
                        </div>

                        <h3>Адрес пользователя</h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="registration_address">Адрес регистрации</label>
                                <input v-model="user.registration_address" id="registration_address" type="text" />
                            </div>

                            <div class="form-group">
                                <label for="live_address">Адрес проживания</label>
                                <input v-model="user.live_address" id="live_address" type="text" />
                            </div>
                        </div>

                        <div class="buttons">
                            <ButtonUI type="submit">Сохранить</ButtonUI>
                        </div>
                    </form>
                </div>
            </template>

        </PageNav>
    </div>
</template>

<script>
import ButtonUI from "../UI/ButtonUI.vue";
import PageNav from '../UI/PageNav.vue';
import {UserService} from "../../services/UserService";
import Header from "../Header.vue";
import Alert from "../forms/Alert.vue";

export default {
    components: {
        Alert,
        Header,
        ButtonUI,
        PageNav,
    },
    data() {
        return {
            avatar: null,
            defaultAvatar: 'path/to/default/avatar.jpg',
            user: {
                first_name: '',
                middle_name: '',
                last_name: '',
                birthday: '',
                email: '',
                phone_number: '',
                telegram: '',
                passport_series: '',
                passport_number: '',
                passport_give: '',
                passport_issuedByDate: '',
                registration_address: '',
                live_address: '',
                role: '',
                password : '',
                password_see: '',
            },

            roles: [],
            roleTranslations: {
                'admin': 'Администратор',
                'cashier': 'Кассир',
                'courier': 'Курьер',
                'manager': 'Менеджер',
                'guest': 'Гость',
            },
            errorEmail: '',
            errorPssword: '',
            isSaving: false,
        };
    },
    created: async function () {
        UserService.getRoles().then(response => {
            this.roles = response.data.roles
        })
        try {
            const response = await UserService.getRoles();
            this.roles = response.data.roles.map(role => this.roleTranslations[role] || role);
        } catch (error) {
            console.error('Ошибка при получении ролей:', error);
        }
    },
    computed: {
        fullName() {
            return `${this.user.last_name || 'Фамилия'} ${this.user.first_name || 'Имя'} ${this.user.middle_name || 'Отчество'}`;
        }
    },
    methods: {
        onAvatarChange(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.avatar = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        triggerAvatarUpload() {
            this.$refs.avatarInput.click();
        },

        // submitSettings() {
        //     if (this.password !== this.password_see) {
        //         alert("Пароли не совпадают!");
        //         return;
        //     }
        //     console.log('Настройки сохранены:', { role: this.user.role, password: this.newPassword });
        //     // Логика для отправки настроек и нового пароля на сервер
        // },
        store: async function () {
            this.errorPssword = ''
            this.errorEmail = ''
            UserService.store(this.user)
                .then(response => {
                    this.user = response.data.user
                    this.$router.push({name: 'listUsers'})
                })
                .catch(error => {
                    this.errorEmail = error.response.data.errors.email[0]
                    this.errorPssword = error.response.data.errors.password[0]
                })
        },
        cancelCreation() {
            this.$router.push({name: 'listUsers'})
        },
    },
};
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
    .error-role {
        color: #ff4d4d; /* Красный цвет текста */
        margin-left: 10px;
        font-size: 0.75em;
    }
}
</style>
