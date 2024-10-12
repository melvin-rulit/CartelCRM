import axios from "axios";

export class StatsService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getPayments(filters) {
        let url = `${this.serverUrl}/stats/payments?dateFrom=` + filters.dateFrom + '&dateTo=' + filters.dateTo + '&branchName=' + filters.branchName + '&investorName=' + filters.investorName + '&activeName=' + filters.activeName + '&clientName=' + filters.clientName + '&incomes=' + filters.incomes + '&outgoings=' + filters.outgoings;
        return axios.get(url);
    }

    static getActives(filters) {
        let url = `${this.serverUrl}/stats/actives?branchName` + filters.branchName + '&investorName=' + filters.investorName + '&activeName=' + filters.activeName + '&clientName=' + filters.clientName;
        return axios.get(url);
    }

    static exportPayments(payments, operations) {
        let url = `${this.serverUrl}/stats/payments/export`;
        return axios.post(url, {payments: payments, operations: operations},{responseType: 'blob'});
    }

    static exportActives(ids) {
        let url = `${this.serverUrl}/stats/actives/export`;
        return axios.post(url, {ids: ids},{responseType: 'blob'});
    }
}
