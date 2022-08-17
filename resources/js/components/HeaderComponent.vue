<template>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand mx-3 link" href="#">My History </a>
            <span v-if="$store.state.auth" class="text-white  " >
                <img src="/user.png" class="img-thumbnail image-user" alt="User Picture"> {{ $store.getters.getUser.name }}
            </span>
            <a v-if="$store.state.auth" href="#" class="text-white text-decoration-none link " v-on:click.prevent="logout();"> <i class="bi bi-door-closed"></i>Out session </a>
        </div>


    </nav>
</template>

<script>
import User from "../services/User";
import Storage from "../libs/Storage";
import {mapActions, mapGetters} from "vuex";

export default {
    methods : {
        ...mapActions(['dataUserFalse']),

        logout : async function (){
            const user = new User;
            const { status } = await user.logout();
            if( status ){
                await Storage.clear();
                await this.dataUserFalse();
                await this.$router.push('/');
            }
        }
    },
    computed() {



    },
    created() {

    },

}
</script>
