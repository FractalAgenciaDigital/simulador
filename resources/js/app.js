/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue').default;
import Vue from 'vue'
import VueRouter from 'vue-router'
import Swal from 'sweetalert2'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));


Vue.use(VueRouter)
// Vue.use(Swal);
window.Swal = Swal


const routes = [
    { path: '', component: require('./components/Clientes/Clientes.vue').default },
    { path: '/clientes', component: require('./components/Clientes/Clientes.vue').default },
    { path: '/usuarios', component: require('./components/Usuarios/Usuarios.vue').default },
    { path: '/creditos', component: require('./components/Creditos/Creditos.vue').default },
    { path: '/creditos/:credito_id/cuotas', component: require('./components/Creditos/Cuotas.vue').default, props: true, name: 'cuotas' },


]

const router = new VueRouter({
    routes // short for `routes: routes`
})

export default router;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
