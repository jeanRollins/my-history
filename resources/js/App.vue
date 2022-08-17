<script>
import HeaderComponent from "./components/HeaderComponent";
import {mapActions} from "vuex";

export default {
    name: 'App',
    components: {HeaderComponent},
    data() {
        return {

        }
    },
    methods: {
        ...mapActions(['dataUserTrue']),
        async fetch(){
            await this.dataUserTrue();
        }
    },
    mounted() {

        this.fetch();

        /*
        store.watch( (state , getters) => store.getters.getAuth, () => {
            console.log("cambio") ;
        })*/
    }
}
</script>

<template>
    <div class="w-100 h-100 position-absolute bg-secondary ">
        <header-component />
        <router-view> </router-view>
    </div>



</template>
