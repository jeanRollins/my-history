import axios from 'axios';
import Storage from "./Storage";

export default class Request{
    method = "GET" ;
    rq = null ;
    body = null ;
    token = "";

    constructor() {
        this.rq = axios ;
        this.body = {} ;
        this.token = Storage.get("token") ;

    }

    async post({ url, form, auth }){
        this.body = form ;
        if( auth === undefined ){
            return await this.rq.post(url, this.body) ;
        }else {
            const token = Storage.get("token") ;
            if( token === undefined ){
                return { status : false, message : "Token undefined" };
            }
            const config = {
                headers: {
                    Authorization: `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            };

            try{
                return await this.rq.post(url, this.body, config) ;
            }catch (error){
                return { status : false , message : error };
            }

        }

    }

}
