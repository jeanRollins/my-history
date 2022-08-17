<template >
    <div class="w-100">
        <title-login-component title="Log in" />
        <div class="container my-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 mb-2">
                    <label for="username"  class="form-label">Username :</label>
                    <input type="text" ref="username" id="username" name="username" v-on:keyup.enter="send();" v-model="username" class="form-control"  >
                </div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <label for="password" class="form-label">Password :</label>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="password" ref="password" v-model="password" v-on:keyup.enter="send();" class="form-control " name="password" id="password" >
                </div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    For recovery password, <a href="#" class="link-primary" v-on:click.prevent="this.$router.push('/recovery');">click me!</a>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4"></div>
                <div class="col-4">
                    <button class="btn btn-primary w-100" @click.prevent="send();" ref="btnLogin"> Access </button>
                    <div v-if="showError" class="alert alert-danger w-100 my-2" role="alert">
                        {{ messageError }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Request from "../libs/Request";
import Storage from "../libs/Storage";
import TitleLoginComponent from "../components/TitleLoginComponent";
import {mapActions} from "vuex";

export default {
    name: "LoginPageComponent",
    components: {TitleLoginComponent},
    data(){
        return{
            username : "",
            password : "",
            showError : false ,
            messageError : "" ,
            btnLogin : null,
            request : null
        }
    },
    methods: {
        ...mapActions(['dataUserTrue']),
        statusBtnLogin: function( status , message){
            this.btnLogin.disabled = status ;
            this.btnLogin.innerHTML = message ;
        },
        send: async function(){

            this.statusBtnLogin(true, "Accesing...");

            if(this.username === ""){
                this.showMessage("Username required", "username");
                this.statusBtnLogin(false, "Access");
                return ;
            }
            if(this.password === ""){
                this.showMessage("Password required", "password");
                this.statusBtnLogin(false, "Access");
                return ;
            }

            const form = {
                email : this.username,
                password:  this.password
            };

            try {
                const { data } = await this.request.post({ url : "/api/auth/login", form }) ;
                const { accessToken, status } = data ;

                if(status) {
                    await Storage.set("token", accessToken ) ;
                    await this.dataUserTrue();
                    await this.$router.push("/dashboard") ;


                } else {
                    this.showMessage("Email or password not valid.");
                    this.statusBtnLogin(false, "Access");
                }
            } catch (error) {
                this.showMessage("Email or password not valid.");
                this.statusBtnLogin(false, "Access");
            }
        },
        showMessage: function(message = "", focus = ""){
            this.showError = true ;
            this.messageError = message ;

            if(focus !== ""){
                this.$refs[focus].focus();
            }
            setTimeout( () => {
                this.showError = false ;
            }, 5000)
        },

    },
    mounted() {
        this.btnLogin = this.$refs.btnLogin;
        this.request = new Request();



    },
    computed: {

    }
}
</script>

<style scoped>

</style>
