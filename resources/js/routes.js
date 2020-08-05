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
            path: '/app',
            name: 'agenda',
            component: agendaC,
        },
        {
            path: '/app/ponente',
            name: 'ponente',
            component: ponenteC,
        },
        {
            path: '/app/evento/:id',
            name: 'evento',
            component: eventoC,
            props: true
        },
        {
            path: '/app/plantilla',
            name: 'personal',
            // component: '<div><h1>Plantilla</h1></div>'
        },
        {
            path: '/app/*',
            component: notFoundC
        },        
    ],
    mode: 'history'
})