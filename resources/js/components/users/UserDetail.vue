<template>
    <div>
        <Header title="Детальная информация о пользователе" />
        <hr>

<!--        <Table-->
<!--            :data="orders"-->
<!--            :columns="columns"-->
<!--            :rowsPerPageOptions="[5, 10, 25]"-->
<!--            :path="'/providers/order/detail/'"-->
<!--        />-->
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

export default {
    name: "UserDetail",
    components: {Table, Header, Textarea, DateInput, Select, Alert, TextOnly, Success, Checkbox},
    data: function () {
        return {
            id: this.$route.params.id,
            loading: false,
            errors: null,
            submitted: false,
            message: null
        }
    },
    mounted() {
        this.update();
    },
    methods: {
        update: async function (event) {
            UserService.getById(this.id)
                .then(response => this.provider = response.data.provider)
                .then(response => this.orders = response.data.provider)
                .catch(error => {
                    this.errors = error.response.data.message
                })
                .finally(() => this.loading = false)
        }
    }
}
</script>
