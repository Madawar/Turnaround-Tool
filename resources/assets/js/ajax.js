export default {
    mounted() {
        var vm = this;

        this.rq.interceptors.request.use(function (config) {
            // Do something before request is sent
            vm.errorItems = [];
            vm.loading = true;
            vm.error = false;
            vm.$emit("error", "");
            return config;
        }, function (error) {
            vm.error = true;
            vm.$emit('error', error.response.data.errors);
            vm.errorItems = error.response.data.errors;
            vm.errorMessage = error;
            console.log(error);
            // Do something with request error
            return Promise.reject(error);
        });
        this.rq.interceptors.response.use(function (response) {
            // Do something with response data
            vm.loading = false;
            vm.error = false;
            vm.$emit("error", "");
            return response;
        }, function (error) {
            vm.loading = false;
            vm.error = true;
            vm.$emit('error', error.response.data.errors);
            vm.errorItems = error.response.data.errors;
            vm.errorMessage = error;
            // Do something with response error
            return Promise.reject(error);
        });
    },
    data: function () {
        return {
            objId: null,
            'rq': axios.create(),
            loading: false,
            errorMessage: '',
            error: false,
            errorItems:[]
        }
    },
    methods: {
        createUrl(base_url = this.base_url, id = null) {
            var url = base_url;
            if (id != null) {
                url = base_url + '/' + id;
            }
            return url;
        },
        create(obj, base_url = this.base_url,callback=function(){}) {
            var url = this.createUrl(base_url);
            if (_.has(obj, 'id')) {
              return  this.update(obj, obj.id, base_url)
            }
            var vm = this;
            this.rq.post(url, obj)
                .then(function (response) {
                    Vue.set(obj, 'id', response.data.id)
                    if (typeof callback === "function") {
                        // Call it, since we have confirmed it is callable
                        callback(response.data);
                    }
                    return response.data;
                })
                .catch(function (error) {
                    console.log(error);
                    return error;
                });
        },
        delete(id = null,base_url = this.base_url,callback=function(){}) {
            var url = this.createUrl(base_url, id);
            var vm = this;
            this.rq.delete(url)
                .then(function (response) {
                    if (typeof callback === "function") {
                        // Call it, since we have confirmed it is callable
                        callback(response.data);
                    }
                    return response.data;
                })
                .catch(function (error) {
                    return error;
                });
        },
        update(obj, id = null, base_url = this.base_url,callback=function(){}) {
            var url = this.createUrl(base_url, id);
            this.rq.patch(url, obj)
                .then(function (response) {
                    if (typeof callback === "function") {
                        // Call it, since we have confirmed it is callable
                        callback(response.data);
                    }
                    return response.data;
                })
                .catch(function (error) {
                    return error;
                });
        },
        fetch(id = null, base_url = this.base_url, params = {},callback=function(){}) {
            var vm = this;
            var url = this.createUrl(base_url, id);
            this.rq.get(url, {
                params: params
            })
                .then(function (response) {
                    if (typeof callback === "function") {
                        // Call it, since we have confirmed it is callable
                        callback(response.data);
                    }
                    return response.data;
                })
                .catch(function (error) {
                    return error;
                });

        },
        displayError(val) {
            if (val) {
                this.error = val;
                this.has_error = true;
            } else if (val == "") {
                this.has_error = false
            }
        },

    }
}
