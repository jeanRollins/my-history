export default class Helper {

    static validateEmail ( email ){
        const validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        return validEmail.test(email) ;
    }
}
