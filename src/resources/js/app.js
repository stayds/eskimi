require('./bootstrap');

import Vue from 'vue';
import router from './router';

Vue.component('app', require('./components/app').default);

const app = new Vue({
    el: "#app",
    router,
    //components: { app }
});

//
// const app = new Vue({
//     el : "#app",
//     component: { App }
// })
