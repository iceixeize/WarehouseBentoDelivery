/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import JQuery from 'jquery'
// ES6 Modules or TypeScript
import Swal from 'sweetalert2'

import Vue from 'vue'
import Vuelidate from 'vuelidate'

// const { validationMixin, default: Vuelidate } = require('vuelidate')
// const { required, minLength } = require('vuelidate/lib/validators')

// import 'vue-form-wizard/dist/vue-form-wizard.min.css';
import VueResource from 'vue-resource';
import LaravelValidator from 'vue-laravel-validator';
import VueRouter from 'vue-router';
import VueDraggable from 'vuedraggable';

import DataTable from 'laravel-vue-datatable';


window.$ = JQuery

 

window.Vue = require('vue');
window.Bus = new Vue(); // Event Bus
// window.Vue.use(VueAxios, axios);

// Install BootstrapVue
window.Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
window.Vue.use(IconsPlugin)
 
window.Vue.use(VueResource);
window.Vue.use(LaravelValidator);

window.Vue.use(VueRouter);
window.Vue.use(Vuelidate);
import BlockUI from 'vue-blockui'
window.Vue.use(BlockUI);



import VueAWN from "vue-awesome-notifications";
let options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};
Vue.use(VueAWN, options)

Vue.component('pagination', require('laravel-vue-pagination'));

// main.js
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

window.Vue.use(VueSweetalert2);

 
window.Vue.use(VueDraggable);
window.Vue.use(DataTable);

import { ValidationProvider } from 'vee-validate';
 
// Register it globally
// main.js or any entry file.
window.Vue.component('ValidationProvider', ValidationProvider);


import axios from 'axios'
import VueAxios from 'vue-axios'
 
// window.Vue.use(VueAxios, axios)

// import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
// import { library } from "@fortawesome/fontawesome-svg-core";
// import { faSpinner } from "@fortawesome/free-solid-svg-icons";

// Vue.component("font-awesome-icon", FontAwesomeIcon);

// library.add(faSpinner);

// Font Awesome-related initialization
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEnvelope, faUser } from '@fortawesome/free-solid-svg-icons'
import { faFacebook, faTwitter } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'

// Add the specific imported icons
library.add(faEnvelope)
library.add(faUser)
library.add(faFacebook)
library.add(faTwitter)
library.add(fas)
// Enable the FontAwesomeIcon component globally
Vue.component('font-awesome-icon', FontAwesomeIcon)

// This imports all the layout components such as <b-container>, <b-row>, <b-col>:
import { LayoutPlugin } from 'bootstrap-vue'
Vue.use(LayoutPlugin)

// This imports <b-modal> as well as the v-b-modal directive as a plugin:
import { ModalPlugin } from 'bootstrap-vue'
Vue.use(ModalPlugin)

// This imports <b-card> along with all the <b-card-*> sub-components as a plugin:
import { CardPlugin } from 'bootstrap-vue'
Vue.use(CardPlugin)

// This imports directive v-b-scrollspy as a plugin:
import { VBScrollspyPlugin } from 'bootstrap-vue'
Vue.use(VBScrollspyPlugin)

// This imports the dropdown and table plugins
import { DropdownPlugin, TablePlugin } from 'bootstrap-vue'
Vue.use(DropdownPlugin)
Vue.use(TablePlugin)

import { BModal, VBModal } from 'bootstrap-vue'
Vue.component('b-modal', BModal)
// Note that Vue automatically prefixes directive names with `v-`
Vue.directive('b-modal', VBModal)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('flash-message', require('./components/FlashMessage.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//*---------------------------------------------------------
//* Rack
//----------------------------------------------------------
Vue.component('rack-component', require('./components/rack/RackComponent.vue').default);
Vue.component('rack-show-component', require('./components/rack/RackShowComponent.vue').default);
Vue.component('rack-list-component', require('./components/rack/RackListComponent.vue').default);
Vue.component('rack-edit-component', require('./components/rack/RackEditComponent.vue').default);
Vue.component('rack-search-component', require('./components/rack/RackSearchComponent.vue').default);
Vue.component('select-shelf-type', require('./components/rack/SelectShelfTypeComponent.vue').default);
Vue.component('select-shelf-unit', require('./components/rack/SelectShelfUnitComponent.vue').default);

//*---------------------------------------------------------
//* Print Barcode
//----------------------------------------------------------
Vue.component('print-barcode-component', require('./components/print/PrintBarcodeComponent.vue').default);

//*---------------------------------------------------------
//* Manage
//----------------------------------------------------------
Vue.component('choose-warehouse-component', require('./components/manage/ChooseWarehouseComponent.vue').default);
Vue.component('dashboard', require('./components/manage/Dashboard.vue').default);
Vue.component('manage-user', require('./components/manage/ManageUserComponent.vue').default);
Vue.component('edit-user-component', require('./components/manage/EditUserComponent.vue').default);


Vue.component('datetime-component', require('./components/DatetimeComponent.vue').default);







// BentoDelivery
// Vue.component('register-component', require('./components/Register.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
