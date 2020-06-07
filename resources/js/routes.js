import Vue from 'vue'
import Router from 'vue-router'

import agendaC from './views/Agenda'
import ponenteC from './views/Ponente'
import notFoundC from './views/404'

Vue.use(Router)

export default new Router({
    routes:[
        {
            path: '/app/agenda',
            name: 'agenda',
            component: agendaC
        },
        {
            path: '/app/ponente',
            name: 'ponente',
            component: ponenteC,
            // props: true
        },
        {
            path: '/app/plantilla',
            name: 'personal'
        },
        {
            path: '*',
            component: notFoundC
        },        
    ],
    mode: 'history'
})