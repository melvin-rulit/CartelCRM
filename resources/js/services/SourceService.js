import axios from "axios";

export class SourceService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getSources(){
        let url = `${this.serverUrl}/sources`;
        return axios.get(url);
    }

    static store(source) {
        let url = `${this.serverUrl}/sources`;
        return axios.post(url, source)
    }

    static update(source) {
        let url = `${this.serverUrl}/sources/${source.id}`;
        return axios.put(url, source)
    }

    static getById(id) {
        let url = `${this.serverUrl}/sources/${id}`;
        return axios.get(url)
    }
}
