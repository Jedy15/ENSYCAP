import Vue from 'vue'
import Router from 'vue-router'

// import homeC from './views/Home'
import contactC from './views/Contacto'
import ponenteC from './views/Ponente'
import notFoundC from './views/404'

Vue.use(Router)

export default new Router({
    routes:[
        // {
        //     path:   '/',
        //     name:   'home',
        //     component: homeC
        // },
        {
            path: ':id',
            name: 'ponente',
            component: ponenteC,
            props: true
        },
        {
            path: '/contact',
            name: 'contact',
            component: contactC
        },
        {
            path: '*',
            component: notFoundC
        },        
    ],
    mode: 'history'
})