require('./bootstrap');

window.Vue = require('vue');

Vue.component('app', require('./components/AppComponent.vue').default);
Vue.component('ponentes', require('./components/PonentesComponent.vue').default);

import router from './routes'

const app = new Vue({
    el: '#app',
    router
});
