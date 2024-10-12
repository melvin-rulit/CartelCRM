<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование клиента</h3>
            <Alert :errors="errors"/>
            <Success :message="message"/>
            <form @submit="update">
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Фамилия клиента" name="lastName" v-model:value="client.lastName" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Имя клиента" name="firstName" v-model:value="client.firstName" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Отчество клиента" name="middleName" v-model:value="client.middleName"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Номер телефона" name="phoneNumber" v-model:value="client.phoneNumber"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <DateInput title="Дата рождения" name="birthday" v-model:value="client.birthday" type="date"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Серия паспорта" name="passportSeries" v-model:value="client.passportSeries" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Номер паспорта" name="passportNumber" v-model:value="client.passportNumber" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Паспорт выдан" name="passportNotes" v-model:value="client.passportNotes"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Вид на жительство" v-model:value="client.residentCard"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Персональный номер" v-model:value="client.personnelNumber"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Адрес прописки" name="registrationAddress"
                               v-model:value="client.registrationAddress"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Адрес фактического проживания" name="residenceAddress"
                               v-model:value="client.residenceAddress"
                               type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Email" name="email" v-model:value="client.email"
                               type="email"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Textarea title="Комментарий" name="comment" v-model:value="client.comment"/>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/clients" type="button"
                                 class="text-sm font-semibold leading-6 text-gray-900">Отмена
                    </router-link>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Сохранить
                    </button>
                </div>
            </form>
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white mt-10">Документы</h3>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Загрузить
                файл</label>
            <input @change="uploadFile"
                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                   aria-describedby="file_input_help" id="file_input" type="file">
            <div class="flex flex-row flex-wrap mt-5">
                <div v-for="file in files" :key="file.id"
                     class="max-w-[256px] max-h-[396px] bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mr-2 mb-2">
                    <img class="rounded-t-lg max-w-[256px] max-h-[256px] m-auto" :src="file.path" :alt="file.filename"
                         :title="file.filename"/>
                    <div class="p-3 overflow-hidden">
                        <div class="mb-1 font-normal text-gray-700 dark:text-gray-400">Размер: {{ file.filesize }} Мб
                        </div>
                        <div class="mb-1 font-normal text-gray-700 dark:text-gray-400">Сохранен: {{
                                file.createdAt
                            }}
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="grid justify-items-start">
                                <svg @click="download(file.path, file.filename)"
                                     class="cursor-pointer w-6 h-6 text-gray-700 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 19">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M15 15h.01M4 12H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-3M9.5 1v10.93m4-3.93-4 4-4-4"/>
                                </svg>
                            </div>
                            <div class="grid justify-items-end">
                                <svg @click="removeFile(client.id, file.id)"
                                     class="cursor-pointer w-6 h-6 text-gray-700 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ClientService} from "../../services/ClientService";
import TextInput from "../forms/TextInput.vue";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import Select from "../forms/Select.vue";
import Textarea from "../forms/Textarea.vue";
import NumberInput from "../forms/NumberInput.vue";
import DateInput from "../forms/DateInput.vue";
import fileDownload from "js-file-download";

export default {
    name: "ClientEditForm",
    components: {NumberInput, Textarea, Select, Alert, TextInput, Success, DateInput},
    data: function () {
        return {
            loading: true,
            id: this.$route.params.id,
            client: {
                'firstName': '',
                'middleName': '',
                'lastName': '',
                'birthday': '',
                'passportSeries': '',
                'passportNumber': '',
                'passportNotes': '',
                'registrationAddress': '',
                'residenceAddress': '',
                'phoneNumber': '',
                'email': '',
                'comment': null,
                'residentCard': '',
                'personnelNumber': '',
            },
            files: [],
            errors: null,
            isHidden: true,
            message: null
        }
    },
    created() {
        ClientService.getById(this.id)
            .then(response => {
                this.client = response.data.client
                this.files = response.data.files
            })
            .catch(function (error) {
                self.errors = error.response.data.message
            })
            .finally(() => this.loading = false)
    },
    methods: {
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            ClientService.update(this.client)
                .then(response => {
                    this.client = response.data.client
                    this.files = response.data.files
                    this.message = 'Изменения сохранены'
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        uploadFile: async function (event) {
            ClientService.upload(event.target.files[0], this.client.id)
                .then(response => {
                    this.files.push(response.data.file)
                })
                .catch(error => this.errors = error)
                .finally()
        },
        download: function (path, filename) {
            ClientService.download(path)
                .then(response => {
                    fileDownload(response.data, filename)
                })
                .catch(error => this.errors = error)
        },
        removeFile: function (clientId, fileId) {
            ClientService.deleteFile(clientId, fileId)
                .then(response => this.files = response.data.files)
                .catch(error => this.errors = error)
        }
    }
}
</script>
