import axios from "axios";

export class OperationService {
    static serverUrl = import.meta.env.VITE_BASE_URL;
    static getOperations(){
        let url = `${this.serverUrl}/operations`;
        return axios.get(url);
    }

    static store(operation) {
        let url = `${this.serverUrl}/operations`;
        return axios.post(url, operation)
    }

    static update(operation) {
        let url = `${this.serverUrl}/operations/${operation.id}`;
        return axios.put(url, operation)
    }

    static getById(id) {
        let url = `${this.serverUrl}/operations/${id}`;
        return axios.get(url)
    }

    static getTypes() {
        let url = `${this.serverUrl}/operations/types`;
        return axios.get(url)
    }
}
