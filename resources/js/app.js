import Vue from 'vue';
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);
require('./bootstrap');

window.Vue = require('vue');

Vue.use(Toaster, {timeout: 5000})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-property', require('./components/CreateProperty.vue').default);
Vue.component('property-type', require('./components/Type.vue').default);
Vue.component('display-property', require('./components/DisplayProperty.vue').default);
Vue.component('edit-property', require('./components/Edit.vue').default);
Vue.component('connect-now',require('./components/ConnectNow.vue').default);
 
const app = new Vue({
    el: '#app',
});
