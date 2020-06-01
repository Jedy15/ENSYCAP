import Vue from 'vue'
import Router from 'vue-router'

import homeC from './views/Home'
import contactC from './views/Contacto'
// import postC from './views/Post'
import notFoundC from './views/404'

Vue.use(Router)

export default new Router({
    routes:[
        {
            path:   '/',
            name:   'home',
            component: homeC
        },
        {
            path: '/contact',
            name: 'contact',
            component: contactC
        },
        // {
        //     path: '/contac',
        //     name: 'contac',
        //     component: require('./views/Contacto')
        // },
        {
            path: '*',
            component: notFoundC
        },        
    ],
    mode: 'history'
})