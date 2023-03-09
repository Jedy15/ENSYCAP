require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'

//Vista de Aplicacion
Vue.component('app', require('./layout/AppComponent.vue').default);

//Componentes
Vue.component('ponentes', require('./components/PonentesComponent.vue').default);
Vue.component('calendar', require('./components/CalendarComponent.vue').default);
Vue.component('participantes', require('./components/ParticipantesComponent.vue').default);
Vue.component('temas', require('./components/TemasComponent.vue').default);


import router   from './routes';
import swal     from 'sweetalert';
import Toasted  from 'vue-toasted';



const app = new Vue({
    el: '#app',
    router,
});

Vue.use(Toasted,{
    iconPack : 'fontawesome' // set your iconPack, defaults to material. material|fontawesome|custom-class
})
