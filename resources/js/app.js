require('./bootstrap');

window.Vue = require('vue');

//Vista de Aplicacion
Vue.component('app', require('./layout/AppComponent.vue').default);

//Componentes
Vue.component('ponentes', require('./components/PonentesComponent.vue').default);
Vue.component('calendar', require('./components/CalendarComponent.vue').default);

import router from './routes';
import swal from 'sweetalert';


const app = new Vue({
    el: '#app',
    router
});
