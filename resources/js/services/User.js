import Request from "../libs/Request";

export default class User {
    request = null ;
    url = "" ;

    constructor() {
        this.request = new Request() ;
    }

    async get(){
        const { data } = await this.request.post({
            url: "/api/auth/me",
            form : {},
            auth : true
        });
        return data ;
    }

    async logout(){
        const { data } = await this.request.post({
            url: "/api/auth/logout",
            auth : true
        });
        return data ;
    }

    async getUserApplications(form){
        const { data } = await this.request.post({
            url: "/api/user/getUserApplications",
            form ,
            auth : true
        });
        return data ;
    }
}
