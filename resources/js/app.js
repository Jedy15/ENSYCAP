require('./bootstrap');

window.Vue = require('vue');

Vue.component('app', require('./layout/AppComponent.vue').default);
Vue.component('index', require('./layout/IndexComponent.vue').default);
Vue.component('ponentes', require('./components/PonentesComponent.vue').default);
Vue.component('login', require('./components/LoginComponent.vue').default);

import router from './routes'

const app = new Vue({
    el: '#app',
    router
});
