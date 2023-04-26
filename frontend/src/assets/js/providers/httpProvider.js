import config from 'MainDir/config.js';

export default function ({app, store}) {

    const axios = require('axios').default;

    const http = {
        request: axios.create({
            baseURL: config.apiHost,
        }),

        setBearerToken(config = {}) {
            config.headers['Authorization'] = 'Bearer ' + localStorage.getItem('user_token');

            return config;
        },

        get(uri, params = {}) {
            if (params.length > 0) {
                uri = uri + '?' + new URLSearchParams(params).toString()
            }

            return this.request.get(uri, this.getDefaultHeaders())
        },

        post(uri, params = {}, config = {}) {
            if (config.headers && this.hasContentType(config.headers, 'multipart/form-data')) {
                config = this.getDefaultHeaders('multipart/form-data');
                params = this.makeFormData(params)
            }

            return this.request.post(uri, params, config)
        },

        put(uri, params = {}, config = {}) {
            if (config.headers && this.hasContentType(config.headers, 'multipart/form-data')) {
                config = this.getDefaultHeaders('multipart/form-data');
                params = this.makeFormData(params)
            }

            return this.request.put(uri, params, config)
        },

        delete(uri) {
            return this.request.delete(uri, this.getDefaultHeaders())
        },

        getDefaultHeaders(contentType = false) {
            return {
                headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': contentType ? contentType :'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('user_token')
                }
            }
        },

        makeFormData(params) {
            let formData = new FormData();

            for (const [key, value] of Object.entries(params)) {
                if (Array.isArray(value)) {
                    let index = 0;

                    value.forEach(item => {
                        formData.append(`${key}[${index}]`, item);
                        index++;
                    })
                } else {
                    formData.append(key, value)
                }
            }

            return formData;
        },
        
        hasContentType(headers, contentType) {
            return headers['Content-Type'] && headers['Content-Type'] == contentType
        }
    }

    app.config.globalProperties.$http = http;
}