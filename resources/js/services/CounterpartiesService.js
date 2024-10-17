import axios from "axios";

export class CounterpartiesService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getCounterparties(page, query){
        let url = `${this.serverUrl}/counterparties?page=` + page + `&query=` + query;
        return axios.get(url);
    }

    static getById(id) {
        let url = `${this.serverUrl}/counterparties/detail/${id}`;
        return axios.get(url)
    }

    static store(user) {
        let url = `${this.serverUrl}/counterparties`;
        return axios.post(url, user)
    }
    // static update(user) {
    //     let url = `${this.serverUrl}/users/${user.id}`;
    //     return axios.put(url, user)

    // }

    static delete(id) {
        let url = `${this.serverUrl}/counterparties/${id}`;
        return axios.delete(url, id)
    }

    static getOrders(page, query){
        let url = `${this.serverUrl}/counterparties/orders/`;
        return axios.get(url);
    }

    //
    // static currentUser()
    // {
    //     let url = `${this.serverUrl}/user`;
    //     return axios.get(url)
    // }
    //
    // static getRoles()
    // {
    //     let url = `${this.serverUrl}/roles`;
    //     return axios.get(url)
    // }
    //
    // static getManagersList()
    // {
    //     let url = `${this.serverUrl}/users/managers`;
    //     return axios.get(url)
    // }
    //
    // static getAdminsList()
    // {
    //     let url = `${this.serverUrl}/users/admins`;
    //     return axios.get(url)
    // }
    //
    // static getInvestorsList()
    // {
    //     let url = `${this.serverUrl}/users/investors`;
    //     return axios.get(url)
    // }
}
