import Axios from 'axios';

export default {
    createClientWithToken
};

/* function configureRequestCSRFInterceptor(httpClient, token) {
    httpClient.interceptors.request.use((config) => {
        config.headers['X-CSRF-TOKEN'] = token;

        return config;
    }, Promise.reject);
} */

function createClientWithToken() {
    const httpClient = Axios.create({
        baseURL: 'http://shopware-labs.local/api'
    });

    // configureRequestCSRFInterceptor(httpClient, token);

    return httpClient;
}