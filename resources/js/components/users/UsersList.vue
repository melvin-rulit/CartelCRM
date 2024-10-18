<template>
    <div>
        <Header title="Пользователи">
            <ButtonUI @click="goToAdd">Добавить пользователя</ButtonUI>
        </Header>
        <hr>

        <Table
            :data="users"
            :columns="columns"
            :rowsPerPageOptions="[5, 10, 25]"
            :path="'/users/detail/'"
        />
    </div>
</template>

<script>
import {UserService} from "../../services/UserService";
import Table from '../forms/Table.vue';
import Header from "../Header.vue";
import ButtonUI from "../UI/ButtonUI.vue";

export default {
    components: {
        ButtonUI,
        Header,
        Table,
    },
    data() {
        return {
            users: [],
            role: '',
            loading: false,
            errorMessage: null,

            // Названия колонок
            columns: [
                { label: 'ФИО', key: 'full_name' },
                { label: 'Дата рождения', key: 'birthday' },
                { label: 'Email-адрес', key: 'email' },
            ],
        };
    },
    mounted() {
        this.update();
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

        goToAdd() {
            this.$router.push({ path: '/users/create'});
        },
    }
};
</script>
