import Footer from './components/Footer'
import { createRouter, createWebHashHistory} from "vue-router";
import LoginPageComponent from "./pages/LoginPageComponent";
import DashboardPageComponent from "./pages/DashboardPageComponent";
import User from "./services/User";
import LoginRecoveryPageComponent from "./pages/LoginRecoveryPageComponent";
import App1PageComponent from "./pages/App1PageComponent";

const router = createRouter({
    history: createWebHashHistory(),
    routes : [
        { path: '/', component: LoginPageComponent, name: "login" },
        { path: '/recovery', component: LoginRecoveryPageComponent, name: "recovery" },
        { path: '/footer', component: Footer },
        {
            path: '/dashboard',
            component: DashboardPageComponent,
            name: "dashboard",
            meta: { requiresAuth : true },
            children: [
                {
                    path: '/app1',
                    component : App1PageComponent,
                    name: "app1"
                }
            ]
        }
    ]
});



const user = new User() ;

router.beforeEach(async ( to, from, next ) => {
    const ruteAuth = to.matched.some( record => record.meta.requiresAuth );
    let status  ;
    try{
        const response= await user.get() ;
        status = response.status ;
    }catch (e) {
        status = false ;
    }

    if(!status && ruteAuth){
        next( { name: 'login' } )
    }
    else {
        if( status === true && to.name === "login" ){
            next( { name: 'dashboard' } ) ;
        }else {
            next()
        }

    }
});
export default router ;
