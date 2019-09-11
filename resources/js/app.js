require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-property', require('./components/CreateProperty.vue').default);
Vue.component('property-type', require('./components/Type.vue').default);
Vue.component('display-property', require('./components/DisplayProperty.vue').default);
Vue.component('edit-property', require('./components/Edit.vue').default);

 
const app = new Vue({
    el: '#app',
});
