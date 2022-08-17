export default class Storage {

    static getJson( key ){
        return JSON.parse( localStorage.getItem(key) ) ;
    }

    static get( key ){
        return localStorage.getItem(key) ;
    }

    static set( key,value ){
        return localStorage.setItem(key, value) ;
    }

    static setJson( key,value ){
        return localStorage.setItem(key, JSON.stringify(value)) ;
    }

    static clear(){
        localStorage.clear();
    }
}
