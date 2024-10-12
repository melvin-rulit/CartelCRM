import axios from "axios";

export class PaymentService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getPayments(dealId){
        let url = `${this.serverUrl}/payments/${dealId}`;
        return axios.get(url);
    }

    static store(payment, dealId) {
        payment.dealId = dealId
        let url = `${this.serverUrl}/payments`;
        return axios.post(url, payment)
    }

    static update(payment) {
        let url = `${this.serverUrl}/payments/${payment.id}`;
        return axios.put(url, payment)
    }

    static delete(paymentId) {
        let url = `${this.serverUrl}/payments/${paymentId}`;
        return axios.delete(url, paymentId)
    }

    static getTypes() {
        let url = `${this.serverUrl}/payments/types`;
        return axios.get(url)
    }
}
