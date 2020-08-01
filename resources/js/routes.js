import Vue from 'vue'
import Router from 'vue-router'

import agendaC      from './views/Agenda'
import ponenteC     from './views/Ponente'
import notFoundC    from './views/404'
import eventoC      from './views/evento/Evento'

Vue.use(Router)

export default new Router({
    routes:[
        {
            path: '/',
            name: 'agenda',
            component: agendaC
        },
        {
            path: '/ponente',
            name: 'ponente',
            component: ponenteC,
            // props: true
        },
        {
            path: '/evento/:id',
            name: 'evento',
            component: eventoC,
            props: true
        },
        {
            path: '/plantilla',
            name: 'personal',
            // component: eventoC
        },
        {
            path: '*',
            component: notFoundC
        },        
    ]
    // mode: 'history'
})