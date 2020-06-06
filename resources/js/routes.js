import Vue from 'vue'
import Router from 'vue-router'

import agendaC from './views/Agenda'
import ponenteC from './views/Ponente'
import notFoundC from './views/404'

Vue.use(Router)

export default new Router({
    routes:[
        {
            path: '/app/inicio',
            name: 'agenda',
            component: agendaC
        },
        {
            path: ':id',
            name: 'ponente',
            component: ponenteC,
            props: true
        },       
        {
            path: '*',
            component: notFoundC
        },        
    ],
    mode: 'history'
})