<template >
    <div class="w-100">
        <title-login-component title="Recovery password" />
        <div class="container my-5">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 mb-2">
                    <label for="email"  class="form-label">Email :</label>
                    <input type="text" ref="email" id="email" name="email" v-on:keyup.enter="send();" v-model="email" class="form-control"  >
                    <small> Email for recovery password </small>
                </div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    Return to <a href="#" class="link-primary" v-on:click.prevent="this.$router.push('/');"> login</a>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4"></div>
                <div class="col-4">
                    <button class="btn btn-primary w-100" @click.prevent="send();" ref="btnLogin"> Recovery </button>
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
import TitleLoginComponent from "../components/TitleLoginComponent";
import Helper from "../libs/Helper";

export default {
    name: "LoginPageComponent",
    components: {TitleLoginComponent},
    data(){
        return{
            email : "",
            request : null,
            showError : false ,
        }
    },
    methods: {
        statusBtnLogin: function( status , message){
            this.btnLogin.disabled = status ;
            this.btnLogin.innerHTML = message ;
        },
        send: async function(){

            //this.statusBtnLogin(true, "Recovering...");

            if(this.email === ""){
                this.showMessage("Email required", "email");
                this.statusBtnLogin(false, "Recovery");
                return ;
            }

            const validEmail = Helper.validateEmail(this.email);

            if(!validEmail){
                this.showMessage("You must add valid email. ", "email");
                this.statusBtnLogin(false, "Recovery");
                return ;
            }

            const form = {  email : this.email };

            try {
                const { data } = await this.request.post({ url : "/api/reset", form }) ;
                //const { accessToken, status } = data ;


            } catch (error) {
                //this.showMessage("Email or password not valid.");
                //this.statusBtnLogin(false, "Recovery");
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
