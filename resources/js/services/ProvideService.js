import axios from "axios";

export class ProvideService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getProvides(){
        let url = `${this.serverUrl}/providers`;
        return axios.get(url);
    }
    static getById(id) {
        let url = `${this.serverUrl}/providers/detail/${id}`;
        return axios.get(url)
    }

    static getOrders(page, query){
        let url = `${this.serverUrl}/providers/orders/?page=` + page + `&query=` + query;
        return axios.get(url);
    }
    static getSuccessfulOrders(provider_id){
        let url = `${this.serverUrl}/providers/successful_orders/${provider_id}`;
        return axios.get(url);
    }
    static getOrderById(id){
        let url = `${this.serverUrl}/providers/order/detail/${id}`;
        return axios.get(url);
    }

    static orderStore(order) {
        let url = `${this.serverUrl}/providers/order`;
        return axios.post(url, order)
    }

    static changeStatus(order) {
        let url = `${this.serverUrl}/api/providers/orders/${order}`;
        return axios.put(url, order)
    }

    static store(proxy) {
        let url = `${this.serverUrl}/providers`;
        return axios.post(url, proxy)
    }

    //
    // static update(proxy) {
    //     let url = `${this.serverUrl}/proxies/${proxy.id}`;
    //     return axios.put(url, proxy)
    // }
    //

    //
    // static delete(id) {
    //     let url = `${this.serverUrl}/proxies/${id}`;
    //     return axios.delete(url)
    // }

    static getUniqueOrderNumber(){
        let url = `${this.serverUrl}/providers/get_unique_order_number`;
        return axios.get(url);
    }
}
