import { createStore } from 'vuex';
import User from "./services/User";

export default createStore({
    state: {
        auth : false ,
        linkCurrent : "",
        user: {}
    },
    mutations: {
        setAuth(state, auth){
            state.auth = auth ;
        },
        setUser(state, user){
            state.user = user ;
        },
    },
    actions : {
        async dataUserTrue({commit}){

            const user = new User() ;
            let status = false ;
            let data = {} ;
            try{
                const response= await user.get() ;
                status = response.status ;
                data   = response.data ;
            }catch (e) {
                status = false ;
                data   = {} ;
            }

            commit('setAuth',status);
            commit('setUser',data);
        },
        async dataUserFalse({commit}){
            commit('setAuth',false);
            commit('setUser',{});
        }
    },
    getters : {
        getAuth( state ) {
            return state.auth ;
        },
        getUser( state ) {
            return state.user ;
        }
    }
});


