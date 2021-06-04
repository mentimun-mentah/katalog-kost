/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('home', require('./components/Home.vue').default);
Vue.component('register', require('./components/Register.vue').default);
Vue.component('detailkost',require('./components/DetailKost.vue').default);

Vue.component('owner-confirmation', require('./components/admin/kost/OwnerConfirmation.vue').default);
Vue.component('manage-owner', require('./components/admin/kost/ManageOwner.vue').default);

Vue.component('account-profile', require('./components/account/Profile.vue').default);
Vue.component('account-password', require('./components/account/Password.vue').default);

Vue.component('add-kost',require('./components/kosts/AddKost.vue').default);
Vue.component('my-kost',require('./components/kosts/MyKost.vue').default);
Vue.component('change-kost',require('./components/kosts/ChangeKost.vue').default);

Vue.component('list-kos',require('./components/GoogleMap/GoogleMap.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import wysiwyg from "vue-wysiwyg";
Vue.use(wysiwyg, {}); // config is optional. more below

import VueBootstrapToasts from "vue-bootstrap-toasts";
Vue.use(VueBootstrapToasts);

Vue.component('pagination', require('laravel-vue-pagination'));

import * as VueGoogleMaps from "vue2-google-maps";
import VueLodash from 'vue-lodash'
import lodash from 'lodash'

Vue.use(VueLodash, { name: 'custom' , lodash: lodash })

Vue.use(VueGoogleMaps, {
  load: {
    libraries: ['geometry','places'],
    key: 'AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k',
  }
});

const app = new Vue({
    el: '.app',
});
