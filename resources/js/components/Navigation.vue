<template>
<aside class="sidebar">
<a href="/" class="logo"><img src="images/logo/logo.svg" alt="logo"></a>
<nav>
    <ul>

        <li><router-link to="/dashboard"><Icon class="ico" icon="lucide:home" /> Панель управления</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/users"><Icon class="ico" icon="lucide:users" /> Пользователи</router-link></li>
        <li v-show="this.role === 'cashier' || this.role === 'admin' || this.role === 'manager'"><router-link to="/providers"><Icon class="ico" icon="lucide:truck" /> Поставщики</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/providers/orders"><Icon class="ico" icon="lucide:shopping-cart" /> Заказы поставщикам</router-link></li>
        <li v-show="this.role === 'cashier' || this.role === 'admin' || this.role === 'counterparties'"><router-link to="/counterparties"><Icon class="ico" icon="lucide:briefcase" /> Контрагенты</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/counterparties/orders"><Icon class="ico" icon="lucide:file-text" /> Заказы контрагентов</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager'"><router-link to="/store"><Icon class="ico" icon="lucide:package" /> Склады</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'manager' || this.role === 'courier'"><router-link to="/courier"><Icon class="ico" icon="streamline:give-gift" /> Курьеры</router-link></li>
        <li v-show="this.role === 'admin' || this.role === 'cashier'"><router-link to="/cashier"><Icon class="ico" icon="hugeicons:cashier" /> Кассир</router-link></li>
        <li v-show="this.role === 'admin'"><router-link to="/Investments"><Icon class="ico" icon="lucide:archive-restore" /> Инвестиции</router-link></li>
        <li v-show="this.role === 'admin'"><router-link to="/working"><Icon class="ico" icon="lucide:pie-chart" /> График работы</router-link></li>
    </ul>
</nav>
<div class="sidebar-bottom">
    <ButtonUI><Icon icon="jam:settings-alt" class="ico" /> Настройки</ButtonUI>
    <div class="bottom-icons">
        <Icon icon="mdi:bell-outline" class="bottom-icon" />
        <div class="avatar"></div>
        <Icon @click="logout" icon="ci:exit" class="bottom-icon" />
    </div>
</div>
</aside>

</template>
<script>
import { Icon } from '@iconify/vue';
import ButtonUI from "./UI/ButtonUI.vue";
import Footer from "./Footer.vue";
import {UserService} from "../services/UserService";

export default {
    name: "Navigation",
    components: {ButtonUI, Icon, Footer},
    data: function () {
        return {
            user: {
                name: 'loading',
                email: null,
                roleId: null
            },
            role: ''
        }
    },
    created: async function () {
        UserService.currentUser().then(response => {
            this.user = response.data.user
            this.role = response.data.role
        })
    },
    methods: {
        logout: function (event) {
            event.preventDefault()
            axios.post('/logout', {})
                .then(response => {
                    if (response.status === 200) {
                        document.location.href = '/login';
                    }
                })
                .catch(error => {
                    console.error('Logout error:', error);
                });
        },
    }
};
</script>

<style scoped lang="scss">
.sidebar {
    position: fixed;
    width: 250px;
    max-height: 100vh;
    background-color: #ffffff;
    color: #fff;
    padding: 0 20px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Добавлено для распределения пространства между элементами */
    border-right: 1px solid #e3ebf6;

    .ico {
        font-size: 18px;
        margin-right: 10px; /* Отступ между иконкой и текстом */
    }

    .logo {
        padding: 1rem 0;
        margin: 0 auto;

        img {
            width: 50px;
            height: 50px;
        }
    }

    nav {
        font-size: 1rem;
        line-height: 1.4rem;
        padding-bottom: .125em;

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 1em;

            li {
                margin-bottom: 15px;

                a {
                    display: flex;
                    align-items: center;
                    color: #6e84a3;
                    text-decoration: none;
                    font-size: 16px;
                    transition: color 0.3s ease;

                    &:hover {
                        color: #111;
                    }
                }

                .router-link-active {
                    color: #111;
                }
            }
        }
    }

    /* Стили для нижнего блока */
    .sidebar-bottom {
        margin-top: auto; /* Прижимает к низу */
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;

        /* Стили для нижнего ряда иконок */
        .bottom-icons {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            padding: 20px 0 10px;
            border-top: 1px solid #e3ebf6;;
            margin-top: 1.5em;

            .bottom-icon {
                font-size: 20px; /* Размер иконок */
                color: #6e84a3; /* Изменение цвета при наведении */
                cursor: pointer;

                &:hover {
                    color: #111; /* Изменение цвета при наведении */
                }
            }

            .avatar {
                width: 40px; /* Размер аватарки */
                height: 40px;
                border-radius: 50%; /* Круглая форма */
                background-color: #6e84a3; /* Цвет фона для аватарки */
            }
        }
    }
}
</style>
