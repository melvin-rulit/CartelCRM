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

    static orderStore(order) {
        let url = `${this.serverUrl}/counterparties/order`;
        return axios.post(url, order)
    }

    static store(user) {
        let url = `${this.serverUrl}/counterparties`;
        return axios.post(url, user)
    }

    static update(counterpart) {
        let url = `${this.serverUrl}/counterparties/${counterpart}`;
        return axios.put(url, counterpart)
    }

    static delete(id) {
        let url = `${this.serverUrl}/counterparties/${id}`;
        return axios.delete(url, id)
    }

    static getOrders(query){
        let url = `${this.serverUrl}/counterparties/orders?query=` + query;
        return axios.get(url);
    }
    static getOrdersForCounterpart(id){
        let url = `${this.serverUrl}/counterparties/counterpart_orders/${id}`;
        return axios.get(url);
    }
    static getOrderById(id){
        let url = `${this.serverUrl}/counterparties/order/detail/${id}`;
        return axios.get(url);
    }
    static getUniqueOrderNumber(){
        let url = `${this.serverUrl}/counterparties/get_unique_order_number`;
        return axios.get(url);
    }
}
