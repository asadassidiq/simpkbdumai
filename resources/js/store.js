import {getLocalUser} from './helpers/auth';
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
const user = getLocalUser();

export default new Vuex.Store ({
    state:{
        currentUser : user,
        auth_error : null,
        pendaftarans:[],
    },
    getters:{
        currentUser(state){
            return state.currentUser;
        },
        pendaftarans(state){
            return state.pendaftarans;
        }

    },
    mutations:{
        login(state){
            state.auth_error = null
        },
        loginSuccess(state,payload){
            state.currentUser = Object.assign({},payload.user,{token:payload.access_token});
            localStorage.setItem('user', JSON.stringify(state.currentUser))
        },
        loginFailed(state,payload){
            state.auth_error = payload.error;
        },
        logout(state){
            localStorage.removeItem('user')
            state.currentUser=null
        },
        updatePendaftarans(state,payload){
            state.pendaftarans = payload;
        }
    },
    actions:{
        login(context){
            context.commit('login')
        },
        getPendaftarans(context){
            axios.get('/api/pendaftarans')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },
        getPendaftaransnu(context){
            axios.get('/api/pendaftaransnu')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getPendaftaransallnu(context){
            axios.get('/api/pendaftaransallnu')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getPendaftaransallmu(context){
            axios.get('/api/pendaftaransallmu')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getPendaftaransmu(context){
            axios.get('/api/pendaftaransmu')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },
        getPendaftaranall(context){
            axios.get('/api/pendaftaranall')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getDatakendaraan(context){
            axios.get('/api/datakendaraans')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getPendaftarantrans(context){
            axios.get('/api/pendaftarantrans')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getPendaftarantransall(context){
            axios.get('/api/pendaftarantransall')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getPendaftaranPos1(context){
            axios.get('/api/pendaftaranspos1')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getPendaftaranPos2(context){
            axios.get('/api/pendaftaranspos2')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getLulusPos1(context){
            axios.get('/api/lulusuji1')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getLulusPos2(context){
            axios.get('/api/lulusuji2')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getTidakLulusPos1(context){
            axios.get('/api/tidaklulusuji1')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getTidakLulusPos2(context){
            axios.get('/api/tidaklulusuji2')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getVerif(context){
            axios.get('/api/verif')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getVeriflulus(context){
            axios.get('/api/veriflulus')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getVerifgagal(context){
            axios.get('/api/verifgagal')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getMereks(context){
            axios.get('/api/mereks')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.masters)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getTipe(context){
            axios.get('/api/tipe')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.masters)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getUsers(context){
            axios.get('/api/users')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.users)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getKlasifikasi(context){
            axios.get('/api/klasifikasi')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.masters)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getJenis(context){
            axios.get('/api/jenis')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.masters)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getDatakendaraanlulus1(context){
            axios.get('/api/lulusuji1')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

        getDatakendaraanlulus2(context){
            axios.get('/api/lulusuji2')
            .then((result) => {
                context.commit('updatePendaftarans',result.data.kendaraans)
            }).catch((err) => {
                if (err.response.status == 401) {
                    context.commit('logout');
                    window.location.href = '/login';
                }
            });
        },

    }
})