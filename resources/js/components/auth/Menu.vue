<template>
    <div class="container-menu">
        <ul>
            <li href=".">MENU APPS <hr /></li>
        </ul>

        <ul>
            <li v-for="item in menu" class="zoom" >
                <a href="#" class="text-primary text-decoration-none link " @click.prevent="console.log('***')">
                    <i class="bi bi-link" style="font-size: 1.25rem;"></i> {{ item.name }}
                </a>
                <hr />
            </li>


        </ul>
    </div>
</template>

<script>

import User from "../../services/User";

export default {
    data() {
        return {
            menu: []
        }
    },
    components: {

    },
    methods: {
        getUserApplications: async function (){

            const idUser = await this.$store.state.user.id ;
            if( idUser !== undefined ){
                try{
                    const user = new User();
                    const { data } = await user.getUserApplications({idUser});
                    this.menu = data ;
                }catch{
                    this.menu = [] ;
                }
            }

        },
        fetch: async function (){
            await this.getUserApplications()
        }
    },
    created() {
        this.fetch();
    }
}
</script>

<style scoped>
 .container-menu {
     width: 20%;
     padding: 30px;
 }

 .container-menu  li {
     list-style: none;

 }


</style>
