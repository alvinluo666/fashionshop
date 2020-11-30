/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./config');//for defining variable eg Base URL

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('Home', require('./views/Home.vue').default);
Vue.component('Men',require('./views/Men.vue').default);
Vue.component('view-product',require('./views/ViewProduct.vue').default);
Vue.component('mycart',require('./views/MyCart.vue').default);
Vue.component('ordersuccess',require('./views/OrderSuccess.vue').default);
Vue.component('login',require('./views/Login.vue').default);
Vue.component('register',require('./views/Register.vue').default);
Vue.component('searchresult',require('./views/SearchResult.vue').default); 
Vue.component('foot',require('./components/Footer.vue').default);
Vue.component('copyright',require('./components/CopyRight.vue').default);
Vue.component('vieworder',require('./views/ViewOrder.vue').default);
Vue.component('women',require('./views/Women.vue').default);
Vue.component('kid',require('./views/Kid.vue').default);

import storeData from './store/index'


import Vuex, { mapActions } from 'vuex'
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

Vue.use(Vuex);
Vue.use(Antd);

const store=new Vuex.Store(
    storeData
)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    store,
    methods:{
        ...mapActions([
            'getShoppingCart',
            'getUser'
        ])
    },
    mounted(){
        //get shopping cart;
  
        this.getUser();
        this.getShoppingCart();
    }
});
